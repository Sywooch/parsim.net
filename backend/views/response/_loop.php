<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th><?= Yii::t('app','ID'); ?></th>
        <th><?= Yii::t('app','Date'); ?></th>
        <th><?= Yii::t('app','URL'); ?></th>
        <th><?= Yii::t('app','DATA'); ?></th>
        <th><?= Yii::t('app','Response to'); ?></th>
        <th><?= Yii::t('app','Status'); ?></th>
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