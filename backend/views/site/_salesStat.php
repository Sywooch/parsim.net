<div class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">Sales stats</h6>
    <div class="heading-elements">
      <span class="heading-text">Ammount: <span class="text-bold text-danger-600 position-right">$4,378</span></span>
      <ul class="icons-list">
        <li class="dropdown text-muted">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
            <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
            <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>

  <div class="panel-body">
    <div id="sales-heatmap"></div>
  </div>

  <div class="table-responsive">
    <?= $this->render('_salesStatLoop',['dataProvider'=>$dataProvider]); ?>
  </div>
</div>