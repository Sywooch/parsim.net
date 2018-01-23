<?php
    use common\models\Tarif;
    use yii\helpers\Html;
?>
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
                <li>цена за доп. сканнирование - <?= Yii::$app->formatter->asCurrency($model->extra_pars_price); ?></li>
                <li>частота сканнирований до - <?= $model->pars_freq; ?> раз в сутки</li>
                <li>экспорт в XLS - <?= ($model->can_export?'ДА':'НЕТ'); ?></li>
                <li>доступ по API - <?= ($model->api_access?'ДА':'НЕТ'); ?></li>
            </ul>
            <?php 
            if(Yii::$app->user->isGuest){
                echo Html::a('Подключить тариф',$model->activateUrl,['class'=>'theme-btn purchase-btn']);
            }else{
                if(Yii::$app->user->identity->tarif_id==$model->id){
                    echo Html::a('Текущий тариф',$model->activateUrl,['class'=>'theme-btn btn-current-tarif disabled']); 

                }else{
                    echo Html::a('Подключить тариф',$model->activateUrl,['class'=>'theme-btn purchase-btn']);  
                }

            }
            ?>
            
        </div>
    </div>
</div>