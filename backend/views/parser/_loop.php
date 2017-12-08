<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th><?= Yii::t('app','Name'); ?></th>
        <th><?= Yii::t('app','Host'); ?></th>
        <th><?= Yii::t('app','Class'); ?></th>
        <th><?= Yii::t('app','Loader'); ?></th>
        <th><?= Yii::t('app','Status'); ?></th>
        <th><?= Yii::t('app','Request count'); ?></th>
        <th width="100px"><?= Yii::t('app','Action'); ?></th>
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