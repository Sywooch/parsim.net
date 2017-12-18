<?php
namespace backend\controllers;

use Yii;
use ZipArchive;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Parser;
use common\models\parsers\classes\BaseParser;
use common\models\ParserAction;
use common\models\searchForms\ParserSearch;
use backend\models\importForm;
use yii\web\UploadedFile;

use yii\data\ActiveDataProvider;


/**
 * Site controller
 */
class ParserController extends Controller
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
                        'actions' => ['index','create','update','delete','view','export','test'],
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
        
        \yii\helpers\Url::remember();
        
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
    public function actionCreate()
    {
        $model = new Parser();
        $model->type_id=1;
        $model->reg_exp="(^http[s]?://.*enter_here_host_and_path.*$)";
        $model->loader_type=0;


        if ($model->load(Yii::$app->request->post()) && $model->save()){

            if(isset(Yii::$app->request->post()['ParserAction'])){
                $actions=Yii::$app->request->post()['ParserAction'];
                foreach ($actions as $key => $action) {

                    $modelAction= new ParserAction();

                    $modelAction->seq=$key;
                    $modelAction->parser_id=$model->id;
                    $modelAction->name=$action['name'];
                    $modelAction->selector=$action['selector'];
                    $modelAction->status=$action['status'];
                    $modelAction->example_url=$action['example_url'];
                    $modelAction->save();
                    
                }
                
            }

            return $this->redirect($model->viewUrl);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
        
        if(isset($model->actions) ){
            
        }
        //echo(json_encode(Yii::$app->request->post()));
        //die;

        if ($model->load(Yii::$app->request->post()) && $model->save()){

            if(isset(Yii::$app->request->post()['ParserAction'])){
                
                $actions=Yii::$app->request->post()['ParserAction'];

                foreach ($actions as $key => $action) {

                    $modelAction= ParserAction::findOne(['name'=>$action['name'],'parser_id'=>$model->id]);
                    if($modelAction==null ){
                        $modelAction= new ParserAction();
                    }

                    $modelAction->seq=$key;
                    $modelAction->parser_id=$model->id;
                    $modelAction->name=$action['name'];
                    $modelAction->selector=$action['selector'];
                    $modelAction->status=$action['status'];
                    $modelAction->example_url=$action['example_url'];
                    $modelAction->save();
                    
                }
                
            }

            //return $this->redirect($model->indexUrl);
            //return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
            return $this->goBack();
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
    public function actionTest($id)
    {
        $model=$this->findModel($id);
        $model->test();
        
        $model->save();
        
        //$model->addErrors($errors);
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
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
