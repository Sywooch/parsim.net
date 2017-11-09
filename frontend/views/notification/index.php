<?php
  use frontend\assets\notification\IndexAsset;
  IndexAsset::register($this);

  $this->title='Сообщения';
  $this->params['title']=$this->title;
    
  
  //$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
  $this->params['breadcrumbs'][] = $this->title;
?>

<div class="msg-list">
    <?= $this->render('_loop',['dataProvider'=>$dataProvider]); ?>
</div> 