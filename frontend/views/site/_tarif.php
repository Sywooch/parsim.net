<!--Pricing Column Two-->
<div class="pricing-column-two col-md-4 col-sm-6 col-xs-12">
    <div class="inner-box">
        <div class="price-header">
            <div class="content">
                <div class="plan-title"><?= $model->name; ?></div>
                <span class="price"><span class="dollar-sign">₽</span><span class="total-amount"> <?= round($model->price/1000); ?> </span> <sup>тыс.</sup> <sub>/ месяц</sub></span>
            </div>
        </div>
        <div class="lower-content">
            <ul class="spec-list">
                <li>Источников: <?= $model->host_limit; ?></li>
                <li class="mark-list">No Time Tracking</li>
                <li>800 - Man Hour</li>
                <li>News Letter Available</li>
                <li>User Dasboard</li>
            </ul>
            <a href="#" class="theme-btn purchase-btn">Подключить тариф</a>
        </div>
    </div>
</div>