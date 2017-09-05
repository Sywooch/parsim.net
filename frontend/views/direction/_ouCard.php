 <aside class="snapshot">
    <h5>Address</h5>
    <p>
      <?= $model->location->name; ?>,<br/>
      <?= $model->address; ?>
    </p>
    <h5>Phone</h5>
    <p><?= $model->phone; ?></p>
    <h5>Email</h5>
    <p><?= $model->email; ?></p>
    <h5>Website</h5>
    <p><?= $model->url; ?></p>
    <h5>Work times</h5>
    <p>
    <?php foreach ($model->workTimes as $key => $workTime){
      if($workTime->isOpen){
        echo '<b>'.$workTime->dayOfWeek.'</b>: '.date('H:i',strtotime($workTime->start)).'-'.date('H:i',strtotime($workTime->finish)).'<br>';
      }
    } ?>
    </p>
  </aside>