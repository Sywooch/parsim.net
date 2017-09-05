
<div class="col-lg-3 col-md-4 col-sm-6">
  <article class="postg-living tag-memories tag-planning tag-route tag-tips tag-trip">
    <div class="card">
      <header class="entry-header">
        <a href="<?= $model->readMoreUrl; ?>" rel="bookmark">
          <div class="entry-thumbnail" style="background-image: url(<?= $model->getImgUrl('sm'); ?>)"> <?= $model->getImg('sm'); ?></div>
          <h2 class="entry-title"><?= $model->title; ?></h2>
        </a>
      </header>
      <footer class="entry-meta clearfix"> <span class="byline"><i class="fa fa-user"></i> <span class="author vcard"> <?= $model->authorLink; ?></span></span> <span class="posted-on"><?= $model->createdDate; ?></span> </footer>
    </div>
  </article>
</div>