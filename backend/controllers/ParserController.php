<?php
namespace backend\controllers;

use Yii;
use ZipArchive;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Parser;
use common\models\ParserAction;
use common\models\searchForms\ParserSearch;
use backend\models\importForm;
use yii\web\UploadedFile;

use common\models\parsers\BaseParser;

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
                        'actions' => ['index','create','update','delete','view','export','import'],
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
        
        
        //echo(json_encode(Yii::$app->request->post()));
        //die;

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect($model->indexUrl);
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

        $zip_mode=ZipArchive::CREATE;
        if(file_exists($file)){
            $zip_mode=ZipArchive::OVERWRITE;
        }
        
        if ($zip->open($file, $zip_mode) === TRUE ) {
            foreach(Parser::find()->all() as $parser){
                $zip->addFile($parser->classPath,$parser->className.'.php');
            }
            $zip->close();
            return $file;

        }else{
            throw new \Exception('Cannot create a zip file');
        }
    }
    

}
