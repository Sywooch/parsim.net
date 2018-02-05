<?php

use app\modules\main\Module;

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
$order=$owner->currentOrder;
$tarif=$order->tarif;

$time_unit=[
  'day'=>'день',
  'month'=>'месяц',
  'year'=>'год',
];

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
          <td class="spacer-ad-width" width="79"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/blank.gif" alt="" width="1" height="1"/></td>
          <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td height="300"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/blank.gif" alt="" width="1" height="1" /></td>
              </tr>
            </table>
          </td>
          <td class="spacer-ad-width" width="79">
            <img src="<?= Yii::$app->params['srcUrl']; ?>/images/blank.gif" alt="" width="1" height="1" />
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
                <span style="font-weight: 700;color:#000">Parsim <span style="color:#ff5926;">NET</span></span>
              </td>
            </tr>
            
            <tr>
              <td height="20"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align:center;color:#444; font-family: 'Lato', sans-serif;font-size:16px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Создан новый парсе.</p>
              </td>
            </tr>
            <tr>
              <td height="10"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align:center;color:#000; font-family: 'Lato', sans-serif;font-size:16px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  <?= $model->name; ?>
              </td>
            </tr>
            <tr>
              <td height="50"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#000; font-family: 'Lato', sans-serif;font-size:18px; font-weight: 500; word-spacing: 1px;">
                <p style="padding: 0px 20px;">
                  Информация о инициаторе.
                </p>
                
              </td>
              
            </tr>
            <tr>
              <td height="10"><img src="http://parsim.net/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: left;color:#444; font-family: 'Lato', sans-serif;font-size:16px; font-weight: 500; word-spacing: 1px; padding:0 20px;">
                <table width="100%" border="1px">
                  <thead>
                    <tr>
                      <th width="20%" align="center" style="padding:10px;">Имя</th>
                      <th width="50%" align="center" style="padding:10px;">Информация о оплате</th>
                      <th width="10%" align="center" style="padding:10px;">Ко-во запросов</th>
                      <th width="20%" align="center" style="padding:10px;">Остаток на счету</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?= $owner->fullName; ?></td>
                      <td>Оплачен период с <?= Yii::$app->formatter->asDate($order->begin); ?> по <?= Yii::$app->formatter->asDate($order->end); ?> по тарифу "<?= $tarif->name; ?> - <?= Yii::$app->formatter->asCurrency($tarif->price); ?>/<?= $time_unit[$tarif->time_unit]; ?>" </td>
                      <td><?= count($owner->requests); ?></td>
                      <td><?= Yii::$app->formatter->asCurrency($owner->balanse); ?></td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td height="80"><img src="<?= Yii::$app->params['srcUrl']; ?>/images/email/blank.gif" alt="" width="1" height="1" /></td>
            </tr>
            <tr>
              <td style="text-align: center;color:#767781; font-family: 'Lato', sans-serif;font-size:20px; font-weight: 400; word-spacing: 1px;">
                <a href="<?= $updateUrl; ?>" style="text-decoration: none; padding:15px 40px; width: 40%; height: 60px; background: none; color: #1f2936; border: 2px solid #2b3d5e;">
                   Настроить парсер.
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