<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

use common\models\User;
use common\models\Request;

$this->title = 'API';
$this->params['breadcrumbs'][] = $this->title;

//$this->params['htmlClass']="cover";
//$this->params['bodyClass']="login";
$key='{key}';
if(!Yii::$app->user->isGuest){
    $key=Yii::$app->user->identity->auth_key; 
}

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
                            <h2>Использование API</h2>
                            <p class="mt-20">
                                API — универсальное решение для работы с онлайн-парсером ParsimNet. API построено на REST-принципах, работает с реальными объектами и обладает предсказуемым поведением. С помощью этого API Вы можете создавать, корректировать и удалять свои запросы парсига, получаь обновления результатов парсинга, контролировать остаток денежных средств и многое другое.
                            </p>
                            <p>
                                API в качестве основного протокола использует HTTP, а значит, подходит для разработки на любом языке программирования, который умеет работать с HTTP-библиотеками. Для аутентификации используется Key Auth. Ключ аутентификации каждый пользователь получает во время регистрации на сайте ParsimNet.
                            </p>
                            <p>
                                API поддерживает POST, PUT, DELETE и GET-запросы. POST и PUT - запросы используют JSON-аргументы, GET-запросы работают со строками запросов. API всегда возвращает ответ в формате JSON, независимо от типа запроса.
                            </p>
                        </div> 
                        <div class="tab-pane fade" role="tabpanel" id="api-key" aria-labelledby="api-key-tab">
                            <h2>Аутентификация</h2>
                            <p>
                                Для аутентификации запросов используется Auth Key. При каждом обращении к API в строке запросов необходимо передавать параметр key={secret_key}
                            </p>
                            <?php if(Yii::$app->user->isGuest): ?>
                                <p>
                                    Узнать свой {secret_key} Вы можете в <a href="<?= User::getViewProfileUrl(); ?>" class="">личном кабинете</a> ParsimNet.
                                </p>
                                <div class="mt-20">
                                    <a href="<?= User::getSignupUrl(); ?>" class="theme-btn btn-style-five mr-20">Регистрация</a>    
                                    <a href="<?= User::getLoginUrl(); ?>" class="theme-btn btn-style-five">Вход</a>    
                                </div>
                            <?php else: ?>
                                <p>
                                    Вместо {secret_key} используйте свой секретный ключ:
                                </p>
                                <div class="field-value text-center"><?= Yii::$app->user->identity->auth_key; ?></div>
                            <?php endif; ?>    
                        </div> 
                        
                        
                        <div class="tab-pane fade" role="tabpanel" id="create-request" aria-labelledby="create-request-tab">
                            <h2>Создать запрос</h2>
                             <p>Чтобы начать парсить новый URL, необходимо создать объект запрос — Request. Он содержит всю необходимую информацию для запуска нового процесса парсинга (URL целевой страницы, частота парсинга, URL и/или E-mail, куда отправлять результаты парсинга). У запроса линейный жизненный цикл, он последовательно переходит из статуса в статус. Изменение статуса выполняется циклично или единоразово, в зависимости от значения параметра "частота парсинга". </p>
                            <span class="type type__post">post</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln"><?= Url::base(true); ?>/api/requests?key=<?= $key; ?></span></code></pre>
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
                                            <td>key</td>
                                            <td>Строка</td>
                                            <td>Ваш Secret Key</td>
                                        </tr>
                                        <tr>
                                            <td>requestUrl</td>
                                            <td>Строка</td>
                                            <td>Целевой URL, который хотите парсить</td>
                                        </tr>
                                        <tr>
                                            <td>responseUrl</td>
                                            <td>Строка</td>
                                            <td>URL, куда будут отправляться результаты парсинга</td>
                                        </tr>
                                        <tr>
                                            <td>responseEmail</td>
                                            <td>Строка</td>
                                            <td>E-mail, куда будут отправляться результаты парсинга</td>
                                        </tr>
                                        <tr>
                                            <td>frequency</td>
                                            <td>целое число</td>
                                            <td>
                                                Частота парсинга целевого URL. Допустимые значения значения:
                                                <ul>
                                                    <?php foreach (Request::getFreqList() as $value => $name): ?>
                                                    <li><?= ($value==''?'null':$value); ?> - <?= $name; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешной выполнения, API вернет ответ в формате JSON, который будет содержать следущие значения</p>
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
                                                <td>requestId</td>
                                                <td>Строка</td>
                                                <td>Уникальный идентификатор созданного запроса</td>
                                            </tr>
                                            <tr>
                                                <td>requestUrl</td>
                                                <td>Строка</td>
                                                <td>URL адрес целевой страницы</td>
                                            </tr>
                                            <tr>
                                                <td>frequency</td>
                                                <td>Целое число</td>
                                                <td>Частота обработки целевого URL</td>
                                            </tr>
                                            <tr>
                                                <td>responseUrl</td>
                                                <td>Строка</td>
                                                <td>URL, куда будут отправляться результаты парсинга</td>
                                            </tr>
                                            <tr>
                                                <td>responseEmail</td>
                                                <td>Строка</td>
                                                <td>E-mail, куда будут отправляться результаты парсинга</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>Если API не удалось создать Request, API вернет в JSON формате перечень неверно заполненных полей с описание ошибок.</p>
                                

                                <h2 class="mt-20">Пример обращения к API</h2>
                                <pre><code class="hljs bash">$ curl -i <span class="hljs-string">"<?= Url::base(true); ?>/api/requests?key=<?= $key; ?>"</span> \ <br/>-H <span class="hljs-string">"Accept:application/json"</span> \ <br/>-H <span class="hljs-string">"Content-Type:application/json"</span> \<br/>-X POST \<br/><span class="hljs-operator">-d</span> <span class="hljs-string">'{"requestUrl":"http://target-domain.ru/target-path","responseUrl":"http://your-domain.ru/new-path","responseEmail":"mail@your-domain.ru","frequency":"60"}'</span>
                                </code></pre>
                                <p>
                                    <code>requestUrl</code> URL целевой страницы, которую хотите парсить<br/>
                                    <code>responseUrl</code> URL, на который будут отправляться результаты парсинга<br/>
                                    <code>responseEmail</code> E-mail, на который будут отправляться результаты парсинга<br/>
                                    <code>frequency</code> Желаемая частота парсинга<br/>
                                    
                                    <?php if(Yii::$app->user->isGuest): ?>
                                    вместо <code>{key}</code> укажите Ваш API Key<br/>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="update-request" aria-labelledby="update-request-tab">
                            <h2>Изменение запроса</h2>
                            <p>с помощью этого сервиса Вы можете скорректирвать параметры ранее созданного запроса</p>
                            <span class="type type__put">put</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln"><?= Url::base(true); ?>/api/requests/{id}?key=<?= $key; ?></span></code></pre>
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
                                            <td>key</td>
                                            <td>Строка</td>
                                            <td>Ваш Secret Key</td>
                                        </tr>
                                        <tr>
                                            <td>requestId</td>
                                            <td>Строка</td>
                                            <td>Уникальный идентификатор запроса, который хотите изменить</td>
                                        </tr>
                                        <tr>
                                            <td>responseUrl</td>
                                            <td>Строка</td>
                                            <td>Новое значение URL, куда будут отправляться результаты парсинга</td>
                                        </tr>
                                        <tr>
                                            <td>responseEmail</td>
                                            <td>Строка</td>
                                            <td>Новое значение E-mail, куда будут отправляться результаты парсинга</td>
                                        </tr>
                                        <tr>
                                            <td>frequency</td>
                                            <td>целое число</td>
                                            <td>
                                                Новое значение частоты парсинга целевого URL. Допустимые значения значения:
                                                <ul>
                                                    <?php foreach (Request::getFreqList() as $value => $name): ?>
                                                    <li><?= ($value==''?'null':$value); ?> - <?= $name; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешной выполнения, API вернет ответ в формате JSON, который будет содержать следущие значения</p>
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
                                                <td>requestId</td>
                                                <td>Строка</td>
                                                <td>Уникальный идентификатор запроса</td>
                                            </tr>
                                            <tr>
                                                <td>requestUrl</td>
                                                <td>Строка</td>
                                                <td>URL адрес целевой страницы</td>
                                            </tr>
                                            <tr>
                                                <td>frequency</td>
                                                <td>Целое число</td>
                                                <td>Частота обработки целевого URL</td>
                                            </tr>
                                            <tr>
                                                <td>responseUrl</td>
                                                <td>Строка</td>
                                                <td>URL, куда будут отправляться результаты парсинга</td>
                                            </tr>
                                            <tr>
                                                <td>responseEmail</td>
                                                <td>Строка</td>
                                                <td>E-mail, куда будут отправляться результаты парсинга</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>Если API не удалось изменить Request, API вернет в JSON формате перечень неверно заполненных полей с описание ошибок.</p>
                                

                                <h2 class="mt-20">Пример обращения к API</h2>
                                <pre><code class="hljs bash">$ curl -i <span class="hljs-string">"<?= Url::base(true); ?>/api/requests/{requestId}?key=<?= $key; ?>"</span> \ <br/>-H <span class="hljs-string">"Accept:application/json"</span> \ <br/>-H <span class="hljs-string">"Content-Type:application/json"</span> \<br/>-X PUT \<br/><span class="hljs-operator">-d</span> <span class="hljs-string">'{"responseUrl":"http://your-domain.ru/new-path","responseEmail":"mail@your-domain.ru","frequency":"60"}'</span>
                                </code></pre>
                                <p>
                                    <code>requestId</code> ID запроса, который Вы хотите изменить<br/>
                                    <code>responseUrl</code> URL, на который будут отправляться результаты парсинга<br/>
                                    <code>responseEmail</code> E-mail, на который будут отправляться результаты парсинга<br/>
                                    <code>frequency</code> Желаемая частота парсинга<br/>
                                    
                                    <?php if(Yii::$app->user->isGuest): ?>
                                    вместо <code>{key}</code> укажите Ваш API Key<br/>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="delete-request" aria-labelledby="delete-request-tab">
                            <h2>Удаление URL</h2>
                            <p>с помощью этого сервиса Вы можете удалить ранее созданный запрос</p>
                            <span class="type type__delete">Delete</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln"><?= Url::base(true); ?>/api/requests/{requestId}?key=<?= $key; ?></span></code></pre>
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
                                            <td>key</td>
                                            <td>Строка</td>
                                            <td>Ваш Secret Key</td>
                                        </tr>
                                        <tr>
                                            <td>requestId</td>
                                            <td>Строка</td>
                                            <td>Уникальный идентификатор запроса</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешного удаления запроса парсинга URL, API вернет код 204 - No Content в HTTP заголовке</p>
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
                                                <td>requestId</td>
                                                <td>Строка</td>
                                                <td>ID удаленного запроса</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>В случае, если удалить запрос не удалась, API вернет ответ в формате JSON, который будет содержать информацию о ошибке</p>
                                
                                <h2 class="mt-20">Пример обращения к API</h2>
                                <pre><code class="hljs bash">$ curl -i <span class="hljs-string">"<?= Url::base(true); ?>/api/requests/{requestId}?key=<?= $key; ?>"</span> \<br/><span class="hljs-string">-X DELETE</span> \<br/>-H <span class="hljs-string">"Accept:application/json"</span> \<br/>-H <span class="hljs-string">"Content-Type:application/json"</span>
                                </code></pre>
                                <p>
                                    <code>{requestId}</code> ID запроса, который Вы хотите удалить<br/>
                                    
                                    <?php if(Yii::$app->user->isGuest): ?>
                                    вместо <code>{key}</code> укажите Ваш API Key<br/>
                                    <?php endif; ?>
                                </p>

                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="view-request" aria-labelledby="view-request-tab">
                            <h2>Запрос результата парсинга</h2>
                            <p>с помощью этого сервиса Вы можете запросить резулльтат парсинга по ранее созданному запросу</p>
                            <span class="type type__get">GET</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="post" style=""><code><span class="pln"><?= Url::base(true); ?>/api/request/{request_id}?key=<?= $key; ?></span></code></pre>
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
                                            <td>key</td>
                                            <td>Строка</td>
                                            <td>Ваш Secret Key</td>
                                        </tr>
                                        <tr>
                                            <td>request_id</td>
                                            <td>Строка</td>
                                            <td>ID запроса, по которому Вы хотите получить результат парсинга</td>
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
                                                <td>request_id</td>
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
                                                <td>request_id</td>
                                                <td>Строка</td>
                                                <td>ID запроса. Его следует использовать для ручного запроса результатов парсинга</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Пример обращения к API</h2>
                                <pre><code class="hljs bash">$ curl -i <span class="hljs-string">"<?= Url::base(true); ?>/api/requests/{requestId}?key=<?= $key; ?>"</span> \<br/><span class="hljs-string">-X GET</span> \<br/>-H <span class="hljs-string">"Accept:application/json"</span> \<br/>-H <span class="hljs-string">"Content-Type:application/json"</span>
                                </code></pre>
                                <p>
                                    <code>{requestId}</code> ID запроса, по которому Вы хотите запросить результат парсинга<br/>
                                    
                                    <?php if(Yii::$app->user->isGuest): ?>
                                    вместо <code>{key}</code> укажите Ваш API Key<br/>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="list-request" aria-labelledby="list-request-tab">
                            <h2>Мои запросы</h2>
                            <p>с помощью этого сервиса Вы можете получить полный список всех Ваших запросов парсинга</p>
                            <span class="type type__get">GET</span>
                            <pre class="prettyprint language-html prettyprinted" data-type="get" style=""><code><span class="pln"><?= Url::base(true); ?>/api/requests?key=<?= $key; ?></span></code></pre>
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
                                        <td>key</td>
                                        <td>Строка</td>
                                        <td>Ваш Secret Key</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2 class="mt-20">Success</h2>
                                <p>В случае успешного выполнения запроса, API вернет ответ в формате JSON, который будет содержать следущие аттрибуты</p>

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
                                                <td>items</td>
                                                <td>Массив</td>
                                                <td>Массив объектов типа Запрос</td>
                                            </tr>
                                            <tr>
                                                <td colspan=3><b>Атрибуты элементов массива items</b></td>
                                            </tr>
                                            <tr>
                                                <td>requestId</td>
                                                <td>Строка</td>
                                                <td>Уникальный идентификатор запроса</td>
                                            </tr>
                                            <tr>
                                                <td>requestUrl</td>
                                                <td>Строка</td>
                                                <td>URL адрес целевой страницы</td>
                                            </tr>
                                            <tr>
                                                <td>frequency</td>
                                                <td>Целое число</td>
                                                <td>Частота обработки целевого URL</td>
                                            </tr>
                                            <tr>
                                                <td>responseUrl</td>
                                                <td>Строка</td>
                                                <td>URL, куда будут отправляться результаты парсинга</td>
                                            </tr>
                                            <tr>
                                                <td>responseEmail</td>
                                                <td>Строка</td>
                                                <td>E-mail, куда будут отправляться результаты парсинга</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h2 class="mt-20">Fail</h2>
                                <p>В случае, если запрос выполнится с ошибкой, API вернет ответ в формате JSON, который будет содержать описание ошибки</p>
                                
                                <h2 class="mt-20">Пример обращения к API</h2>
                                <pre><code class="hljs bash">$ curl -i <span class="hljs-string">"<?= Url::base(true); ?>/api/requests?key=<?= $key; ?>"</span> \<br/><span class="hljs-string">-X GET</span> \<br/>-H <span class="hljs-string">"Accept:application/json"</span> \<br/>-H <span class="hljs-string">"Content-Type:application/json"</span>
                                </code></pre>
                                <p> 
                                    
                                    <?php if(Yii::$app->user->isGuest): ?>
                                    вместо <code>{key}</code> укажите Ваш API Key<br/>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <aside class="sidebar blog-sidebar">
                    
                    
                    
                    <!--Blog Category Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                        
                        <ul class="blog-cat nav nav-pills nav-stacked">
                            <li>
                                <div class="sidebar-title">
                                    <h2>Общая информация</h2>
                                </div>        
                            </li>
                            <li class="active"><a href="#summary" id="summary-tab" role="tab" data-toggle="tab" aria-controls="summary-tab" aria-expanded="true">Использование API</a></li>
                            <li><a href="#api-key" id="api-key-tab" role="tab" data-toggle="tab" aria-controls="api-key-tab" aria-expanded="true">Аутентификация</a></li>
                            <li>
                                <div class="sidebar-title">
                                    <h2>Парсинг URL</h2>
                                </div>
                            </li>
                            <li><a href="#create-request" id="create-request-tab" role="tab" data-toggle="tab" aria-controls="create-request-tab" aria-expanded="true">Создать запрос</a></li>
                            <li><a href="#update-request" id="update-request-tab" role="tab" data-toggle="tab" aria-controls="update-request-tab" aria-expanded="true">Изменить запрос</a></li>
                            <li><a href="#delete-request" id="delete-request-tab" role="tab" data-toggle="tab" aria-controls="delete-request-tab" aria-expanded="true">Удалить запрос</a></li>
                            <li><a href="#view-request" id="view-request-tab" role="tab" data-toggle="tab" aria-controls="view-request-tab" aria-expanded="true">Получить результаты парсинга</a></li>
                            <li><a href="#list-request" id="list-request-tab" role="tab" data-toggle="tab" aria-controls="list-request-tab" aria-expanded="true">Срисок моих запросов</a></li>
                            <!--
                            <li>
                                <div class="sidebar-title">
                                    <h2>Оплата</h2>
                                </div>
                            </li>
                            <li><a href="#">Текущий остаток средств</a></li>
                            <li><a href="#">Выписка "Начисление - Списание"</a></li>
                            -->
                        </ul>
                    </div>
                </aside>
            </div>
            <!--End Sidebar-->
            
           
            
        </div>
    </div>
</div>
<!--End Sidebar Page-->