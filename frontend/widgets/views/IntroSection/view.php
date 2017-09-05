<?php
  $mainInfo=$model->getMainInfo();
?>
<!-- Intro Section
================================================== -->
 <?php if(isset($mainInfo)): ?>
  <div class="intro">
    <?= $mainInfo->teaser;?>
    <div class="entry-content"><?= $mainInfo->content; ?></div>
  </div>
  <?php endif; ?>