<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use common\models\User;
use common\models\LoginForm;
use common\models\EmailConfirmForm;
use common\models\SignupForm;
use common\models\PasswordResetRequestForm;
use common\models\PasswordResetForm;
use common\models\PasswordChangeForm;

use common\models\searchForms\TransactionSearch;
//use common\models\Transaction;

use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class UserController extends Controller
{
    
    
    public function actionLogin()
    {
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
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm('user');
        $model->scenario=SignupForm::SCENARIO_STANDART_MODE;

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Signup success'));
                return $this->goHome();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user=$model->confirmEmail()) {
            if($user->scenario==SignupForm::SCENARIO_AUTO_MODE)
            {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Ваша учетная запись успешно активирована. <br/> На адресс '.$user->email.' мы выслали интрукции как Вы можете войти в свой личный кабинет.'));    
            }else{
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Ваша учетная запись успешно активирована. <br/> Для входа используйте логин ('.$user->email.') и прароль, который Вы укзали при регистрации.'));    
            }
            
        } else {
            Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Account activation failed'));
        }
        return $this->goToLoginForm();
    }

    public function actionPasswordResetRequest()
    {
        $model = new PasswordResetRequestForm(User::PASSWORD_RESET_TOKEN_EXPIRE);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'На Ваш E-mail отправлена ссылка для сброса пароля'));
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', Module::t('app', 'Password reset faled'));
            }
        }
        return $this->render('passwordResetRequest', [
            'model' => $model,
        ]);
    }

    public function actionPasswordReset($token)
    {
        try {
            $model = new PasswordResetForm($token, User::PASSWORD_RESET_TOKEN_EXPIRE);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Ваш пароль успешно изменен'));
            return $this->goToLoginForm();
        }
        return $this->render('passwordReset', [
            'model' => $model,
        ]);
    }

    public function actionPasswordChange()
    {
        $this->layout = 'column2';
        $model = new PasswordChangeForm(Yii::$app->user->identity);
        
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Ваш пароль успешно изменен'));
            return $this->render('viewProfile', [
                'model' => Yii::$app->user->identity,
            ]);
        }
        return $this->render('passwordChange', [
            'model' => $model,
        ]);
    }

    public function actionViewProfile()
    {
        $this->layout = 'column2';
        $model=Yii::$app->user->identity;
        
        return $this->render('viewProfile', [
            'model' => $model,
        ]);
    }

    public function actionUpdateProfile()
    {
        $this->layout = 'column2';
        $model=Yii::$app->user->identity;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($model->viewProfileUrl);
        }

        return $this->render('updateProfile', [
            'model' => $model,
        ]);
    }

    public function actionBalanse()
    {
        $this->layout = 'column2';
        $searchModel = new TransactionSearch();
        $searchModel->user_id=Yii::$app->user->id;
        $searchModel->status=TransactionSearch::STATUS_SUCCESS;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('transaction', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function goToLoginForm()
    {
        return Yii::$app->getResponse()->redirect(User::getLoginUrl());   
    }


    

    
}
