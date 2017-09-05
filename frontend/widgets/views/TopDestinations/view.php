<aside id="nav_menu-5" class="widget widget_nav_menu">
  <h3 class="widget-title"><?= Yii::t('app','Top Destinations'); ?></h3>
  <div class="menu-top-destinations-container">
    <ul id="menu-top-destinations" class="menu">
      <?php foreach ($items as $item): ?>
      <li class="menu-item"><a href="<?= $item->viewUrl; ?>"><?= $item->name; ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</aside>