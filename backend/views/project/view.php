<?php

use yii\helpers\Html;


$project=$model->getRoot();


$this->title = Yii::t('app', 'Update task').' '.$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['/project/index']];
//$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['/project/view', 'alias' => $project->alias]];
$this->params['breadcrumbs'][] = $model->title;
?>

<div class="row">
  <div class="col-lg-9">

    <!-- Task overview -->
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h5 class="panel-title">Tasks of project "<?= $model->title; ?>" <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
          <a href="<?= $model->createTaskUrl; ?>" class="btn bg-blue btn-xs btn-icon legitRipple"><i class="icon-plus2"></i></a>
        </div>
      </div>

      <div class="panel-body">
        
        <?= $this->render('/task/index',['model'=>$model]); ?>

      </div>

        <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
        <div class="heading-elements">
          <ul class="list-inline list-inline-condensed heading-text">
            <li><span class="status-mark border-blue position-left"></span> Show tassks with status:</li>
            <li class="dropdown">
              <a href="#" class="text-default text-semibold dropdown-toggle" data-toggle="dropdown">All<span class="caret"></span></a>
              <ul class="dropdown-menu active">
                <li class="active"><a href="#">All</a></li>
                <li class="divider"></li>
                <li><a href="#">Dublicate</a></li>
                <li><a href="#">Invalid</a></li>
                <li><a href="#">Wontfix</a></li>
              </ul>
            </li>
          </ul>
          <ul class="pagination pagination-flat pagination-xs pull-right">
            <li><a href="#" class="legitRipple">←</a></li>
            <li><a href="#" class="legitRipple">1</a></li>
            <li class="active"><a href="#" class="legitRipple">2</a></li>
            <li><a href="#" class="legitRipple">3</a></li>
            <li><a href="#" class="legitRipple">→</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /task overview -->
  </div>

  <div class="col-lg-3">
    <!-- Project details -->
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-files-empty position-left"></i> Project details<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
        <div class="heading-elements">
          
        </div>
      </div>

      <table class="table table-borderless table-xs content-group-sm">
        <tbody>
          <tr>
            <td><i class="icon-briefcase position-left"></i> Project name:</td>
            <td class="text-right"><span class="pull-right"><a href="<?= $model->updateUrl; ?>"><?= $model->title; ?></a></span></td>
          </tr>
          <tr>
            <td><i class="icon-key position-left"></i> Project key:</td>
            <td class="text-right"><span class="pull-right"><?= $model->alias; ?></span></td>
          </tr>
          <tr>
            <td><i class="icon-alarm-add position-left"></i> Updated:</td>
            <td class="text-right">12 May, 2015</td>
          </tr>
          <tr>
            <td><i class="icon-alarm-check position-left"></i> Created:</td>
            <td class="text-right">25 Feb, 2015</td>
          </tr>
          <tr>
            <td><i class="icon-circles2 position-left"></i> Priority:</td>
            <td class="text-right">
              <div class="btn-group">
                <a href="#" class="label label-danger dropdown-toggle" data-toggle="dropdown">Highest <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><span class="status-mark position-left bg-danger"></span> Highest priority</a></li>
                  <li><a href="#"><span class="status-mark position-left bg-info"></span> High priority</a></li>
                  <li><a href="#"><span class="status-mark position-left bg-primary"></span> Normal priority</a></li>
                  <li><a href="#"><span class="status-mark position-left bg-success"></span> Low priority</a></li>
                </ul>
              </div>
            </td>
          </tr>
          <tr>
            <td><i class="icon-history position-left"></i> Revisions:</td>
            <td class="text-right">29</td>
          </tr>
          <tr>
            <td><i class="icon-file-plus position-left"></i> Added by:</td>
            <td class="text-right"><a href="#">Winnie</a></td>
          </tr>
          <tr>
            <td><i class="icon-file-check position-left"></i> Status:</td>
            <td class="text-right">Published</td>
          </tr>
        </tbody>
      </table>

        <div class="panel-footer panel-footer-condensed"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
        <div class="heading-elements">
          <ul class="list-inline list-inline-condensed heading-text">
            <li><a href="#" class="text-default"><i class="icon-pencil7"></i></a></li>
            <li><a href="#" class="text-default"><i class="icon-bin"></i></a></li>
          </ul>

          <ul class="list-inline list-inline-condensed heading-text pull-right">
            <li><a href="#" class="text-default"><i class="icon-statistics"></i></a></li>
            <li class="dropdown">
              <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i><span class="caret"></span></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#"><i class="icon-alarm-add"></i> Check in</a></li>
                <li><a href="#"><i class="icon-attachment"></i> Attach screenshot</a></li>
                <li><a href="#"><i class="icon-user-plus"></i> Assign users</a></li>
                <li><a href="#"><i class="icon-warning2"></i> Report</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Project details -->
  </div>
</div>