<?php
namespace backend\controllers;

use Yii;
use ZipArchive;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Parser;
use common\models\parsers\classes\BaseParser;
use common\models\ParserAction;
use common\models\searchForms\ParserSearch;
use backend\models\importForm;
use yii\web\UploadedFile;
use yii\helpers\Url;

use yii\data\ActiveDataProvider;


/**
 * Site controller
 */
class ParserController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','create','update','delete','view','export','test','create-action','disable','enable','test-email','test-url'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        Url::remember();
        
        $searchModel = new ParserSearch();
        $importForm= new importForm();

        if (Yii::$app->request->isPost) {
            $importForm->file = UploadedFile::getInstance($importForm, 'file');
            if ($importForm->upload()) {
                return $this->redirect($searchModel->indexUrl);
            }
        }


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
            'importForm'=>$importForm,
        ]);
    }

    


    /**
     * Creates a new Logo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($url=null)
    {
        $model = new Parser();
        $model->type_id=1;
        $model->loader_type=0;
        $model->reg_exp="(^http[s]?://.*enter_here_host_and_path.*$)";    

        if ($model->load(Yii::$app->request->post()) ){

            if(isset(Yii::$app->request->post()['ParserAction']) ){
                $model->actionsArray=Yii::$app->request->post()['ParserAction'];
            }else{
                $model->actionsArray=[];
            }
            
            if($model->save() ){
                return $this->goBack();    
            }

        }else {
            if(isset($url)){
                $model->reg_exp="(^http[s]?://.*".parse_url($url, PHP_URL_HOST).parse_url($url, PHP_URL_PATH).".*$)";    
                $model->name=parse_url($url, PHP_URL_HOST);

                $action=new ParserAction();
                $action->parser_id=0;
                $action->name='ParsList';
                $action->example_url=$url;
                $action->status=ParserAction::STATUS_READY;
                $model->actionsArray=[$action];
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Logo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) ){

            if(isset(Yii::$app->request->post()['ParserAction']) ){
                $model->actionsArray=Yii::$app->request->post()['ParserAction'];
            }else{
                $model->actionsArray=[];
            }
            
            //echo(json_encode($model->actionsArray) );
            //die;
            
            if($model->save() ){
                return $this->goBack();    
            }

        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Logo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();

        if (Yii::$app->request->isAjax){
            return 'ok';
        }

        return $this->redirect(['index']);
        
    } 


    public function actionExport()
    {
        $file=$this->createExportFile();
        
        if (file_exists($file)) {
            header("Content-Type: application/zip");
            header("Content-Disposition: attachment; filename=".basename($file));
            header("Content-Length: ".filesize($file));
            ob_clean();
            flush();
            echo readfile("$file");
            //return Yii::$app->response->sendFile($file);
        }
        
    }

    public function actionDisable($id)
    {
        $model=$this->findModel($id);
        $model->status=Parser::STATUS_FIXING;
        $model->save();
        
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
        
    }
    public function actionEnable($id)
    {
        $model=$this->findModel($id);
        $model->status=Parser::STATUS_READY;
        $model->save();
        
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
        
    }

    public function actionTest($id)
    {
        $model=$this->findModel($id);
        $model->test();

        $msg=$this->getMsgData('success','Ok','Ошибок не обнаружено');    
        if($model->hasErrors()){
            $msg=$this->getMsgData('error','Обнаружены ошибки',$model->getErrorSummary() );    
        }
        
        
        return json_encode($msg,JSON_UNESCAPED_UNICODE);
    }

    public function actionTestEmail($id)
    {
        $model=$this->findModel($id);

        if($model->status==Parser::STATUS_READY){
            $email=Yii::$app->params['adminEmail'];
            if($model->sendToTestEmail($email)){
                $msg=$this->getMsgData('info','Сообщение успешно отправлено','получатель: '.$email);            
            }else{
                $msg=$this->getMsgData('error','Ошибка отправки тестового сообщения',$model->getErrorSummary() );           
            }
            
        }else{
            $msg=$this->getMsgData('warning','Сообщение не отправлено','Сообщение возможно отправить только для парсеров в статусе READY');        
        }
        
        return json_encode($msg,JSON_UNESCAPED_UNICODE);
    }

    public function actionTestUrl($id)
    {
        $model=$this->findModel($id);

        if($model->status==Parser::STATUS_READY){
            $url=Yii::$app->params['testUrl'];
            if($model->sendToTestUrl($url)){
                $msg=$this->getMsgData('info','Данные успешно отправлено','URL: '.$url);            
            }else{
                $msg=$this->getMsgData('error','Ошибка отправки данных',$model->getErrorSummary() );           
            }
            
        }else{
            $msg=$this->getMsgData('warning','Данные не отправлено','Можно отправлять только для парсеров в статусе READY');        
        }
        
        return json_encode($msg,JSON_UNESCAPED_UNICODE);
    }


    public function actionCreateAction($index)
    {
        $index++;
        $model= new ParserAction();
        $model->name='NewAction';
        $data=[
            'index'=>$index,
            'actionTab'=>$this->renderPartial('_actionTab',['model'=>$model,'key'=>$index]),
            'actionContent'=>$this->renderPartial('_actionContent',['model'=>$model,'key'=>$index]),
        ];

        return json_encode($data);

    }

    

    protected function findModel($id)
    {
        //$task= new Task();
        if (($model = Parser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function createExportFile()
    {
        $file = Yii::getAlias('@webroot/uploads/parsers/export/parsers.zip');
        $zip = new ZipArchive();

        $init_data=[];
        $zip_mode=ZipArchive::CREATE;
        if(file_exists($file)){
            $zip_mode=ZipArchive::OVERWRITE;
        }
        
        if ($zip->open($file, $zip_mode) === TRUE ) {
            foreach(Parser::find()->all() as $parserAR){
                $zip->addFile($parserAR->classPath,$parserAR->className.'.php');
                //$pareserFile=BaseParser::loadParser($parserAR->className);
                //$pareserFile->parserAR=$parserAR;
                //$init_data[]=$pareserFile->getExportData();
                $init_data[]=$parserAR->getExportData();
            }

            $init_file='InitParsData.json';
            $init_file_path=Parser::getClassDir().$init_file;
            file_put_contents($init_file_path, json_encode($init_data));
            $zip->addFile($init_file_path,$init_file);

            $zip->close();
            return $file;

        }else{
            throw new \Exception('Cannot create a zip file');
        }
    }
    

}
