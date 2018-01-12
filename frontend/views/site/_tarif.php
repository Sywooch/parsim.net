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
                <li>кол-во источников - <?= Yii::$app->formatter->asDecimal($model->host_limit); ?> шт.</li>
                <li>добавление источника - <?= Yii::$app->formatter->asCurrency($model->extra_host_price); ?> (разово)</li>
                <li>включено сканнирований - <?= Yii::$app->formatter->asDecimal($model->pars_limit); ?> шт.</li>
                <li>цена за доп. сканнирование - <?= Yii::$app->formatter->asCurrency($model->price/$model->pars_limit); ?></li>
                <li>макс. частота сканнирований - <?= $model->pars_freq; ?> / сутки</li>
                <li>экспорт в XLS - <?= ($model->can_export?'ДА':'НЕТ'); ?></li>
                <li>доступ по API - <?= ($model->api_access?'ДА':'НЕТ'); ?></li>
            </ul>
            <a href="#" class="theme-btn purchase-btn">Подключить тариф</a>
        </div>
    </div>
</div>