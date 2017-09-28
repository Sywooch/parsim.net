<?php
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
//use common\models\User;

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/email-confirm', 'token' => $model->email_confirm_token]);
?>
<!-- 2 -->
<tr>
  <td background="<?= Yii::$app->params['srcUrl']; ?>/images/email/hello.png" style="background: url('<?= Yii::$app->params['srcUrl']; ?>/images/email/hello.png'); background-position: center top;background-repeat: no-repeat;background-size: cover;background-color:#1a284d" valign="top">
    <!--[if gte mso 9]>
    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:800px;height:560px;">
    <v:fill type="tile" src="images/logo-bg.jpg" color="#6e4f72" />
    <v:textbox inset="0,0,0,0">
    <![endif]-->
    <div>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="spacer-ad-width" width="79"><img src="images/blank.gif" alt="" width="1" height="1"/></td>
          <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td height="300"><img src="images/blank.gif" alt="" width="1" height="1" /></td>
              </tr>
            </table>
          </td>
          <td class="spacer-ad-width" width="79">
            <img src="images/blank.gif" alt="" width="1" height="1" />
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
              <td style="text-align: center;color:#484854; font-family: 'Lato', sans-serif;font-size:30px; font-weight: 300;">
                Привет!!
              </td>
            </tr>

            <tr>
              <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>

            <tr>
              <td style="text-align: center;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 300; word-spacing: 1px;">
                <p ">Добро пожаловать в компанию единомышлиников <span style="font-weight: 700;color:#000">Parsim <span style="color:#ff5926;">NET</span></span></p>
              </td>
            </tr>
            

            <tr>
              <td height="50"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#444; font-family: 'Lato', sans-serif;font-size:16px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Мы получили от Вас запрос просканнировать страницу:</p>
              </td>
            </tr>
            <tr>
              <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#000; font-family: 'Lato', sans-serif;font-size:18px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  <?= $request_url; ?>
                </p>
              </td>
            </tr>
            <tr>
              <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#444; font-family: 'Lato', sans-serif;font-size:13px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Через пару минтут результаты сканнирования прийдут на Ваш E-mail!
              </td>
            </tr>
            <tr>
              <td height="50"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align:left;color:#000; font-family: 'Lato', sans-serif;font-size:16px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Ниже Вы найдете краткую информацию о нас и нашем сервисе 
                </p>
              </td>
            </tr>

            <tr>
              <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">МЫ - те, кто испоьзует современные технологии чтобы максимально облегчить себе жизнь</p>
              </td>
            </tr>

            <tr>
              <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">МЫ - те, кто делает сложные вещи максимально простыми в использовании </p>
              </td>
            </tr>

            <tr>
              <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">МЫ - убеждены, что всю рутинную работу должны делать роботы, а человек заниматься ителектуальной деятельностью или отдыхать ;) </p>
              </td>
            </tr>

            <tr>
              <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  МЫ - создали  <span style="font-weight: 700;color:#000">Parsim <span style="color:#ff5926;">NET</span></span> чтобы избавить Вас от необходимости 
                  регулярно просматривать страницы конкурентов поисковые выдачи или новые посты в блогах или соц сетях.
                </p>
              </td>
            </tr>

            <tr>
              <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Теперь Вам достаточно указать URL страницы котрую нужно регулярно сканнировать и URL или E-mail куда присылать результаты сканнирования.
                </p>
              </td>
            </tr>

            <tr>
              <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Полученные результаты Вы легко можете использовать для автоматизации своей деятельности. Так как все они будут приведены к единому формату.
                </p>
              </td>
            </tr>

            <tr>
              <td height="40"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: center;color:#000; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Наши услуги платные, но не кусаются ;)
                </p>
              </td>
            </tr>

            <tr>
              <td height="40"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px; line-height: 22px;">
                <p style="padding: 0px 20px;">
                  В рамках запуска сервиса мы подготовили <b>акцию</b> <span style="color:#ff5926;">"100% - FREE - FOREVER"</span>. Это значит что Вы можете испоользовать 100% функционала абсолютно бесплатно неограниченное количество времени.
                </p>
              </td>
            </tr>

            <tr>
              <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Сколько продлится эта акция мы не знаем. Это напрямую зависит от активности участников.
                </p>
              </td>
            </tr>

            <tr>
              <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Чтобы получить полный доступ к функционалу сервиса, необходимо зарегистрироватся. 
                </p>
              </td>
            </tr>

            <tr>
              <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Вы можете использвать свой E-mail в качестве логина для входа, но для этого Вам необходимо его активирвать.
                </p>
              </td>
            </tr>                     
              

            <tr>
              <td height="80"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: center;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <a href="<?= $confirmLink; ?>" style="text-decoration: none; padding:15px 40px; width: 40%; height: 60px; background: none; color: #1f2936; border: 2px solid #2b3d5e;">
                   Активировать сейчас
                </a>
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