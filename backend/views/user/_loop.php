<div class="">
  <table class="table">
    <thead>
      <tr>
        <th width="250px">Имя</th>
        <th width="100px"><?= Yii::t('app', 'Role'); ?></th>
        <th width="200px"><?= Yii::t('app', 'Registred at'); ?></th>
        <th><?= Yii::t('app', 'Requests'); ?></th>
        <th><?= Yii::t('app', 'Tarif'); ?></th>
        <th><?= Yii::t('app', 'Balanse'); ?></th>
        <th><?= Yii::t('app', 'Total IN'); ?></th>
        <th><?= Yii::t('app', 'Total Out'); ?></th>
        <th width="100px"><?= Yii::t('app', 'Status'); ?></th>
        <th width="100px"><?= Yii::t('app', 'Actions'); ?></th>
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