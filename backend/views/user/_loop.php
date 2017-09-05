<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>E-mail</th>
        <th width="50%"><?= Yii::t('app', 'First name'); ?></th>
        <th width="50%"><?= Yii::t('app', 'Last name'); ?></th>
        <th><?= Yii::t('app', 'Role'); ?></th>
        <th><?= Yii::t('app', 'Status'); ?></th>
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