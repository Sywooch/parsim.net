<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th width="40%"><?= Yii::t('app', 'Name'); ?></th>
        <th width="40%"><?= Yii::t('app', 'Task ID'); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach ($dataProvired->getModels() as $model) {
        echo $this->render('_view',['model'=>$model]);
      }
    ?>
    </tbody>
  </table>
</div>