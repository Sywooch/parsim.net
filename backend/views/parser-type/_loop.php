<div>
  <table class="table">
    <thead>
      <tr>
        <th><?= Yii::t('app','Name'); ?></th>
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