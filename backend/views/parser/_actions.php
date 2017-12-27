<?php

  use yii\widgets\Menu;
  use common\models\ParserAction;


?>
<div class="row">
  <div class="col-md-12">
    <div class="tabbable">
      <ul class="nav nav-tabs nav-tabs-highlight" id="action-tabs">
        <?php 
        foreach ($actions as $key => $action){
          echo $this->render('_actionTab',[
            'model'=>$action,
            'key'=>$key,
          ]);
        }
        ?>
        <li >
          <a href="#" data-index="<?= count($actions); ?>" id="btn-add-action"><i class="icon-plus3"></i></a>
        </li>
      </ul>
      

      

      <div class="tab-content" id="action-contents">
        <?php 
        foreach ($actions as $key => $action){
          echo $this->render('_actionContent',[
            'model'=>$action,
            'key'=>$key,
          ]);
        }
        ?>
      </div>
    </div>
    
  </div>
  
</div>