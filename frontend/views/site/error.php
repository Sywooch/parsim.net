<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['bodyClass']="error-404 no-hero-image";
?>

<!-- Main content
================================================== -->
<section class="main container">
    <div class="error-container error-404 not-found">
        <header class="page-header">
            <h2 class="page-title"><?= $name; ?></h2>
            <p class="lead"><?= nl2br(Html::encode($message)) ?></p>
        </header><!-- .page-header -->

        <div class="404-search-box">
            <p>Try looking somewhere else and you might get lucky!</p>
            <form role="search" method="get" class="search-form form-inline">
                <div class="form-group">
                    <input type="search" class="search-field form-control" placeholder="Search..." value="" name="s">
                    <input type="submit" class="search-submit btn btn-default" value="Search">
                </div>
            </form>
            <br>
            <br>
        </div>

    </div>

</section> <!-- /.main -->
