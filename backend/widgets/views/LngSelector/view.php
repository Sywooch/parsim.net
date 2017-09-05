<?php
use yii\helpers\Html;
?>

<li class="dropdown language-switch">
    <a class="dropdown-toggle" data-toggle="dropdown">
        <img src="/images/flags/<?php echo $current->url; ?>.png" class="position-left" alt="">
        <span class="visible-xs-inline-block position-right"><?php echo $current->name;?></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <?php foreach ($langs as $lang):?>
            <li>
                <a class="deutsch" href="<?php echo '/'.$lang->url.Yii::$app->getRequest()->getLangUrl(); ?>">
                    <img src="/images/flags/<?php echo $lang->url; ?>.png" alt="">
                    <?php echo $lang->name; ?>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
</li>