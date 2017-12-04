<?php

use yii\helpers\Html;


$this->title = Yii::t('app', 'Request').' '.$model->alias;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->alias

//use backend\assets\parser\ViewAsset;
//ViewAsset::register($this);

?>


<div class="parser-view">

  
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h6 class="panel-title text-semibold"><?= $model->alias; ?></h6>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <label class="text-semibold pr-20">Url:</label><?= $model->request_url; ?>
        </div> 
        
        <div class="col-sm-6">
          <label class="text-semibold pr-20">Response url:</label><?= $model->response_url; ?>
        </div> 
        <div class="col-sm-6">
          <label class="text-semibold pr-20">Response E-mail:</label><?= $model->response_email; ?>
        </div> 
        
      </div>
      <div class="row">
        <div class="col-sm-12">
          <p class="content-group mt-20">Статистика обработки запроса</p>
          <div class="table-responsive">
            <table class="table table-framed">
              <thead>
                <tr>
                  <th width="10px">#</th>
                  <th width="80%">Данныее</th>
                  <th width="100px">Статус</th>
                  <th>Удалить</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($model->responses as $key => $response){
                  echo $this->render('_response',[
                    'seq'=>$key+1,
                    'model'=>$response,
                  ]);
                }?>
              </tbody>
            </table>
          </div>
        </div> 
      </div>
    </div>
    
    <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
      <div class="heading-elements">
        <?= Html::a('Изменить',$model->updateUrl, ['class' => 'btn btn-success heading-btn pull-right']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'alias' => $model->alias], [
              'class' => 'btn btn-danger pull-right',
              'data' => [
                  'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                  'method' => 'post',
              ],
            ]);
        ?>
      </div>
    </div>
  </div>
  
  
</div>


