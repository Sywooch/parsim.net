<?php
    use yii\widgets\ActiveForm;
?>

<!--Create  account-->
<section class="login-section alternate light-bg">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Form Column-->
            <div class="col-md-5 col-sm-12 col-xs-12">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                ]); ?>
                    <div class="row clearfix">
                      <div class="column col-md-9 col-sm-12 col-xs-12">
                            <div class="form-group">
                                 <input type="email" name="email" value="" placeholder="Enter Your Email Here..." required="">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" value="" placeholder="Enter Your password Here..." required="">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                      <div class="column col-md-9 col-sm-12 col-xs-12">
                        <button type="submit" class="theme-btn btn-style-two btn-block submit">Sign Up</button>
                      </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Create your free account now and get immediate access to our service.</h2>
                    <div class="dark-text">Qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram.</div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Create  account-->