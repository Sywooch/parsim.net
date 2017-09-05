<header class="page-header" id="comments-list">
  <h2 class="comments-title"> <?= $model->commentCount; ?> thoughts on “<span><?= $model->title; ?></span>”</h2> 
</header>
<ol class="comment-list media-list">
  <?php foreach ($model->comments as $key => $comment){
    if($comment->parent_id==null){
      $class='comment even thread-odd thread-alt depth-1';
      if(isset($comment->comments)){
        $class='comment even thread-even depth-1 parent';
      }
      echo $this->render('_comment',[
        'model'=>$comment,
        'class'=>$class
      ]);  
    }
  } ?>
</ol>