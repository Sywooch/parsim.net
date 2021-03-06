<?php
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
//use common\models\User;

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/email-confirm', 'token' => $model->email_confirm_token]);
?>
<!-- 2 -->
<tr>
  <td background="http://parsim.net/images/email/hello.png" style="background: url('http://parsim.net/images/email/hello.png'); background-position: center top;background-repeat: no-repeat;background-size: cover;background-color:#1a284d" valign="top">
    <!--[if gte mso 9]>
    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:800px;height:560px;">
    <v:fill type="tile" src="images/logo-bg.jpg" color="#6e4f72" />
    <v:textbox inset="0,0,0,0">
    <![endif]-->
    <div>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="spacer-ad-width" width="79"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1"/></td>
          <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td height="300"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
              </tr>
            </table>
          </td>
          <td class="spacer-ad-width" width="79">
            <img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" />
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

        <td width="34"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
        <td>
          <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td height="67"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>

            <tr>
              <td style="text-align: center;color:#484854; font-family: 'Lato', sans-serif;font-size:30px; font-weight: 300;">
                Привет!!
              </td>
            </tr>

            <tr>
              <td height="10"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>

            <tr>
              <td style="text-align: center;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 300; word-spacing: 1px;">
                <p ">Добро пожаловать в <span style="font-weight: 700;color:#000">Parsim <span style="color:#ff5926;">NET</span></span></p>
              </td>
            </tr>
            

            <tr>
              <td height="20"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: center;color:#444; font-family: 'Lato', sans-serif;font-size:16px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Мы получили от Вас первый запрос спарсить страницу</p>
              </td>
            </tr>
            <tr>
              <td height="60"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#000; font-family: 'Lato', sans-serif;font-size:18px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  <?= $request_url; ?>
                </p>
              </td>
            </tr>
            <tr>
              <td height="10"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#444; font-family: 'Lato', sans-serif;font-size:13px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Через пару минтут мы обработаем запрос и отправим результат на этот E-mail!
              </td>
            </tr>
            <tr>
              <td height="60"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align:left;color:#000; font-family: 'Lato', sans-serif;font-size:16px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Уже сейчас Вы можете управлять своими запросами парсинга в личном кабинете
                </p>
              </td>
            </tr>
            <tr>
              <td height="20"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">Логин - <b><?= $model->email; ?></b></p>
              </td>
            </tr>

            <tr>
              <td height="20"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">Пароль -  <b><?= $password; ?></b></p>
              </td>
            </tr>

            
              

            <tr>
              <td height="80"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: center;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <a href="<?= $manageUrl; ?>" style="text-decoration: none; padding:15px 40px; width: 40%; height: 60px; background: none; color: #1f2936; border: 2px solid #2b3d5e;">
                   Войти в личный кабинет
                </a>
              </td>
              
            </tr>

            <tr>
              <td height="62"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
          </table>
        </td>

        <td width="34"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>

      </tr>
    </table>
  </td>
</tr>