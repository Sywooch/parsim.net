<?php
  use common\models\Parser;

  $period=[
    'prev'=>['begin'=>strtotime('first day of last month'),'end'=>strtotime('-1 month')],
    'current'=>['begin'=>strtotime('first day of this month'),'end'=>strtotime(Date('Y-m-d H:i:s'))]
  ];

  $newParsers=Parser::find()->where(['status'=>Parser::STATUS_NEW])->all();
  $fixParsers=Parser::find()->where(['status'=>Parser::STATUS_FIXING])->all();

  $newParsersCount=count($newParsers);
  $fixParsersCount=count($fixParsers);

  $parserCount=count(Parser::find()->where(['between', 'created_at', $period['current']['begin'], $period['current']['end']])->all());
  $parserPrev=count(Parser::find()->where(['between', 'created_at', $period['prev']['begin'], $period['prev']['end']])->all());

?>
<div class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">Парсеры</h6>
    <div class="heading-elements">
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-lg text-nowrap">
      <tbody>
        <tr>
          <td class="col-md-5">
            <div class="media-left">
              <div id="campaigns-donut"></div>
            </div>

            <div class="media-left">
              <h5 class="text-semibold no-margin"><?= $parserCount; ?> <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+16.2%)</small></h5>
              <ul class="list-inline list-inline-condensed no-margin">
                <li>
                  <span class="status-mark border-success"></span>
                </li>
                <li>
                  <span class="text-muted">Новых парсеров по отношению к <?= Yii::$app->formatter->asDate( Date('Y-m-d',$period['prev']['end']) );?></span>
                </li>
              </ul>
            </div>
          </td>

          <td class="col-md-5">
            <div class="media-left">
              <div id="campaign-status-pie"></div>
            </div>

            <div class="media-left">
              <h5 class="text-semibold no-margin">2,458 <small class="text-danger text-size-base"><i class="icon-arrow-down12"></i> (- 4.9%)</small></h5>
              <ul class="list-inline list-inline-condensed no-margin">
                <li>
                  <span class="status-mark border-danger"></span>
                </li>
                <li>
                  <span class="text-muted">Коефф. повторной эксплуатации по отношению к <?= Yii::$app->formatter->asDate( Date('Y-m-d',strtotime("-1 month")) );?></span>
                </li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>  
  </div>

  <?php if( max($newParsersCount, $fixParsersCount)): ?>
  <div class="table-responsive">
    <table class="table text-nowrap">
      <thead>
        <tr>
          <th>Парсер</th>
          <th class="col-md-2">Кол-во пользователей</th>
          <th class="col-md-2">Кол-во ошибок</th>
          <th class="col-md-2">Бюджет</th>
        </tr>
      </thead>
      <tbody>
        <?php if($newParsersCount): ?>
          <tr class="active border-double">
            <td colspan="5">Новые (<?= $newParsersCount; ?>)</td>
            <td class="text-right">
              <span class="progress-meter" id="today-progress" data-progress="30"></span>
            </td>
          </tr>
          <?php foreach ($newParsers as $key => $model): ?>
            <tr>
              <td>
                <div class="media-left">
                  <div class=""><a href="#" class="text-default text-semibold"><?= $model->name; ?></a></div>
                  <div class="text-muted text-size-small">
                    Создан: <?= Yii::$app->formatter->asDate($model->created_at);?>
                  </div>
                </div>
              </td>
              <td><span class="text-muted"><?= $model->orderCount; ?></span></td>
              <td><span class="text-success-600"> <?= $model->errorsCount; ?></span></td>
              <td><h6 class="text-semibold"><?= Yii::$app->formatter->asCurrency($model->ordersAmount); ?></h6></td>
              
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>

        <?php if($fixParsersCount): ?>
          <tr class="active border-double">
            <td colspan="5">На ремонте (<?= $fixParsersCount; ?>)</td>
            <td class="text-right">
              <span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
            </td>
          </tr>
          <?php foreach ($fixParsers as $key => $model): ?>
            <tr>
              <td>
                <div class="media-left">
                  <div class=""><a href="#" class="text-default text-semibold"><?= $model->name; ?></a></div>
                  <div class="text-muted text-size-small">
                    Создан: <?= Yii::$app->formatter->asDate($model->created_at);?>
                  </div>
                </div>
              </td>
              <td><span class="text-muted"><?= $model->orderCount; ?></span></td>
              <td><span class="text-success-600"></i> <?= $model->errorsCount; ?></span></td>
              <td><h6 class="text-semibold"><?= Yii::$app->formatter->asCurrency($model->ordersAmount); ?></h6></td>
              
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>
</div>