<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th><?= Yii::t('app','ID'); ?></th>
        <th><?= Yii::t('app','Request URL'); ?></th>
        <th><?= Yii::t('app','Freq'); ?></th>
        <th><?= Yii::t('app','Response URL'); ?></th>
        <th><?= Yii::t('app','Response E-mail'); ?></th>
        <th><?= Yii::t('app','Responses'); ?></th>
        <th><?= Yii::t('app','Tarif'); ?></th>
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