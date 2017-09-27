<?php

use app\modules\main\Module;

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/password-reset', 'token' => $user->password_reset_token]);
?>

<?= Yii::t('app', 'HELLO!'); ?>

<?= Yii::t('app', 'Please click the link to setup your password') ?>

<?= $resetLink ?>