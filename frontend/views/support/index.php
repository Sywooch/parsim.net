<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Поддержка';
$this->params['breadcrumbs'][] = $this->title;

//$this->params['htmlClass']="cover";
//$this->params['bodyClass']="login";

?>

<!--Page Title-->
    <section class="page-title">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Title -->
                <div class="title-column col-md-6 col-sm-8 col-xs-12">
                    <h1>Поддержка</h1>
                </div>
                <!--Bread Crumb -->
                <div class="breadcrumb-column col-md-6 col-sm-4 col-xs-12">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Поддержка</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->
    
    <!--Faq Section-->
    <section class="faq-section">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!--Faq Column-->
                <div class="faq-column col-md-7 col-sm-12 col-xs-12">
                    
                    <!--Faq Title-->
                    <div class="faq-title">
                        <h2>Frequently Asked Questions</h2>
                        <div class="title-text">Lorem ipsum dolor sit amet, vix natum labitur eleifend, mel ad amet laoreet menandri.</div>
                        <!-- faq Form -->
                        <div class="faq-search-box">
                            <form method="post" action="contact.html">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search" required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
            
                    <!--Accordian Box-->
                    <ul class="accordion-box">
                                    
                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus flaticon-plus-symbol"></span> <span class="icon icon-minus flaticon-minus-symbol"></span></div>How can i get help by carpet?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        <p>Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. some lorem ipsum text qulaity checker.</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn active"><div class="icon-outer"><span class="icon icon-plus flaticon-plus-symbol"></span> <span class="icon icon-minus flaticon-minus-symbol"></span></div>what kind of product tiles are available in capet market?</div>
                            <div class="acc-content current">
                                <div class="content">
                                    <div class="text">
                                        <p>Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. some lorem ipsum text qulaity checker.</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus flaticon-plus-symbol"></span> <span class="icon icon-minus flaticon-minus-symbol"></span></div>Is there any annaul pricing plan rather than monthly plan?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        <p>Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. some lorem ipsum text qulaity checker.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus flaticon-plus-symbol"></span> <span class="icon icon-minus flaticon-minus-symbol"></span></div>Are you plan to open a brance on Dhaka?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        <p>Lorem ipsum dolor sit amet, vix an natum labitur eleifd, mel am laoreet menandri. Ei justo complectitur duo. Ei mundi solet utos soletu possit quo. Sea cu justo laudem. some lorem ipsum text qulaity checker.</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
            
                </div>
                <!--Form Column-->
                <div class="form-column col-md-5 col-sm-12 col-xs-12">
                    <div class="form-inner">
                        <h2>Did’nt Dind the Answear, <br> Submit Your Question </h2>
                        
                        <!--Faq Form-->
                        <div class="faq-form">
                            <form method="post" action="contact.html">
                               <div class="form-group">
                                    <input type="text" name="username" value="" placeholder="Your Name*" required>
                               </div>
                                    
                                <div class="form-group">
                                    <input type="email" name="email" value="" placeholder="Your Mail*" required>
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="subject" value="" placeholder="Subject*">
                                </div>
                                
                                <div class="form-group">
                                    <textarea name="message" placeholder="Your Question*"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-style-one">Submit Question</button>
                                </div>
                               
                            </form>
                        </div>
                        <!--End Faq Form-->
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--End Faq Section-->