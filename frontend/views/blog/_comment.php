<li class="<?= $class; ?>">
  <article class="comment-body media">
    <div class="media-body">
      <div class="media-body-wrap panel panel-default">
        <div class="panel-heading clearfix">
          <a class="pull-left" href="#"> <img src="/images/user-3.jpg" width="50" height="50" alt="Ethan" class="avatar alignnone photo"> </a>
          <h5 class="media-heading"><cite class="fn"><?= $model->authorName; ?></cite> <span class="says"><?= Yii::t('app','says');?>:</span></h5>
          <div class="comment-meta">
            <a href="#">
              <time datetime="<?= $model->getCreatedDateTime('yyyy-MM-dd HH:mm:ssxxx'); ?>"><?= $model->createdDate; ?></time>
            </a>
          </div>
        </div>
        <div class="comment-content panel-body">
          <?= $model->content; ?>
        </div>
        <footer class="reply comment-reply panel-footer"><a class="comment-reply-link" href="#respond" data-id="<?= $model->id; ?>" aria-label="<?= Yii::t('app','Reply to');?> <?= $model->authorName; ?>"><?= Yii::t('app','Reply');?></a></footer>
      </div>
    </div>
  </article>
  <?php if(count($model->comments)>0): ?>
    <ul class="children">
      <?php
      foreach ($model->comments as $key => $comment) {
        echo $this->render('_comment',[
          'model'=>$comment,
          'class'=>'comment odd alt depth-2'
        ]); 
      }
      ?>
    </ul>
  <?php endif; ?>
</li>  