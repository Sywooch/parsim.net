<div class="user-menu">
  <div class="user-name"><span><img src="/images/dashboard-avatar.jpg" alt=""></span><?= Yii::$app->user->identity->fullName; ?></div>
  <ul>
    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/default/index'); ?>"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/message/index'); ?>"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/profile/index'); ?>"><i class="sl sl-icon-user"></i> My Profile</a></li>
    <li><a href="<?= Yii::$app->urlManager->createUrl('/user/logout'); ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
  </ul>
</div>