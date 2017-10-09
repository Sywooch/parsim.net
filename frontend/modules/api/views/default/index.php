<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use common\models\User;

$this->title = 'API';
$this->params['breadcrumbs'][] = $this->title;

//$this->params['htmlClass']="cover";
//$this->params['bodyClass']="login";

?>

<!--Page Title-->
<section class="page-title">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Title -->
            <div class="title-column col-md-6 col-sm-8 col-xs-12">
                <h1>API</h1>
            </div>
            <!--Bread Crumb -->
            <div class="breadcrumb-column col-md-6 col-sm-4 col-xs-12">
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">API</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Sidebar Page-->
<div class="sidebar-page-container blog-page">
    <div class="auto-container">
        <div class="row clearfix">

            
            
            <!--Content Side-->
            <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <!--Our-Blogs-->
                <div class="our-blogs"> 
                    <div class="tab-content" id="myTabContent"> 
                        <div class="tab-pane fade active in" role="tabpanel" id="summary" aria-labelledby="summary-tab">
                            <h2>Cхема работы c API</h2>
                            <p class="mt-20">
                                Работа с API строится по принципу запрс - ответ. Все запросы авторизуюся через API Key, который Вы получаете во время регистрации пользователя сайта.
                                Каждому запросу присваивается уникальный ID и сообщается инициатору запроса в момент создания запрса. 
                            </p>
                            <p>
                                На каждый запрос формируется один или несколько ответов. Например, Вы хотите парсить URL: dmain-name.com и получать обновления кадый час. Для этого Вы регистрируете один запрс парсинга и каждый час получаете ответы с обновленными данными.
                            </p>
                            <p>
                                В зависимости от типа запроса ответ может быть получен моментально (синхронный запрс) или через некоторое время (асинхронный запрс). Ответ на асинхронный запрос можно получить одним из способов.
                                <ul>
                                    <li>По мере готовности ответа, он автоматически отправляется на URL для ответа, который был указанный в запрсе.</li>
                                    <li>По мере готовности ответа, он автоматически отправляется на E-mail для ответа, который был указанный в запрсе.</li>
                                    <li>Ответ можно запросить самостоятельно, по ID запрса.</li>
                                </ul>
                            </p>
                        </div> 
                        <div class="tab-pane fade" role="tabpanel" id="api-key" aria-labelledby="api-key-tab">
                            <h2>Получение ключа API</h2>
                            <?php if(Yii::$app->user->isGuest): ?>
                                <p>Для начала работы с <?=Yii::$app->name; ?> API необходимо получить ключаутентификации. Для этого Вам необходимо зарегистрировать учетную запись. Узнать свой ключ аутенификации Вы можете в личном кабинете. Так же ключ будет Вам отправлен на E-mail в процессе регистрации.</p>
                                <div class="mt-20">
                                    <a href="<?= User::getSignupUrl(); ?>" class="theme-btn btn-style-five mr-20">Регистрация</a>    
                                    <a href="<?= User::getLoginUrl(); ?>" class="theme-btn btn-style-five">Вход</a>    
                                </div>
                            <?php else: ?>
                                <p>Все запросы к API <?=Yii::$app->name; ?> авторизуются посредствам Вашего API Key. Ниже указан Ваш API Key. Нажмите на ссылку, чтобы скопировать API Key в буфер обмена.</p>
                                <a href="<?= Yii::$app->user->identity->getProfileUrl(); ?>" class="theme-btn btn-style-five"><?= Yii::$app->user->identity->auth_key; ?></a>    
                            <?php endif; ?>    
                        </div> 
                        
                        <div class="tab-pane fade" role="tabpanel" id="api-test" aria-labelledby="api-test-tab">
                            <h2>Тестирование запросов</h2>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="create-request" aria-labelledby="create-request-tab">
                            <h2>Добавление URL для парсинга</h2>
                            <span class="type type__post">post</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln">https://parsim.net/api/request/create?key={key}</span></code></pre>
                            <h2 class="mt-20">Параметры запрса</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th style="width: 15%">Название</th>
                                        <th style="width: 15%">Тип</th>
                                        <th style="width: 70%">Описание</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>url</td>
                                        <td>Строка</td>
                                        <td>Целевой URL для парсинга</td>
                                      </tr>
                                      <tr>
                                        <td>avisoUrl</td>
                                        <td>Строка</td>
                                        <td>URL для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>avisoEmail</td>
                                        <td>Строка</td>
                                        <td>E-mail для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>frequency</td>
                                        <td>целое число</td>
                                        <td>Частота обновления информации в сутки. Значение 1 соответствует 1 раз в сутки. Максимально возможное значение 24, что соответствует 1 раз в час. Частота обновлений также зависит от действующего тарифа. </td>
                                      </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешной регистрации запроса парсинга URL, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>В случае, если регистрация запроса на парсинг URL не удалась, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="update-request" aria-labelledby="update-request-tab">
                            <h2>Изменение запроса парсинга</h2>
                            <span class="type type__put">put</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln">https://parsim.net/api/request/{request_id}?key={key}</span></code></pre>
                            <h2 class="mt-20">Параметры запрса</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th style="width: 15%">Название</th>
                                        <th style="width: 15%">Тип</th>
                                        <th style="width: 70%">Описание</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>avisoUrl</td>
                                        <td>Строка</td>
                                        <td>URL для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>avisoEmail</td>
                                        <td>Строка</td>
                                        <td>E-mail для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>frequency</td>
                                        <td>целое число</td>
                                        <td>Частота обновления информации в сутки. Значение 1 соответствует 1 раз в сутки. Максимально возможное значение 24, что соответствует 1 раз в час. Частота обновлений также зависит от действующего тарифа. </td>
                                      </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешной регистрации запроса парсинга URL, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>В случае, если регистрация запроса на парсинг URL не удалась, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="delete-request" aria-labelledby="delete-request-tab">
                            <h2>Удаление URL для парсинга</h2>
                            <span class="type type__delete">Delete</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln">https://parsim.net/api/request/{request_id}?key={key}</span></code></pre>
                            <h2 class="mt-20">Параметры запрса</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th style="width: 15%">Название</th>
                                        <th style="width: 15%">Тип</th>
                                        <th style="width: 70%">Описание</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>url</td>
                                        <td>Строка</td>
                                        <td>Целевой URL для парсинга</td>
                                      </tr>
                                      <tr>
                                        <td>avisoUrl</td>
                                        <td>Строка</td>
                                        <td>URL для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>avisoEmail</td>
                                        <td>Строка</td>
                                        <td>E-mail для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>frequency</td>
                                        <td>целое число</td>
                                        <td>Частота обновления информации в сутки. Значение 1 соответствует 1 раз в сутки. Максимально возможное значение 24, что соответствует 1 раз в час. Частота обновлений также зависит от действующего тарифа. </td>
                                      </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешной регистрации запроса парсинга URL, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>В случае, если регистрация запроса на парсинг URL не удалась, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="view-request" aria-labelledby="view-request-tab">
                            <h2>Запрос результата парсинга</h2>
                            <span class="type type__get">GET</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln">https://parsim.net/api/request/{request_id}?key={key}</span></code></pre>
                            <h2 class="mt-20">Параметры запрса</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th style="width: 15%">Название</th>
                                        <th style="width: 15%">Тип</th>
                                        <th style="width: 70%">Описание</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>url</td>
                                        <td>Строка</td>
                                        <td>Целевой URL для парсинга</td>
                                      </tr>
                                      <tr>
                                        <td>avisoUrl</td>
                                        <td>Строка</td>
                                        <td>URL для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>avisoEmail</td>
                                        <td>Строка</td>
                                        <td>E-mail для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>frequency</td>
                                        <td>целое число</td>
                                        <td>Частота обновления информации в сутки. Значение 1 соответствует 1 раз в сутки. Максимально возможное значение 24, что соответствует 1 раз в час. Частота обновлений также зависит от действующего тарифа. </td>
                                      </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешной регистрации запроса парсинга URL, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>В случае, если регистрация запроса на парсинг URL не удалась, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="list-request" aria-labelledby="list-request-tab">
                            <h2>Мои запросы</h2>
                            <span class="type type__get">GET</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln">https://parsim.net/api/request?key={key}</span></code></pre>
                            <h2 class="mt-20">Параметры запрса</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th style="width: 15%">Название</th>
                                        <th style="width: 15%">Тип</th>
                                        <th style="width: 70%">Описание</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>url</td>
                                        <td>Строка</td>
                                        <td>Целевой URL для парсинга</td>
                                      </tr>
                                      <tr>
                                        <td>avisoUrl</td>
                                        <td>Строка</td>
                                        <td>URL для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>avisoEmail</td>
                                        <td>Строка</td>
                                        <td>E-mail для ответа</td>
                                      </tr>
                                      <tr>
                                        <td>frequency</td>
                                        <td>целое число</td>
                                        <td>Частота обновления информации в сутки. Значение 1 соответствует 1 раз в сутки. Максимально возможное значение 24, что соответствует 1 раз в час. Частота обновлений также зависит от действующего тарифа. </td>
                                      </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешной регистрации запроса парсинга URL, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>В случае, если регистрация запроса на парсинг URL не удалась, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th style="width: 15%">Название</th>
                                            <th style="width: 15%">Тип</th>
                                            <th style="width: 70%">Описание</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>id</td>
                                            <td>Строка</td>
                                            <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <aside class="sidebar blog-sidebar">
                    
                    <!-- Search Form -->
                    <div class="sidebar-widget search-box">
                        <form method="post" action="contact.html">
                            <div class="form-group">
                                <input type="search" name="search-field" value="" placeholder="Search.." required>
                                <button type="submit"><span class="icon fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                    
                    <!--Blog Category Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                        
                        <ul class="blog-cat nav nav-pills nav-stacked">
                            <li>
                                <div class="sidebar-title">
                                    <h2>Общая информация</h2>
                                </div>        
                            </li>
                            <li class="active"><a href="#summary" id="summary-tab" role="tab" data-toggle="tab" aria-controls="summary-tab" aria-expanded="true">Схема работы с API</a></li>
                            <li><a href="#api-key" id="api-key-tab" role="tab" data-toggle="tab" aria-controls="api-key-tab" aria-expanded="true">Авторизация</a></li>
                            <li><a href="#api-test" id="api-test-tab" role="tab" data-toggle="tab" aria-controls="api-test-tab" aria-expanded="true">Тестирование запросов</a></li>
                            <li>
                                <div class="sidebar-title">
                                    <h2>Парсинг URL</h2>
                                </div>
                            </li>
                            <li><a href="#create-request" id="create-request-tab" role="tab" data-toggle="tab" aria-controls="create-request-tab" aria-expanded="true">Добавление URL</a></li>
                            <li><a href="#update-request" id="update-request-tab" role="tab" data-toggle="tab" aria-controls="update-request-tab" aria-expanded="true">Изменить запрос</a></li>
                            <li><a href="#delete-request" id="delete-request-tab" role="tab" data-toggle="tab" aria-controls="delete-request-tab" aria-expanded="true">Удалить URL</a></li>
                            <li><a href="#view-request" id="view-request-tab" role="tab" data-toggle="tab" aria-controls="view-request-tab" aria-expanded="true">Запросить результат</a></li>
                            <li><a href="#list-request" id="list-request-tab" role="tab" data-toggle="tab" aria-controls="list-request-tab" aria-expanded="true">Срисок моих запросов</a></li>
                            <li>
                                <div class="sidebar-title">
                                    <h2>Оплата</h2>
                                </div>
                            </li>
                            <li><a href="#">Состояние счета</a></li>
                            <li><a href="#">Отчет "Начисление - Списание"</a></li>
                            <li><a href="#">Текущий тариф</a></li>
                            <li><a href="#">Сменить тариф</a></li>
                            <li><a href="#">Преречень доступных тарифов</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
            <!--End Sidebar-->
            
           
            
        </div>
    </div>
</div>
<!--End Sidebar Page-->