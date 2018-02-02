<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title='URL';
$this->params['title']=$this->title;
  

$this->params['breadcrumbs'][] = ['label' => 'Мои URL', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="request-view">
    <div class="row">
      <div class="col-sm-2">
        <label>Целевой URL :</label>  
      </div>
      <div class="col-sm-10">
        <p><?= $model->request_url; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2">
        <label>Периодичность :</label>  
      </div>
      <div class="col-sm-10">
        
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2">
        <label>URL ответа:</label>  
      </div>
      <div class="col-sm-10">
        <p><?= $model->response_url; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2">
        <label>E-mail ответа:</label>  
      </div>
      <div class="col-sm-10">
        <p><?= $model->response_email; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h3>Результаты парсинга</h3>
      </div>
      <div class="col-sm-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="100px" align="center">ID ответа</th>
                <th width="120px" align="center">Дата ответа</th>
                <th align="center">Результат парсинга</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($model->responses as $key => $response): ?>
              <tr>
                <td><?= $response->alias; ?></td>
                <td><?= date('d.m.y H:i',$response->updated_at); ?></td>
                <td><?= $response->json; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <a href="<?= $model->getUrl('frontend','update'); ?>" class=" theme-btn btn-style-one pull-right">Изменить запрос</a>
      </div>
    </div>
</div>