<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\Menu;
use backend\widgets\LngSelector;

use common\models\Error;


AppAsset::register($this);

$errCount=Error::getCountNew();


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <?php $this->head() ?>
</head>
<body class="<?= (isset($this->params['bodyClass'])?$this->params['bodyClass']:''); ?>">
<?php $this->beginBody() ?>
    <!-- Main navbar -->
    <div class="navbar navbar-default header-highlight">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= Url::home(); ?>"><img src="/images/logo_light.png" alt=""></a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
                <?php if(isset($this->params['bodyClass']) && strpos($this->params['bodyClass'],'has-detached-right')>=0): ?>
                <li><a class="sidebar-control sidebar-detached-hide hidden-xs legitRipple"><i class="icon-drag-right"></i></a></li>
                <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php echo LngSelector::widget();?>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user-material">
                        <div class="category-content">
                            <div class="sidebar-user-material-content">
                                <a href="<?= Yii::$app->user->identity->viewProfileUrl; ?>">
                                    <?= Yii::$app->user->identity->avatarImg; ?>
                                </a>
                                <h6><?= Yii::$app->user->identity->fullName; ?></h6>
                                <span class="text-size-small"><?= Yii::$app->user->identity->role; ?></span>
                            </div>
                                                        
                            <div class="sidebar-user-material-menu">
                                <a href="#user-nav" data-toggle="collapse"><span><?= Yii::t('app','My account'); ?></span> <i class="caret"></i></a>
                            </div>
                        </div>
                        
                        <div class="navigation-wrapper collapse" id="user-nav">
                            <ul class="navigation">
                                <li><a href="<?= Yii::$app->user->identity->viewProfileUrl; ?>"><i class="icon-user-plus"></i> <span><?= Yii::t('app','My account'); ?></span></a></li>
                                <li><a href="<?= Yii::$app->user->identity->logoutUrl; ?>"><i class="icon-switch2"></i> <span><?= Yii::t('app','Logout'); ?></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /user menu -->

                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <?=
                                Menu::widget([
                                    'items' => [
                                        // Main section
                                        [
                                            'label' => '<span>'.Yii::t('app','Main menu').'</span> <i class="icon-menu" title="'.Yii::t('app','Main menu').'"></i>',
                                            'encode'=>false,
                                            'options'=>['class'=>'navigation-header']
                                        ],
                                        [
                                            'label' => '<i class="icon-home4"></i> <span>'.Yii::t('app','Dashboard').'</span>',
                                            'url' => ['site/index'],
                                            'encode'=>false,
                                        ],
                                        //Administration section
                                        [
                                            'label' => '<span>'.Yii::t('app','Settings').'</span> <i class="icon-menu" title="'.Yii::t('app','Settings').'"></i>',
                                            'encode'=>false,
                                            'options'=>['class'=>'navigation-header']
                                        ],
                                        [
                                            'label' => '<i class="icon-stack2 position-left"></i> <span>'.Yii::t('app','Parsing'). ($errCount==0?'':' <span class="badge badge-danger">'.$errCount.'</span>').'</span>',
                                            'url' => '#',
                                            'encode'=>false,
                                            'items'=>[
                                                [
                                                    'label' => '<span>'.Yii::t('app','Parser types').'</span>',
                                                    'url' => ['parser-type/index'],
                                                    'encode'=>false,
                                                ],
                                                [
                                                    'label' => '<span>'.Yii::t('app','Parsers').'</span>',
                                                    'url' => ['parser/index'],
                                                    'encode'=>false,
                                                ],
                                                [
                                                    'label' => '<span>'.Yii::t('app','Requests').'</span>',
                                                    'url' => ['request/index'],
                                                    'encode'=>false,
                                                ],
                                                [
                                                    'label' => '<span>'.Yii::t('app','Responses').'</span>',
                                                    'url' => ['response/index'],
                                                    'encode'=>false,
                                                ],
                                                [
                                                    'label' => '<span>'.Yii::t('app','Errors'). ($errCount==0?'':' <span class="badge badge-danger">'.$errCount.'</span>').'</span>',
                                                    'url' => ['error/index'],
                                                    'encode'=>false,
                                                ],

                                            ]
                                        ],
                                        [
                                            'label' => '<i class="icon-cash3 position-left"></i> <span>'.Yii::t('app','Money').'</span>',
                                            'url' => '#',
                                            'encode'=>false,
                                            'items'=>[
                                                [
                                                    'label' => '<span>'.Yii::t('app','Transactions').'</span>',
                                                    'url' => ['transaction/index'],
                                                    'encode'=>false
                                                ],
                                                [
                                                    'label' => '<span>'.Yii::t('app','Tarifs').'</span>',
                                                    'url' => ['tarif/index'],
                                                    'encode'=>false
                                                ],
                                                [
                                                    'label' => '<span>'.Yii::t('app','Orders').'</span>',
                                                    'url' => ['order/index'],
                                                    'encode'=>false
                                                ],

                                            ],
                                        ],
                                        [
                                            'label' => '<i class="icon-bubbles4 position-left"></i> <span>'.Yii::t('app','Communication').'</span>',
                                            'url' => '#',
                                            'encode'=>false,
                                            'items'=>[
                                                [
                                                    'label' => '<span>'.Yii::t('app','Email queue').'</span>',
                                                    'url' => ['queue-mail/index'],
                                                    'encode'=>false
                                                ],
                                                [
                                                    'label' => '<span>'.Yii::t('app','API responses').'</span>',
                                                    'url' => ['test-response/index'],
                                                    'encode'=>false
                                                ],
                                                [
                                                    'label' => '<span>'.Yii::t('app','Notifications').'</span>',
                                                    'url' => ['notification/index'],
                                                    'encode'=>false
                                                ],

                                            ],
                                        ],
                                        [
                                            'label' => '<i class="icon-users position-left"></i> <span>'.Yii::t('app','Users').'</span>',
                                            'url' => ['user/index'],
                                            'encode'=>false
                                        ],
                                        
                                    ],
                                    'options'=>['class'=>'navigation navigation-main navigation-accordion']
                                ]);
                            ?>
                        </div>
                    </div>
                    <!-- /main navigation -->
                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">
                <?php if(isset($this->params['breadcrumbs'])): ?>
                <!-- Page header -->
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?= $this->title; ?></span></h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <?php 
                                if(isset($this->params['actions'])){
                                    foreach ($this->params['actions'] as $action){
                                        echo $action;
                                    }    
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="breadcrumb-line breadcrumb-line-component">
                        <?php
                            if(isset($this->params['breadcrumbs'])){
                                echo Breadcrumbs::widget([
                                    'links' => $this->params['breadcrumbs'],
                                    'homeLink'=>[
                                        'template' => '<li><i class="icon-home2 position-left"></i>{link}</li>',
                                        'label'=>Yii::t('yii','Home'),
                                        'url'=>Yii::$app->urlManager->createUrl(['site/index'])
                                    ]
                                ]);    
                            }else{
                                echo '<ul class="breadcrumb"><li><i class="icon-home2 position-left"></i>'.Yii::t('yii','Home').'</li></ul>';
                            }
                        ?>

                        
                    </div>
                </div>
                <!-- /page header -->
                <?php endif; ?>
                <!-- Content area -->
                <div class="content">

                    <?= $content; ?>
                    <?= $this->render('_footer',['class'=>'footer text-muted']); ?>
                    
                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
