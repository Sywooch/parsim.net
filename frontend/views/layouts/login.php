<?php
  use frontend\assets\LoginAsset;
  LoginAsset::register($this);
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<?= $content; ?>
<?php $this->endContent(); ?>
