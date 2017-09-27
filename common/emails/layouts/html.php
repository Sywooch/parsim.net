<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */

?>


<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>
    <style type="text/css">
      .ExternalClass {
        width: 100%;
        background-color: #d9d9d9;
      }

      body {
        font-family: 'Lato', sans-serif;
        font-size: 14px;
        line-height: 1;
        background-color: #d9d9d9;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
        font-family: Helvetica, Arial, sans-serif;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        /*        background: url('images/psd.jpg') center top no-repeat;*/
      }
      #bodyTable {
        height: 100% !important;
        margin: 0;
        padding: 0;
        width: 100% !important;
      }
      table {
        border-collapse: collapse;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        border-spacing: 0;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
      }

      td {
        font-family: 'Lato', sans-serif;
        
        font-size: 14px;
      }

      img {
        border: none;
        outline: none;
        text-decoration: none;
        display: inline-block;
        height: auto
      }
      p {
        margin: 0;
        padding: 0;
      }
      a:hover, td a:hover {
        color: #7a8590;
        outline: none;
      }

      /*Media Queries*/
      @media only screen and (max-width: 799px) {

        body[yahoo] .wrapper {
          width: 100% !important;
        }
        body[yahoo] .santorini {
          font-family: 'Lato', sans-serif;
          font-size: 46px !important;
        }
        body[yahoo] .enjoy {
          float: left !important;
        }
        body[yahoo] .let-spacer {
          height: 120px !important;
        }
        body[yahoo] .spacer-ad {
          height: 20px !important;
        }
        body[yahoo] .spacer-ad-width {
          width: 20px !important;
        }
        body[yahoo] .right {
          float: right !important;
          max-width:111px !important;
        }
        body[yahoo] .center-text{
        text-align:center !important;
        }

      }

      @media only screen and (min-width: 799px) {
        body[yahoo] .logo {
          text-align: left !important;
        }
      }

    </style>
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
    table {border-collapse: collapse;}
    </style>
    <![endif]-->
    <?php $this->head() ?>
  </head>
  <body yahoo="fix" style="background-color:#e9eaed; margin: 0; padding: 0; font-family: 'Lato', sans-serif;  line-height:1;color:#767781;-webkit-text-size-adjust: 100%;" id="bodyTable">
   <?php $this->beginBody() ?>
    <table width="100%" cellpadding="0" cellspacing="0" border="0">

      <tr>
        <td>
          <table class="wrapper" border="0" cellpadding="0" cellspacing="0" align="center" width="800">

            <!-- 1 -->
            <tr>
              <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">

                  <tr>
                    <td height="15"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                  </tr>

                  <tr>
                    <td>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td align="center" style="font-family: 'Lato', sans-serif;font-size:12px; font-weight: 300;"><span style="color:#000;">Problems viewing?</span><a style="color:#1b72b5;" href="#">Click to view online</a></td>

                      </tr>
                    </table></td>
                  </tr>

                  <tr>
                    <td height="15"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1"/></td>
                  </tr>
                </table>
              </td>
            </tr>

            <!-- 2 -->
            <tr>
              <td background="images/logo-bg.jpg" style="background: url('images/logo-bg.jpg'); background-position: center top;background-repeat: no-repeat;background-size: cover;background-color:#6e4f72" valign="top">
                <!--[if gte mso 9]>
                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:800px;height:560px;">
                <v:fill type="tile" src="<?= Yii::$app->params['srcUrl']; ?>/images/email/logo-bg.jpg" color="#6e4f72" />
                <v:textbox inset="0,0,0,0">
                <![endif]-->
                <div>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="spacer-ad-width" width="79"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1"/></td>
                      <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                          <tr>
                            <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                          </tr>
                          <tr>
                            <td>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                <tr>
                                  <td style="font-size:0;text-align: center;">
                                    <!--[if (gte mso 9)|(IE)]>
                                    <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                    <td width="319"  valign="top">
                                    <![endif]-->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"  style="display: inline-block;vertical-align: top;width:100%;max-width:319px">
                                      <tr>
                                        <td class="logo" width="319" style="text-align: center"><a href="#"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/logo.png" alt=""  title=" " /></a></td>
                                      </tr>
                                    </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                    </td>
                                    <td width="285"  valign="top">
                                    <![endif]-->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="display: inline-block;vertical-align: top;width:100%;max-width:285px">
                                      <tr>
                                        <td height="11"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                      </tr>
                                      <tr>
                                        <td>
                                        <table style="display: inline-block" align="center" border="0" cellpadding="0" cellspacing="0" >
                                          <tr>
                                            <td style="color:#fff; font-family: 'Lato', sans-serif;font-size:14px; font-weight: 400; text-transform: uppercase;"><a style="text-decoration: none; color:#fff;" href="#">Air</a></td>
                                            <td width="30"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                            <td style="color:#fff; font-family: 'Lato', sans-serif;font-size:14px; font-weight: 400; text-transform: uppercase;"><a href="#" style="text-decoration: none; color:#fff;">Hotel</a></td>
                                            <td width="30"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1"/></td>
                                            <td style="color:#fff; font-family: 'Lato', sans-serif;font-size:14px; font-weight: 400; text-transform: uppercase;"><a style="text-decoration: none; color:#fff;" href="#">Car</a></td>
                                            <td width="30"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1"/></td>
                                            <td style="color:#fff; font-family: 'Lato', sans-serif;font-size:14px; font-weight: 400; text-transform: uppercase;"><a href="#" style="text-decoration: none; color:#fff;" >Vacations</a></td>

                                          </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td height="11"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                      </tr>
                                    </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                    </td>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>

                          <tr>
                            <td height="39"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                          </tr>

                          <tr>
                            <td width="100%" style="color:#fff; text-align: center;font-family: 'Lato', sans-serif;font-size:36px; text-shadow: 4px 2px 0 #323041;">Greece</td>
                          </tr>

                          <tr>
                            <td height="15"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                          </tr>

                          <tr>
                            <td class="santorini" width="100%" style=" text-shadow: 2px 2px 0 #323041; color:#fff; text-align: center;font-family: 'Lato', sans-serif;font-size:90px; text-transform: uppercase; font-weight: 300; letter-spacing: 5px;">Santorini</td>
                          </tr>

                          <tr>
                            <td height="27"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                          </tr>

                          <tr>
                            <td width="100%" style="text-align: center;"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/elipse.png" alt=""  title=" " style="width: 100%"/></td>
                          </tr>

                          <tr>
                            <td height="21"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                          </tr>

                          <tr>
                            <td style="text-align: center;color:#fff;font-family: 'Lato', sans-serif;font-size: 18px; text-shadow: 4px 2px 0 #323041;font-style: italic">from</td>
                          </tr>

                          <tr>
                            <td height="5"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                          </tr>

                          <tr>
                            <td style="text-align: center;color:#fff;font-family: 'Lato', sans-serif;font-size: 72px; text-shadow: 4px 2px 0 #323041; font-weight: 300;"><span style=" font-family: 'Lato', sans-serif;font-size: 45px;  vertical-align: top;">$</span>895</td>
                          </tr>

                          <tr>
                            <td height="35"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                          </tr>

                          <tr>
                            <td align="center">
                            <table width="274" border="0" cellpadding="0" cellspacing="0" >
                              <tr>
                                <td height="73" style="background-color:#add928;font-family: 'Lato', sans-serif;font-size: 30px; color:#000; text-align: center; font-weight:300; text-transform: uppercase;"><a style="text-decoration:none; color:#000;" href="#">Book now</a></td>
                              </tr>
                            </table></td>
                          </tr>

                          <tr>
                            <td height="63"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                          </tr>
                        </table>
                      </td>
                      <td class="spacer-ad-width" width="79">
                        <img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" />
                      </td>
                    </tr>
                  </table>
                </div>
                <!--[if gte mso 9]>
                </v:textbox>
                </v:rect>
                <![endif]-->
              </td>
            </tr>

            <!-- 3 -->
            <tr>
              <td style="background-color: #ffffff;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="<!-- background-color:#fff -->; ">
                  <tr>

                    <td width="34"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                    <td>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td height="67"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                      </tr>

                      <tr>
                        <td style="text-align: center;color:#484854; font-family: 'Lato', sans-serif;font-size:30px; font-weight: 300;">Popular Destinations</td>
                      </tr>

                      <tr>
                        <td height="14"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                      </tr>

                      <tr>
                        <td style="text-align: center;color:#767781; font-family: 'Lato', sans-serif;font-size:14px; font-weight: 300; word-spacing: 2px;">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam</td>
                      </tr>

                      <tr>
                        <td height="62"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                      </tr>

                      <tr>
                        <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>

                            <td style="font-size:0; text-align:center">
                            <!--[if (gte mso 9)|(IE)]>
                            <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                            <tr>
                            <td width="366"  valign="top">
                            <![endif]-->
                            <table cellspacing="0" cellpadding="0" border="0" style="max-width: 366px; vertical-align: top; width:100%; display: inline-block;">
                              <tr>
                                <td width="35"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                <td valign="top">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="13"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                  </tr>
                                  <tr>
                                    <td align="top" width="299" style="text-align: center;"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/best-offer.png" alt=""   width="299"  height="180"/></td>
                                  </tr>

                                  <tr>
                                    <td height="15"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                  </tr>

                                  <tr>
                                    <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="200">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td style="color:#484854; font-weight:300;font-family: 'Lato', sans-serif;font-size:24px; text-align: left;">Crown Casino</td>
                                          </tr>
                                          <tr>
                                            <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                          </tr>
                                          <tr>
                                            <td style="color:#a6a6ae; font-family: 'Lato', sans-serif;font-size:12px; font-weight:300; text-transform: uppercase; letter-spacing: 1px; text-align: left;">Australia</td>
                                          </tr>
                                        </table></td>

                                        <td width="100">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td style="font-family: 'Lato', sans-serif;font-size: 11px; color:#bfbfc4; font-weight: 400;text-align: right; letter-spacing: 1px; text-transform: uppercase; vertical-align: bottom;">from</td>
                                          </tr>
                                          <tr>
                                            <td height="5"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                          </tr>
                                          <tr>
                                            <td style=" font-family: 'Lato', sans-serif;font-size: 30px; font-weight: 400; color:#29292f; text-align: right;"><span style="   vertical-align: top; font-family: 'Lato', sans-serif;font-size: 18px;">$</span>895</td>
                                          </tr>
                                        </table></td>
                                      </tr>
                                    </table></td>
                                  </tr>

                                </table></td>
                                <td width="28"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                              </tr>
                            </table>
                            <!-- B -->
                            <!--[if (gte mso 9)|(IE)]>
                            </td>
                            <td width="366"  valign="top">
                            <![endif]-->
                            <table cellspacing="0" cellpadding="0" border="0" style="max-width: 366px;vertical-align: top; width:100%; display: inline-block;">
                              <tr>
                                <td width="35"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                <td>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                  </tr>
                                  <tr>
                                    <td width="293" style="text-align: center;"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/offer-right.png" alt=""  width="293"  height="173" /></td>
                                  </tr>

                                  <tr>
                                    <td height="15"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                  </tr>

                                  <tr>
                                    <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="200">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td style="color:#484854; font-weight:300;font-family: 'Lato', sans-serif;font-size:24px; text-align: left;">Atlantis - The Palm</td>
                                          </tr>
                                          <tr>
                                            <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                          </tr>
                                          <tr>
                                            <td style="color:#a6a6ae; font-family: 'Lato', sans-serif;font-size:12px; font-weight:300; text-transform: uppercase; letter-spacing: 1px; text-align: left;">Paris</td>
                                          </tr>
                                        </table></td>

                                        <td width="100">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td style="font-family: 'Lato', sans-serif;font-size: 11px; color:#bfbfc4; font-weight: 400;text-align: right; letter-spacing: 1px; text-transform: uppercase; vertical-align: bottom;">from</td>
                                          </tr>
                                          <tr>
                                            <td height="5"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                                          </tr>
                                          <tr>
                                            <td style=" font-family: 'Lato', sans-serif;font-size: 30px; font-weight: 400; color:#29292f; text-align: right;"><span style="   vertical-align: top;font-family: 'Lato', sans-serif;font-size: 18px; ">$</span>315</td>
                                          </tr>
                                        </table></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                                <td width="35"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
                              </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            </td>

                          </tr>
                        </table></td>
                      </tr>

                    </table></td>

                    <td width="34"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>

                  </tr>
                </table>
              </td>
            </tr>

            
            <?= $content ?>
          </table>
        </td>
      </tr>
    </table>

    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>

