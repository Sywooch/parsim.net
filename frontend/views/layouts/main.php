<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;


use frontend\widgets\ModalAlert;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="<?= (isset($this->params['htmlClass'])?$this->params['htmlClass']:''); ?>">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NXWJVTH');</script>
    <!-- End Google Tag Manager -->

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php if (isset($this->params['description'])): ?>
      <meta name="description" content="<?= $this->params['description']; ?>"> 
    <?php endif; ?> 
    
    <?php if (isset($this->params['keywords'])): ?>
      <meta name="Keywords" content="<?= $this->params['keywords']; ?>">
    <?php endif; ?> 
    
    

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->name.': '.$this->title) ?></title>
    <?php $this->head() ?>

    
    </script>
</head>

<body class="<?= (isset($this->params['bodyClass'])?$this->params['bodyClass']:''); ?>">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXWJVTH"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  

  <?php $this->beginBody() ?>

  <?= $content; ?>
  <?= ModalAlert::widget(); ?>

  <?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
