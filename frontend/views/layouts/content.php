<?php
  use yii\helpers\ArrayHelper;
  use yii\widgets\Menu;

  

  use frontend\assets\AppAsset;
  AppAsset::register($this);


  $menuItems=[]
  
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="page-wrapper">
  
  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Main Header-->
  <header class="<?= (isset($this->params['headerClass'])?$this->params['headerClass']:'main-header header-style-three'); ?>">
    
      <!-- Main Box -->
      <div class="main-box">
        <div class="auto-container">
            <div class="outer-container clearfix">
                  <!--Logo Box-->
                  <div class="logo-box">
                      <div class="logo"><a href="index.html"><img src="/images/logo.png" alt=""></a></div>
                  </div>
                  
                  <!--Nav Outer-->
                  <div class="nav-outer clearfix">
                      <!-- Main Menu -->
                      <nav class="main-menu">
                          <div class="navbar-header">
                              <!-- Toggle Button -->      
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                              </button>
                          </div>
                          
                          <div class="navbar-collapse collapse clearfix">
                              <ul class="navigation clearfix">
                                  <li><a href="/">Home</a></li>
                                  <li><a href="#pricing">Pricing</a></li>
                                  <li><a href="/site/page?view=api">API</a></li>  
                                  <li><a href="/">Support</a></li>  
                                  <li><a href="contact.html">Contact Us</a></li>
                               </ul>
                          </div>
                      </nav>
                      <!-- Main Menu End-->
                      
                      <!--Right Info-->
                      <div class="info-options">
                        <!--Info Block-->
                          <div class="info-block clearfix">
                              <!--Search Box-->
                              <div class="login-box-outer">
                                <a href="">Login</a>
                              </div>
                              <div class="search-box-outer">

                                  <div class="dropdown">
                                      <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
                                      <ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
                                          <li class="panel-outer">
                                              <div class="form-container">
                                                  <form method="post" action="blog.html">
                                                      <div class="form-group">
                                                          <input type="search" name="field-name" value="" placeholder="Search Here" required>
                                                          <button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
                                                      </div>
                                                  </form>
                                              </div>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                              
                              
                          </div>
                      </div>
                      
                  </div>
                  <!--Nav Outer End-->
                  
            </div>    
          </div>
      </div>

  </header>
  <!--End Main Header -->
  <?= $content; ?>
  
  <!--Main Footer-->
  <footer class="main-footer">
    <!--footer upper-->
    <div class="footer-upper">
        <div class="auto-container">
              <div class="row clearfix">
                  <!--Big Column-->
                  <div class="big-column col-md-6 col-sm-12 col-xs-12">
                      <div class="row clearfix">
                      
                          <!--Footer Column-->
                          <div class="footer-column col-md-7 col-sm-6 col-xs-12">
                              <div class="footer-widget about-widget">
                                  <h3><span class="theme_color">12K+</span> Sites <br> Already Connected</h3>
                                  <div class="text"> A talented in-house teams of experts outreach & social media complement the analyticals technical SEO professionals ensuring your business grows organically with hard working & get you better result.</div>
                                  <ul class="social-icon-one">
                                      <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                      <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                      <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                      <li><a href="#"><span class="fa fa-dribbble"></span></a></li>
                                  </ul>
                              </div>
                          </div>
                          
                          <!--Footer Column-->
                          <div class="footer-column col-md-5 col-sm-6 col-xs-12">
                              <div class="footer-widget links-widget">
                                  
                                   <h2>Site Categories</h2>
                                  <div class="widget-content">
                                      <ul class="list">
                                          <li><a href="#">Shops & services</a></li>
                                          <li><a href="#">Search engins</a></li>
                                          <li><a href="#">Blogs & News</a></li>
                                          <li><a href="#">Social networks</a></li>
                                          <li><a href="#">Other services</a></li>
                                      </ul>
                                  </div>
                              </div>
                              
                          </div>
                          
                      </div>
                  </div>
                  <!--Big Column-->
                  <div class="big-column col-md-6 col-sm-12 col-xs-12">
                      <div class="row clearfix">
                      
                          <!--Footer Column-->
                          <div class="footer-column col-md-5 col-sm-6 col-xs-12">
                              <div class="footer-widget links-widget">
                                 <h2>Quick Links</h2>
                                  <div class="widget-content">
                                      <ul class="list">
                                          <li><a href="#">Privacy Policy</a></li>
                                          <li><a href="#">Terms & Condition</a></li>
                                          <li><a href="#">Support</a></li>
                                          <li><a href="#">Refund Policy</a></li>
                                          <li><a href="#">Contact Us</a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          
                          <!--Footer Column-->
                          <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                              <div class="footer-widget address-widget">
                                  <h2>Our Address</h2>
                                  <div class="widget-content">
                                      <ul class="list-style-two">
                                          <li><span class="icon fa fa-map-marker"></span>Nilkhet Market,Dhanmondhi 09 Modhho Dhaka - 1210</li>
                                          <li><span class="icon fa fa-phone"></span>(880) 1723801729</li>
                                          <li><span class="icon">@</span>seoboostinc@comapny.com</li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!--End Footer Upper-->
      
      <!--footer bottom-->
      <div class="footer-bottom">
        <div class="auto-container">
            <div class="copyright">&copy; 2017 <a href="index.html">SEO Boost inc.</a> All Rights Reserved. </div>
          </div>
      </div>
      <!--End Footer Bottom-->
      
  </footer>
  <!--End Main Footer-->
    
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-long-arrow-up"></span></div>
<?php $this->endContent(); ?>
