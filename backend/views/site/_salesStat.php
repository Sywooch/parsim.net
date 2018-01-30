<div class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">Входящие платежи</h6>
    <div class="heading-elements">
      <span class="heading-text">Итого: <span class="text-bold text-danger-600 position-right">$4,378</span></span>
      <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
        <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
      </button>
    </div>
  </div>

  <div class="panel-body">
    <div id="sales-heatmap"></div>
  </div>

  <div class="table-responsive">
    <?= $this->render('_salesStatLoop',['dataProvider'=>$dataProvider]); ?>
  </div>
</div>