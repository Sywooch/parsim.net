<?php
  use frontend\widgets\RateBox;

?>
<article class="media guide-list-item">
  <div class="media-body">
    <h4 class="media-heading"><a href="<?= $model->viewUrl; ?>"><?= $model->name; ?></a></h4>
    <div class="media-description">
      <p><?= $model->teaser; ?></p>
    </div>
    <div class="media-details">
      <ul class="list-inline">
        <li class="destination"><i class="fa fa-map-marker fa-fw"></i> <span><?= $model->location->fullName; ?></span></li>
        <li>
          <?= RateBox::widget([
            'symbol'=>'star',
            'cssClass'=>'rating rating-star',
            'value'=>$model->rate_quality
          ]);?>

        </li>
        <li>
          <?= RateBox::widget([
            'symbol'=>'dollar',
            'cssClass'=>'rating rating-price',
            'value'=>$model->rate_price
          ]);?>
          
        </li>
      </ul>
    </div>
  </div>
  <div class="media-right media-top">
    <a href="<?= $model->viewUrl; ?>">
      <?= $model->getImg('sm',['class'=>'media-object card']); ?>
    </a>
  </div>
</article>