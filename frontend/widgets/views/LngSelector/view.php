<?php
use yii\helpers\Html;
?>

<span style="color:#999; font-size: 15px;" class="pull-right">
    <?php foreach ($langs as $lang):?>
        <a href="<?php echo '/'.$lang->url.Yii::$app->getRequest()->getLangUrl(); ?>" class="text-info <?= (Yii::$app->language==$lang->local?'active':'') ?>" style="text-decoration:none;">
          <strong><?= ucfirst($lang->url); ?></strong>
        </a> &nbsp; 
    <?php endforeach;?>
</span>