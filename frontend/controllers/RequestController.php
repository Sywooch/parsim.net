<?php
namespace frontend\controllers;

use Yii;
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
        
        $model->tarif_id=Yii::$app->user->identity->tarif_id;


        if ($model->load(Yii::$app->request->post()) ){

            //Определяю парсер
            $parser=Parser::findByUrl($model->request_url);
            if(isset($parser)){
                $model->parser_id=$parser->id;    
            }else{
                $parser=new Parser();
                $parser->type_id=Parser::TYPE_PRODUCT;
                $parser->loader_type=0;
                $parser->name=parse_url($model->request_url, PHP_URL_HOST);
                $parser->reg_exp='(^http[s]?://.*'.parse_url($model->request_url, PHP_URL_HOST).'/.*$)';
                $parser->status=Parser::STATUS_FIXING;
                if(!$parser->save() ){
                    $model->addErrors($parser->errors);
                }

                $model->parser_id=$parser->id;
                $model->status=Request::STATUS_READY;
            }

            
            if($model->save() ){
                return $this->redirect($model->getUrl('frontend','view'));    
            }
            
        }

        return $this->render('create',[
            'model'=>$model,
        ]);
    }

    //Создание запроса на парсинг в тестовом режибе (бесплатно на гл. странице)
    public function actionCreateTest()
    {
    
        $model=new Request();
        $model->scenario=Request::SCENARIO_DEMO;
        
        $data=[];
        $password=null;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            //Проверяю есть ли пользователь с таким E-mail в базе
            $user=User::findOne(['email'=>$model->response_email]);
            
            //Если пользователь не найден, создаю нового пользователя
            if(!isset($user)){
                $userForm = new SignupForm('user');
                $userForm->scenario=SignupForm::SCENARIO_AUTO_MODE;
                
                $userForm->subject='Запрос сканирования страницы';
                $userForm->request_url=$model->request_url;
                
                $userForm->email=$model->response_email;
                $password=uniqid();
                $userForm->password=$password;

                if($userForm->validate() && $user=$userForm->signup()){

                    //Добавляю id пользователя к запросу как автора запроса
                    $model->created_by=$user->id;
                    $model->updated_by=$user->id;
                }else{

                    //регистрирую ошибку авто регистрации пользователя
                    $error=new Error();
                    $error->code=Error::CODE_UNKNOW_ERROR;
                    $error->msg='Ошибка регистрации пользователя через форму запрса на главной странице сайта';
                    $error->status=Error::STATUS_NEW;
                    $error->save();
                    
                    
                    //возвращаю сообщение об ошибке
                    $data['view']=$this->renderPartial('_viewErrRegUser',[
                        'user'=>$user,
                        'form'=>$userForm,
                    ]);
                    return json_encode($data);
                }
                
            }else{
                $model->created_by=$user->id;
                $model->updated_by=$user->id;
            }
            
            if($model->save()){
                //возвращаю сообщение о удачной регистрации запроса
                $data['view']=$this->renderPartial('_viewSuccessRegRequest',[
                    'model'=>$model,
                    'password'=>$password,
                    
                ]);
                return json_encode($data);
            }else{
                $error=new Error();
                $error->code=Error::CODE_UNKNOW_ERROR;
                $error->msg='Ошибка создания запроса на главной странице сайта';
                $error->status=Error::STATUS_NEW;
                $error->save();

                //возвращаю сообщение об ошибке
                $data['view']=$this->renderPartial('_viewErrRegRequest',[
                    'model'=>$model,
                ]);
                return json_encode($data);
            }
        }

        $data['form']=$this->renderPartial('_formTest',['model'=>$model]);

        return json_encode($data);
    }

    public function actionUpdate($alias)
    {
        $model=$this->findModel($alias);
        

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect($model->viewUrl);
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
