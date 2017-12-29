<div>
  <table class="table">
    <thead>
      <tr>
        <th width="300px"><?= Yii::t('app','Name'); ?></th>
        <th width="300px"><?= Yii::t('app','Period'); ?></th>
        <th width="300px"><?= Yii::t('app','Price per period'); ?></th>
        <th width="300px"><?= Yii::t('app','Host limit'); ?></th>
        <th width="300px"><?= Yii::t('app','Price per extra host'); ?></th>
        <th width="300px"><?= Yii::t('app','Pars limit'); ?></th>
        <th width="300px"><?= Yii::t('app','Price per extra pars'); ?></th>
        <th width="300px"><?= Yii::t('app','Qty'); ?></th>
        
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