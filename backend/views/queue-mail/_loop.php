<div>
  <table class="table">
    <thead>
      <tr>
        <th><?= Yii::t('app','Subject'); ?></th>
        <th><?= Yii::t('app','Attempts'); ?></th>
        <th><?= Yii::t('app','Last attempt time'); ?></th>
        <th><?= Yii::t('app','Sent time'); ?></th>
        <th><?= Yii::t('app','Time to send'); ?></th>
        <th><?= Yii::t('app','Created at'); ?></th>
        <th width="100px"><?= Yii::t('app','Actions'); ?></th>
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