<?php
namespace backend\controllers;

use Yii;


use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;

use common\models\LoginForm;
use common\models\SignupForm;
use common\models\EmailConfirmForm;
use common\models\PasswordResetRequestForm;
use common\models\PasswordResetForm;

use common\models\User;
use common\models\searchForms\UserSearch;

use yii\helpers\Url;


/**
 * User controller
 */
class UserController extends BackendController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','captcha','msg'],
                'rules' => [
                    [
                        'actions' => ['captcha','msg'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','creatsProfile','updateProfile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update','create','delete','enable','disable'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    
    public function actionIndex()
    {
        Url::remember();

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'column1';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
        $this->layout = 'column1';
        

        $model = new SignupForm('user');
        $user=null;
        if ($model->load(Yii::$app->request->post()) && $user=$model->signup()) {
            return $this->redirect(['msg','id'=>$user->id,'view'=>'msgSignup']);
        } else {
            return $this->render('signup', [
                'model' => $model,
            ]);
        }
    }
    public function actionMsg($id,$view)
    {
        $this->layout = 'column1';
        $model=User::findOne($id);
        return $this->render($view, [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->confirmEmail()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'FLASH_EMAIL_CONFIRM_SUCCESS'));
        } else {
            Yii::$app->getSession()->setFlash('error', Yii::t('app', 'FLASH_EMAIL_CONFIRM_ERROR'));
        }

        return $this->goHome();
    }

    public function actionPasswordResetRequest()
    {
        $this->layout = 'column1';   
        $model = new PasswordResetRequestForm(User::PASSWORD_RESET_TOKEN_EXPIRE);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                //Yii::$app->getSession()->setFlash('success', Yii::t('app', 'FLASH_PASSWORD_RESET_REQUEST'));

                return $this->redirect(['msg','id'=>$model->user->id,'view'=>'msgResetPass']);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'FLASH_PASSWORD_RESET_ERROR'));
            }
        }

        return $this->render('passwordResetRequest', [
            'model' => $model,
        ]);
    }

    public function actionPasswordReset($token)
    {
        $this->layout = 'column1';   
        try {
            $model = new PasswordResetForm($token, User::PASSWORD_RESET_TOKEN_EXPIRE);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }


        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'FLASH_PASSWORD_RESET_SUCCESS'));

            return $this->goHome();
        }

        return $this->render('passwordReset', [
            'model' => $model,
        ]);
    }

    

    public function actionVievProfile()
    {
        
        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario = User::SCENARIO_ADMIN_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['site/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
    }

    
    /**
     * Creates a new Logo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_ADMIN_CREATE;
        $model->status = User::STATUS_ACTIVE;
        $model->generateAuthKey();
        $model->generateEmailConfirmToken();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
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
        $model->scenario = User::SCENARIO_ADMIN_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
        return $this->redirect(['/request/index']);
        
    }


    public function actionDisable($id)
    {
        $model=$this->findModel($id);
        $model->status=User::STATUS_BLOCKED;
        $model->save();
        
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
        
    }
    public function actionEnable($id)
    {
        $model=$this->findModel($id);
        $model->status=User::STATUS_ACTIVE;
        $model->save();
        
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
        
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    
}
