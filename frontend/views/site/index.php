<?php

use common\models\SignupForm;
use common\models\Tarif;


$this->title = 'Parsim NET';
$this->params['headerClass']="main-header";

$tarif=Tarif::findOne(3);

?>

<!--Main Slider-->
<section class="main-slider main-slider-one">
  
    <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_486_1_wrapper" data-source="gallery">
        <div class="rev_slider fullwidthabanner" id="rev_slider_486_1" data-version="5.4.1">
            <ul>
              
                <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1687" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
                <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="/images/main-slider/image-1.jpg"> 
                
                <div class="tp-caption tp-resizeme" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="nowrap"
                data-fontsize="['64','48','36','24']"
                data-width="none"
                data-hoffset="['0','15','15','15']"
                data-voffset="['250','200','150','90']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <h2>Parsim <span class="theme_color">NET</span> <br> <?= Yii::t('app','for your Business'); ?></h2>
                </div>
                
                <div class="tp-caption" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="normal"
                data-width="['670','670','600','420']"
                data-hoffset="['0','15','15','15']"
                data-voffset="['420','370','300','200']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <div class="text"><?= Yii::t('app','Start working with an SEO company that can provide everything you need to generate awareness, drive traffic, connect with customers, and increase sales'); ?>.</div>
                </div>
                
                <div class="tp-caption tp-resizeme" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['0','15','15','15']"
                data-voffset="['510','460','390','350']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <a href="#" class="theme-btn btn-style-one"><?= Yii::t('app','Learn More'); ?> <span class="icon fa fa-long-arrow-right"></span></a>
                </div>
                
                <div class="tp-caption tp-resizeme ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['0','15','15','15']"
                data-voffset="['90','0','0','0']"
                data-x="['right','right','right','right']"
                data-y="['bottom','bottom','bottom','bottom']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-image-1.png" alt=""></figure>
                </div>
                
                <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme big-ipad-hidden" 
                data-basealign="slide"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="auto"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['0','0','0','0']"
                data-voffset="['0','0','0','0']"
                data-x="['right','right','right','right']"
                data-y="['bottom','bottom','bottom','bottom']"
                data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-image-2.png" alt=""></figure>
                </div>
                
                
                <div class="tp-caption tp-resizeme big-ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['-200','-200','-200','-200']"
                data-voffset="['0','0','0','0']"
                data-x="['left','left','left','left']"
                data-y="['bottom','bottom','bottom','bottom']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[0%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":0,"to":"o:1;","delay":0,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-arrow-2.png" alt=""></figure>
                </div>
                
                <div class="tp-caption tp-resizeme big-ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['500','500','400','250']"
                data-voffset="['-150','-150','-150','-150']"
                data-x="['left','left','left','left']"
                data-y="['middle','middle','middle','middle']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[0%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":0,"to":"o:1;","delay":3000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":0,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-arrow-1.png" alt=""></figure>
                </div>
                
                </li>
                
                <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1688" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-2.jpg" data-title="Slide Title" data-transition="parallaxvertical">
                <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="/images/main-slider/image-2.jpg">
                
                <div class="tp-caption tp-resizeme" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="nowrap"
                data-fontsize="['64','48','36','24']"
                data-width="none"
                data-hoffset="['0','15','15','15']"
                data-voffset="['250','200','150','90']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <h2><?= Yii::t('app','Make Your <br> Business easier'); ?></h2>
                </div>
                
                <div class="tp-caption" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="normal"
                data-width="['670','670','600','420']"
                data-hoffset="['0','15','15','15']"
                data-voffset="['420','370','300','200']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <div class="text"><?= Yii::t('app','Stop wasting your time on routine. All the work on collecting important information on the Internet can be done for you by our parser'); ?></div>
                </div>
                
                <div class="tp-caption tp-resizeme" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['0','15','15','15']"
                data-voffset="['510','460','390','350']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <a href="#" class="theme-btn btn-style-two"><?= Yii::t('app','Learn More'); ?> <span class="icon fa fa-long-arrow-right"></span></a>
                </div>
                
                <div class="tp-caption tp-resizeme ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['0','0','0','0']"
                data-voffset="['0','0','0','0']"
                data-x="['right','right','right','right']"
                data-y="['middle','middle','middle','middle']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":3000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-image-3.png" alt=""></figure>
                </div>
                
                
                <div class="tp-caption tp-resizeme big-ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['-200','-200','-200','-200']"
                data-voffset="['0','0','0','0']"
                data-x="['left','left','left','left']"
                data-y="['bottom','bottom','bottom','bottom']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[0%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":0,"to":"o:1;","delay":0,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-arrow-2.png" alt=""></figure>
                </div>
                
                <div class="tp-caption tp-resizeme big-ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['380','350','280','180']"
                data-voffset="['-150','-150','-150','-150']"
                data-x="['left','left','left','left']"
                data-y="['middle','middle','middle','middle']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[0%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":0,"to":"o:1;","delay":3000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":0,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-arrow-1.png" alt=""></figure>
                </div>
                
                </li>
                
                <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1689" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-3.jpg" data-title="Slide Title" data-transition="parallaxvertical">
                <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="/images/main-slider/image-3.jpg">
                
                <div class="tp-caption tp-resizeme" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="nowrap"
                data-fontsize="['64','48','36','24']"
                data-width="none"
                data-hoffset="['0','15','15','15']"
                data-voffset="['250','200','150','90']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <h2><?= Yii::t('app','Grow your <br> Business with us'); ?></h2>
                </div>
                
                <div class="tp-caption" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="normal"
                data-width="['670','670','600','420']"
                data-hoffset="['0','15','15','15']"
                data-voffset="['420','370','300','200']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <div class="text"><?= Yii::t('app','Our parser is constantly evolving. Every day he learns to analyze more than 20 new resources. Now he is already able to analyze more than 12K Internet resources'); ?></div>
                </div>
                
                <div class="tp-caption tp-resizeme" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="text"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['0','15','15','15']"
                data-voffset="['510','460','390','350']"
                data-x="['left','left','left','left']"
                data-y="['top','top','top','top']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <a href="#" class="theme-btn btn-style-three"><?= Yii::t('app','Learn More'); ?> <span class="icon fa fa-long-arrow-right"></span></a>
                </div>
                
                <div class="tp-caption tp-resizeme ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['0','0','0','0']"
                data-voffset="['0','0','0','0']"
                data-x="['right','right','right','right']"
                data-y="['middle','middle','middle','middle']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":3000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-image-4.png" alt=""></figure>
                </div>
                
                
                <div class="tp-caption tp-resizeme big-ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['-200','-200','-200','-200']"
                data-voffset="['0','0','0','0']"
                data-x="['left','left','left','left']"
                data-y="['bottom','bottom','bottom','bottom']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[0%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":0,"to":"o:1;","delay":0,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-arrow-2.png" alt=""></figure>
                </div>
                
                <div class="tp-caption tp-resizeme big-ipad-hidden" 
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="none"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['400','370','300','200']"
                data-voffset="['-150','-150','-150','-150']"
                data-x="['left','left','left','left']"
                data-y="['middle','middle','middle','middle']"
                data-textalign="['top','top','top','top']"
                data-frames='[{"from":"y:[0%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":0,"to":"o:1;","delay":3000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":0,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                style="z-index: 7; white-space: nowrap;text-transform:left;">
                  <figure class="content-image"><img src="/images/main-slider/content-arrow-1.png" alt=""></figure>
                </div>
                
                </li>
                
            </ul>
            
        </div>
    </div>
</section>
<!--End Main Slider-->

<!--Services Section-->
<section class="services-section" >
  <div class="auto-container">
      <!--Services Title-->
      <div class="services-title">
          <div class="row clearfix">
              <div class="column col-md-6 col-sm-12 col-xs-12">
                  <h2>Parsim <span class="theme_color">NET</span> <br> <?=Yii::t('app','fast & cheap online parser'); ?></h2>
                </div>
                <div class="column col-md-6 col-sm-12 col-xs-12">
                    <div class="text">
                        Наш принципы работы<br/>
                        Как можно проще, удобнее, быстрее, надежней и дешевле.
                        Никакой абонентской платы, оплата только за результат.
                    </div>
                </div>
            </div>
        </div>
        <!--Services Title-->
        
        <div class="row clearfix" >
        
            <!--Services Block-->
            <div class="services-block col-md-4 col-sm-6 col-xs-12">
              <div class="inner-box wow fadeIn" data-wow-duration="1500ms" data-wow-delay="0ms">
                  <div class="icon-box">
                      <span class="icon"><img src="/images/resource/icon-1.png" alt="" /></span>
                    </div>
                    <h3><a href="services-2.html">Просто <br>добавьте URL и получите результат</a></h3>
                    <a href="services-2.html" class="learn-more"><?= Yii::t('app','Learn More'); ?> <span class="arrow fa fa-long-arrow-right"></span></a>
                </div>
            </div>
            
            <!--Services Block-->
            <div class="services-block col-md-4 col-sm-6 col-xs-12">
              <div class="inner-box wow fadeIn" data-wow-duration="1500ms" data-wow-delay="300ms">
                  <div class="icon-box">
                      <span class="icon"><img src="/images/resource/icon-2.png" alt="" /></span>
                    </div>
                    <h3><a href="services-2.html">Быстро <br> добавляем новые парсеры в течении 30 мин. </a></h3>
                    <a href="services-2.html" class="learn-more"><?= Yii::t('app','Learn More'); ?><span class="arrow fa fa-long-arrow-right"></span></a>
                </div>
            </div>
            
            

            <!--Services Block-->
            <div class="services-block col-md-4 col-sm-6 col-xs-12" id="services-block">
                <div class="inner-box wow fadeIn" data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="icon-box">
                        <span class="icon"><img src="/images/resource/icon-3.png" alt="" /></span>
                    </div>
                    <h3><a href="services-2.html">Качествено <br> непрерывный контроль работы парсеров</a></h3>
                    <a href="services-2.html" class="learn-more"><?= Yii::t('app','Learn More'); ?> <span class="arrow fa fa-long-arrow-right"></span></a>
                </div>
            </div>
            
        </div>
        
        <div id="</div>">
        <!--Request Form-->
        <?= $this->render('_request',['model'=>$request]); ?>
        <!--End Request Form-->    
        </div>
        
        
        
    </div>
</section>
<!--End Services Section-->
<!--Business Section-->
<section class="business-section alternate light-bg">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Image Column-->
            <div class="image-column col-md-5 col-sm-12 col-xs-12">
                <div class="image">
                    <img src="/images/resource/business-img.png" alt="" />
                </div>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Почемы Мы лучшие для Вашего бизнеса!!</h2>
                    <div class="dark-text">
                        Мы ценим время и убеждены, что всю рутину должны делать роботы. Мы знаем как это сделать и може избавить Вас от необходимости в этом разбираться. Так, что Вы сможете сфокусироваться только на своем бизнесе.
                    </div>
                    <ul class="list-style-one">
                        <li>Мы не берем абонентской платы! Вы всегда оплачиваете только результативные итерации парсинга.</li>
                        <li>Мы постоянно совершенствуем наши алгоритмы, что означает, что Вы всегда будете получать лучшие и лучшие результаты!</li>
                        <li>Мы - комадна высококвалифицированных IT специалистов, инновации являются неотъемлемой частью нашей бизнес-модели.</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Business Section-->

<!--Marketing Section-->
<section class="business-section alternate">
    <div class="auto-container">
        
        <div class="row clearfix">
            <!--Content Column-->
            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                <h2>Как работает Parsim<span class="theme_color"> NET</span>?</h2>
                    <div class="dark-text">
                        Мы постарались максимально упростить работу с парсером. Для начала работы Вам потребуется совершить несколько простых шагов.
                    </div>
                    <ul class="list-style-one">
                        <li>Зарегистрировать свой аккаунт.</li>
                        <li>Пополнить лицевой счет удобным для Вас способом.</li>
                        <li>В личном кабинете добавить ссылки для парсинга и указать частоту их обработки.</li>
                        <li>Вы можете использовать наш API для автоматизации перечисленных действий и интеграции со своими системами.</li>
                    </ul>
                    
            </div>

            <!--Image Column-->
            <div class="image-column col-md-5 col-md-offset-1 col-sm-12 col-xs-12">
                
                <div class="crumina-module crumina-our-video">
                    <div class="video-thumb">
                        <div class="image"><img src="/images/resource/how-it-work.png" alt="video"></div>
                        <a href="https://www.youtube.com/watch?v=wnJ6LuUFpMo" class="video-control js-popup-iframe">
                            <img src="/images/resource/play.png" alt="play">
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!--End Marketing Section-->

<!--Price Section -->
<section class="business-section alternate light-bg" id="pricing">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Image Column-->
            <div class="image-column col-md-5 col-sm-12 col-xs-12">
                <div class="image">
                    <img src="/images/resource/business-img.png" alt="" />
                </div>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Цена - <?=Yii::$app->formatter->asCurrency($tarif->price); ?> за результат!!</h2>
                    <div class="dark-text">
                        Для начала работы необходимо пополнить лицевой счет. Списание средств будет происходить по результатам успешных итераций парсинга.
                    </div>
                    <ul class="list-style-one">
                        <li>Никакой абоненетской платы! Вы платите только за результат.</li>
                        <li>Контролируйте бюджета в реальном времени. Меняйте количество ссылок для парсинга и частоту их обработки.</li>
                        <li>Принимаем оплату банковскими картами, электронными деньгами, банковские переводы.</li>
                    </ul>
                    <a href="<?= $tarif->orderUrl; ?>" class="theme-btn btn-style-one">Пополнить счет</a>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Price Section-->

<?php if(Yii::$app->user->isGuest): ?>
<!--Create  account-->
<section class="login-section alternate ">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Form Column-->
            <div class="col-md-5 col-sm-12 col-xs-12">
               <?= $this->render('/user/_signupForm',['model'=>$newUser,'autofocus'=>false]); ?>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Создай бесплатный аккаунт и попробуй работу парсера</h2>
                    <div class="dark-text">Для регистрации достаточно указать Ваш E-mail и придумать пароль.</div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Create  account-->
<?php endif; ?>

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