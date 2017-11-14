<!--Subscribe Style One-->
<section class="subscribe-style-one">
  <div class="auto-container">
      <div class="row clearfix">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h2><?= Yii::t('app','Sign up for our newsletter to get update'); ?></h2>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <form method="post" action="contact.html">
                    <div class="form-group">
                        <input type="email" name="email" value="" placeholder="<?= Yii::t('app','Enter your E-mail'); ?> ..." required>
                        <button type="submit" class="theme-btn"><span class="icon flaticon-send-message-button"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--End Subscribe Style One-->