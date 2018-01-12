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
                <li>Включено источников - <?= $model->host_limit; ?> шт.</li>
                <li>Цена доп. источника - <?= Yii::$app->formatter->asCurrency($model->extra_host_price); ?></li>
                <li>Включено сканнирований - <?= $model->page_limit; ?> шт.</li>
                <li>Цена доп. сканнирования - <?= Yii::$app->formatter->asCurrency($model->price); ?></li>
                <li>Макс. частота сканнирований - <?= Yii::$app->formatter->asCurrency($model->pars_freq); ?> /сутки</li>
                <li>Экспорт в XLS - <?= ($model->can_export?'ДА':'НЕТ'); ?></li>
                <li>Доступ по API - <?= ($model->api_access?'ДА':'НЕТ'); ?></li>
            </ul>
            <a href="#" class="theme-btn purchase-btn">Подключить тариф</a>
        </div>
    </div>
</div>