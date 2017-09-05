<?php
  $sort=[
    'quality_desc'=>'
      <span class="fa fa-fw fa-star"></span>
      <span class="fa fa-fw fa-star"></span>
      <span class="fa fa-fw fa-star"></span>
      <span class="fa fa-fw fa-star"></span>
      <span class="fa fa-fw fa-star"></span>
    ',
    'quality_asc'=>'
      <span class="fa fa-fw fa-star-half-o"></span>
      <span class="fa fa-fw fa-star-o"></span>
      <span class="fa fa-fw fa-star-o"></span>
      <span class="fa fa-fw fa-star-o"></span>
      <span class="fa fa-fw fa-star-o"></span>
    ',
    'price_desc'=>'
      <span class="fa fa-fw fa-usd"></span>
      <span class="fa fa-fw fa-usd"></span>
      <span class="fa fa-fw fa-usd"></span>
      <span class="fa fa-fw fa-usd"></span>
      <span class="fa fa-fw fa-usd"></span>
    ',
    'price_asc'=>'
      <span class="fa fa-fw fa-usd"></span>
      <span class="fa fa-fw fa-usd" style="opacity:.33"></span>
      <span class="fa fa-fw fa-usd" style="opacity:.33"></span>
      <span class="fa fa-fw fa-usd" style="opacity:.33"></span>
      <span class="fa fa-fw fa-usd" style="opacity:.33"></span>
    ',

  ]
?>
<div class="pull-right navbar-right filter-listing"> <span><?= Yii::t('app','Sort by'); ?> </span>
  <div class="btn-group">

    <button type="button" class="btn btn-default btn-sm">
      <?= $sort[$sort_key]; ?>
    </button>

    <button type="button" class="btn btn-default btn-sm dropdown-toggle"
    data-toggle="dropdown" aria-expanded="false">
      <span class="caret"></span>
    </button>

    <ul class="dropdown-menu nav-condensed" role="menu">
      <?php foreach ($sort as $key => $value) {
        echo '<li>';
        echo '<a href="?sort='.$key.'">';
        echo $value;
        echo '</a>';
        echo '</li>';
      }
      ?>
    </ul>
  </div>
</div>