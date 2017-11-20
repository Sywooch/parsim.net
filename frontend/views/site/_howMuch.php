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
                        <p>
                            Никакой абонентской платы! <br/>
                            Вы оплачиваете только результативные итерации парсинга. 
                        <p>
                            Если меняется структура целевой страницы, соответствующий парсер переходит в состояние апгрейда (на 30-40 мин.) Оплата его работы возобновляется, после его возвращения в строй.
                        </p>
                            
                        </p>
                        <p>
                            Бюджет, который Вы будете тратить на парсинг, зависит всего от двух вещей:
                        </p>
                    </div>
                    <ul class="list-style-one">
                        <li>Количество URL, которые Вы хотите парсить</li>
                        <li>Интенсивность, парсинга. От нескольких раз в день до одного раза в год</li>
                    </ul>
                    <a href="<?= Order::getPayUrl(); ?>" class="theme-btn btn-style-one">Начать работу</a>
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