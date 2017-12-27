<div class="">
  <table class="table">
    <thead>
      <tr>
        <th><?= Yii::t('app','ID'); ?></th>
        <th><?= Yii::t('app','Date'); ?></th>
        <th><?= Yii::t('app','URL'); ?></th>
        <th><?= Yii::t('app','Parser'); ?></th>
        <th><?= Yii::t('app','Action'); ?></th>
        <th><?= Yii::t('app','Request'); ?></th>
        <th><?= Yii::t('app','Response to'); ?></th>
        <th><?= Yii::t('app','Status'); ?></th>
        <th><?= Yii::t('app','Actions'); ?></th>
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