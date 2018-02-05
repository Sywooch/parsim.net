<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\searchForms\RequestSearch;
use common\models\Tarif;
use common\models\Error;
use common\models\User;
use common\models\SignupForm;

use common\models\Request;
use common\models\Parser;
use common\models\ParserAction;
use common\models\Transaction;



/**
 * Site controller
 */
class RequestController extends Controller
{
    public $layout = 'column2';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','view'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ]
        ];
    }
    
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $searchModel->created_by=Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionCreate()
    {
        $model=new Request();
        $model->scenario=Request::SCENARIO_INSERT;
        $model->created_by=Yii::$app->user->id;
        

        
        if($model->load(Yii::$app->request->post()) && $model->validate() ){
            
            if($model->save()){

                //Если для URL еще нет парсера, создаю его
                if(!$parser=Parser::findByUrl($model->request_url)){
                    $parser=new Parser();
                    $parser->type_id=1; //продукт парсер
                    $parser->loader_type=0; // HTTP лоадер
                    $parser->name=parse_url($model->request_url,PHP_URL_HOST);
                    $parser->reg_exp='(^http[s]?://.*'.str_replace('www.', '', parse_url($model->request_url,PHP_URL_HOST)).'/.*$)';
                    $parser->status=Parser::STATUS_FIXING;
                    $parser->description='Парсер создан автоматически, требуется отладка';
                    $parser->request_id=$model->id;

                    $action=new ParserAction();
                    $action->name='Default';
                    
                    $action->selector='Enter selector here';
                    $action->example_url=$model->request_url;
                    $action->status=ParserAction::STATUS_FIXING;

                    $parser->actionsArray=[$action];
                    
                    if($parser->save()){
                        Yii::$app->mailqueue->compose(['html' => 'parser/create'], ['model' => $parser, 'owner'=>Yii::$app->user->identity,'updateUrl'=>Url::to('@backend/parser/update?id='.$parser->id, true)])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setTo(Yii::$app->params['supportEmail'])
                        ->setSubject('Создан новый парсер')
                        ->queue();
                    }
                }
                
                $model->parser_id=$parser->id;
                $model->save();

                if($currentOrder=Yii::$app->user->identity->currentOrder){
                    $currentOrder->addParser($parser);
                }
                return $this->redirect($model->getUrl('frontend','view'));    
            }
            
        }
        

        return $this->render('create',[
            'model'=>$model,
        ]);
    }

    public function actionUpdate($alias)
    {
        $model=$this->findModel($alias);
        

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect($model->getUrl('frontend','view'));
        }

        return $this->render('update',[
            'model'=>$model,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionView($alias)
    {
        $model=$this->findModel($alias);
        return $this->render('view',[
            'model'=>$model,
        ]);
    }


    protected function findModel($alias)
    {
        if (($model = Request::findOne(['alias'=>$alias])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
