<?php
  foreach ($dataProvired->getModels() as $model){
    echo $this->render('_view',['model'=>$model]);
  }
?>