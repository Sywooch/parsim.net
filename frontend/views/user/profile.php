<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;

//$this->params['htmlClass']="cover";
//$this->params['bodyClass']="login";

?>


<!--Sidebar Page-->
<div class="sidebar-page-container blog-page">
    <div class="auto-container">
        <div class="row clearfix">

            
            
            <!--Content Side-->
            <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <!--Our-Blogs-->
                <div class="our-blogs"> 
                    
                </div>
            </div>

            <!--Sidebar-->
            <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <aside class="sidebar blog-sidebar">
                    
                    <!-- Search Form -->
                    <div class="sidebar-widget search-box">
                        <form method="post" action="contact.html">
                            <div class="form-group">
                                <input type="search" name="search-field" value="" placeholder="Search.." required>
                                <button type="submit"><span class="icon fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                    
                    <!--Blog Category Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                        <div class="sidebar-title">
                            <h2><?= $model->fullName; ?></h2>
                        </div>
                        <ul class="blog-cat">
                            <li><a href="#">Настройки профиля</a></li>
                            <li><a href="#">Мои URL</a></li>
                            <li><a href="#">Оплата</a></li>
                            <li><a href="#">Выход</a></li>
                        </ul>
                    </div>
                    
                </aside>
            </div>
            <!--End Sidebar-->
            
           
            
        </div>
    </div>
</div>
<!--End Sidebar Page-->