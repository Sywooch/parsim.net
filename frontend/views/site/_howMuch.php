<?php
    use common\models\Tarif;
    use common\models\Order;
?>
<!--Price Section -->
<section class="business-section  " id="pricing">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Цена - <?=Yii::$app->formatter->asCurrency(Tarif::getDefaultPrice()); ?> за результат!!</h2>
                    <div class="dark-text">
                        Для начала работы необходимо пополнить лицевой счет. Списание средств будет происходить по результатам успешных итераций парсинга.
                    </div>
                    <ul class="list-style-one">
                        <li>Никакой абоненетской платы! Вы платите только за результат.</li>
                        <li>Контролируйте бюджета в реальном времени. Меняйте количество ссылок для парсинга и частоту их обработки.</li>
                        <li>Принимаем оплату банковскими картами.</li>
                    </ul>
                    <a href="<?= Order::getPayUrl(); ?>" class="theme-btn btn-style-one">Пополнить счет</a>
                </div>
            </div>
            <!--Image Column-->
            <div class="image-column col-md-5 col-sm-12 col-xs-12">
                <div class="image">
                    <img src="/images/resource/business-img.png" alt="" />
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Price Section-->