<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th><?= Yii::t('app','ID'); ?></th>
        <th><?= Yii::t('app','Date'); ?></th>
        <th><?= Yii::t('app','Msg'); ?></th>
        <th><?= Yii::t('app','Parser'); ?></th>
        <th><?= Yii::t('app','Loader'); ?></th>
        <th><?= Yii::t('app','Request'); ?></th>
        <th><?= Yii::t('app','Response'); ?></th>
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