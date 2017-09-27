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
    <link href='https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Poppins:300,400,500,600,700' rel='stylesheet' type='text/css'>
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
            
            <?= $content ?>
          </table>
        </td>
      </tr>
    </table>

    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>

