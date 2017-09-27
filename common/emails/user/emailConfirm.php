<?php



/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/email-confirm', 'token' => $user->email_confirm_token]);
?>

<!-- 2 -->
<tr>
  <td background="<?= Yii::$app->params['srcUrl']; ?>/images/hello.png" style="background: url('<?= Yii::$app->params['srcUrl']; ?>/images/hello.png'); background-position: center top;background-repeat: no-repeat;background-size: cover;background-color:#6e4f72" valign="top">
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
              <td style="text-align: center;color:#484854; font-family: 'Lato', sans-serif;font-size:30px; font-weight: 300;">Hello <?= $user->email; ?></td>
            </tr>

            <tr>
              <td height="14"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>

            <tr>
              <td style="text-align: center;color:#767781; font-family: 'Lato', sans-serif;font-size:14px; font-weight: 300; word-spacing: 2px;">
                Благодарим за регистрацию на сайте <?= Yii::$app->name; ?>
              </td>
            </tr>

            <tr>
              <td height="62"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
          </table>
        </td>

        <td width="34"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>

      </tr>
    </table>
  </td>
</tr>