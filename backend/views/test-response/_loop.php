<div>
  <table class="table">
    <thead>
      <tr>
        <th width="100px"><?= Yii::t('app','ID'); ?></th>
        <th><?= Yii::t('app','Data'); ?></th>
        <th width="150px"><?= Yii::t('app','Created at'); ?></th>
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