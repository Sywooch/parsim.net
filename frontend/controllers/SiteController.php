<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\LoginForm;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;
use common\models\SignupForm;

//use frontend\models\ContactForm;

use common\models\User;
use common\models\Request;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'page' => [
                'class' => 'yii\web\ViewAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        
        $request=new Request();
        $request->scenario=Request::SCENARIO_DEMO;

        $user = new SignupForm('user');
        $user->scenario=SignupForm::SCENARIO_STANDART_MODE;    
        if ($user->load(Yii::$app->request->post()) && $user->validate()) {
            if ($user = $user->signup()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Вы успешно зарегистрировались! <br/>Мы отправили на Ваш E-mail письмо с сылкой для активации Вашей учетной записи.'));
                return $this->goHome();
            }    
        }
        
        if ($request->load(Yii::$app->request->post()) && $request->validate()) {

            //Проверяю есть ли пользователь с таким E-mail в базе
            $user=User::findOne(['email'=>$request->response_email]);
            //Если пользователь не найден, создаю нового пользователя
            if(!isset($user)){
                $userForm = new SignupForm('user');
                $userForm->scenario=SignupForm::SCENARIO_AUTO_MODE;
                
                $userForm->subject='Запрос сканирования страницы';
                $userForm->request_url=$request->request_url;

                $userForm->email=$request->response_email;
                $userForm->password=uniqid();
                if($userForm->validate() && $user=$userForm->signup()){

                    //Добавляю id пользователя к запросу как автора запроса
                    $request->created_by=$user->id;
                    $request->updated_by=$user->id;

                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Ваш запрос взят в работу! <br/>Подробности отправлены на Ваш E-mail.'));
                }else{
                    echo json_encode($user->errors);
                    die;
                }
                
            }
            $request->ip=Yii::$app->request->userIP;
            $request->save();

            return $this->redirect(['/site/index', 'request' => $request]);
        }
        

        return $this->render('index',[
            'request'=>$request,
            'newUser'=>$user,
        ]);
    }

    

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
