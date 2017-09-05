<aside id="recent-posts-4" class="widget widget_recent_entries">
  <h3 class="widget-title"><?= Yii::t('app','From the Blog'); ?></h3>
  <ul>
    <?php foreach ($items as $item): ?>
    <li> <a href="<?= $item->readMoreUrl; ?>"><?= $item->title; ?></a></li>
    <?php endforeach; ?>
  </ul>
</aside>