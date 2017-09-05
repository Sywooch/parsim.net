<div class="col-sm-4">
  <article class="place-box card">
    <a href="<?= $model->viewUrl; ?>" class="place-link">
      <header>
        <h3 class="entry-title"><i class="fa fa-map-marker"></i><?= $model->name; ?></h3> </header>
      <div class="entry-thumbnail"> <?= $model->getImg('sm'); ?></div>
    </a>
  </article>
</div>