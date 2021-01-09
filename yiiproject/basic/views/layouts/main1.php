<?php
use yii\web\View;
use app\assets\AppAsset;
use yii\helpers\Html;
use app\assets\MainAsset;
use \yii\bootstrap\NavBar;
use \yii\bootstrap\Nav;
use app\controllers\UsersController;
use app\widgets\Language;
use mdm\admin\components\MenuHelper;
use yii\base\Widget;
use yii\widgets\ActiveForm;
use app\models\entities\Yiiusers;

/**
 * @var View $this
 * @var string $content
 * @var Yiiusers $model
 */

$this->registerAssetBundle(MainAsset::class);

?>

<?php $this->beginPage() ?>

<!doctype html>
<html lang="en">

  <head>
    <meta charset="<?= Yii::$app->charset ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <?php $this->head() ?>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/dashboard/">
      <style>
          html, body {
              height: 100%;
              background: white;
          }
      </style>
    <?php $this->registerCsrfMetaTags() ?>
    <?=$title = Html::encode($this->title) ?>
    <title><?= Yii::t('app', $title) ?></title>


    <!-- Bootstrap core CSS -->
<!--    <link href="../../web/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--    <link href="../../web/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
<!--    <link href="../../web/css/dashboard.css" rel="stylesheet">-->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><![endif]-->
<!--    <script src="../../web/JS/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <![endif]-->
  </head>

  <body>
  <?php $this->beginBody() ?>

  <?php
  NavBar::begin([
      'brandLabel' => Yii::$app->name,
      'brandUrl' => Yii::$app->homeUrl,
      'options' => [
          'class' => 'navbar navbar-inverse navbar-fixed-top',
      ],
  ]);

  echo Nav::widget([
      'options' => ['class' => 'nav navbar-nav navbar-right'],
//      'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id),
      'items' => [
          ['label' => 'Search Users', 'url' => ['/users/index']],
          ['label' => 'About', 'url' => ['/site/about']],
          ['label' => 'Contact', 'url' => ['/site/contact']],
          Html::tag('li', \app\widgets\Acess::widget()),
          Yii::$app->user->can('login') ? (
          ['label' => 'Login', 'url' => ['/site/login']]
          ) :
              (
              '<li>'
              . Html::beginForm(['/site/logout'], 'post')
              . Html::submitButton(
                  'Logout (' . Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname .  ')',
                  ['class' => 'btn btn-link logout']
              )
              . Html::endForm()
              . '</li>'
              ),
          Html::tag('li', Language::widget()),
      ],
  ]);
  NavBar::end();
  ?>

  <?php if (!Yii::$app->user->isGuest): ?>

      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-3 col-md-2 sidebar">

                  <div class="placeholder">
                      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="100" height="100" class="img-responsive" alt="Generic placeholder thumbnail">
                      <h4><?php echo Yii::$app->user->identity->name . ' ' .  Yii::$app->user->identity->surname?></h4>
                      <span class="text-muted">Something else</span>
                  </div>


               <!--   <?php /*$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) */?>

                  <?/*= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) */?>

                  <button>Submit</button>

                  --><?php /*ActiveForm::end() */?>


                  <?php
                  echo Nav::widget([
                      'options' => ['class' => 'nav nav-sidebar'],
                      'items' => [
//                          ['label' => 'Home', 'url' => ['/site/registration']],
                          ['label' => 'About', 'url' => ['/users/view?id=' . Yii::$app->user->identity->id]],
                          ['label' => 'Programming languages', 'url' => ['programminglanguages/view?id=' . Yii::$app->user->identity->id]],
//                          ['label' => 'Contact', 'url' => ['/site/contact']],
                      ],
                  ]);
                  ?>
              </div>
          </div>
      </div>

  <?php endif; ?>

<!--  <div style="text-align: right" class="col-lg-3">
      <?/*=  Nav::widget([
          'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
      ]);
      */?>
  </div>-->

  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <?= $content ?>
  </div>

   <!-- <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?/*= $content */?>
        </div>
      </div>
    </div>-->

  <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>