<?php
    $promoName=[
        'free-forever'=>'100% Free Forever',
        'pay-per-action'=>'dynamic',
        'pay-per-period'=>'static'
    ];
?>

<!--Pricing Column-->
<div class="pricing-column-two col-md-4 col-sm-6 col-xs-12">
    <div class="inner-box">
        <div class="price-header">
            <div class="content">
                <div class="plan-title"><span class="theme_color"><?= $promoName[$model->alias]; ?></span></div>
                <?php if($model->alias=='free-forever'): ?>
                    <h4>Акция в честь запуска<br/></h4>
                    <span class="last-offers theme_color">Всего предложений - 99 шт.</span>
                <?php elseif($model->alias=='pay-per-period'): ?>
                    <span class="price"><span class="dollar-sign">₽</span><span class="total-amount"> 300 </span> <sup>.00</sup> <sub>/ месяц</sub></span>
                <?php elseif($model->alias=='pay-per-action'): ?>
                    <span class="price"><span class="dollar-sign">₽</span><span class="total-amount"> 0 </span> <sup>.10</sup> <sub>/ обновление</sub></span>
                    
                <?php endif; ?>
            </div>
        </div>
        <div class="lower-content">
            <ul class="spec-list">
                <?php foreach ($model->options as $key => $option): ?>
                <li><?= $option->title; ?></li>
                <?php endforeach; ?>
                
            </ul>
            <a href="<?= $model->orderUrl; ?>" class="theme-btn purchase-btn">Хочу этот тариф</a>
        </div>
    </div>
</div>