
<?php $this->beginContent('@app/views/layouts/content.php'); ?>
<!--Sidebar Page-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Sidebar-->
            <div class="sidebar-side col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <aside class="sidebar">
                    
                    <!--URL Links Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                        <div class="sidebar-title">
                            <h2>Мой профиль</h2>
                        </div>
                        <ul class="blog-cat">
                            <li><a href="<?= Yii::$app->user->identity->viewProfileUrl; ?>">Настройки</a></li>
                            <li><a href="<?= Yii::$app->user->identity->changePasswordUrl; ?>">Изменить пароль</a></li>
                            <li><a href="<?= Yii::$app->user->identity->payUrl; ?>">Пополнить счет</a></li>
                            <li><a href="<?= Yii::$app->user->identity->balanseUrl; ?>">История операций</a></li>
                        </ul>
                        <div class="sidebar-title">
                            <h2>Парсинг</h2>
                        </div>
                        <ul class="blog-cat">
                            <li><a href="/request/create">Добавить URL</a></li>
                            <li><a href="/request/index">Мои URL</a></li>
                        </ul>
                        <div class="sidebar-title">
                            <h2>Тех. поддержка</h2>
                        </div>
                        <ul class="blog-cat">
                            <li><a href="/ticket/create">Задать вопрос</a></li>
                            <li><a href="/ticket/index">Мои обращения</a></li>
                        </ul>
                    </div>
                    
                </aside>
            </div>
            <!--End Sidebar-->
            <!--Content Side-->
            <div class="content-side col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <?= $content; ?>
            </div>
        </div>
    </div>
</div>
<!--End Sidebar Page-->
<?php $this->endContent(); ?>
