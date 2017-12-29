<div>
  <table class="table">
    <thead>
      <tr>
        <th width="300px"><?= Yii::t('app','Name'); ?></th>
        <th width="300px"><?= Yii::t('app','Price'); ?></th>
        <th width="300px"><?= Yii::t('app','Qty'); ?></th>
        <th width="300px"><?= Yii::t('app','Period'); ?></th>
        <th><?= Yii::t('app','Description'); ?></th>
        <th width="100px"><?= Yii::t('app','Status'); ?></th>
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