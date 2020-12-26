<?php
use yii\web\View;
use app\assets\AppAsset;
use yii\helpers\Html;
use app\assets\MainAsset;
use \yii\bootstrap\NavBar;
use \yii\bootstrap\Nav;

/**
 * @var $this View
 * @var $content string
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
      'items' => [
          ['label' => 'Home', 'url' => ['/site/index']],
          ['label' => 'About', 'url' => ['/site/about']],
          ['label' => 'Contact', 'url' => ['/site/contact']],
          Yii::$app->user->isGuest ? (
          ['label' => 'Login', 'url' => ['/site/login']]
          ) : (
              '<li>'
              . Html::beginForm(['/site/logout'], 'post')
              . Html::submitButton(
                  'Logout (' . Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname .  ')',
                  ['class' => 'btn btn-link logout']
              )
              . Html::endForm()
              . '</li>'
          ),
      ],
  ]);
  NavBar::end();
  ?>

   <!-- <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>-->
  <?php if (!Yii::$app->user->isGuest): ?>

      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-3 col-md-2 sidebar">

                  <div class="placeholder">
                      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="100" height="100" class="img-responsive" alt="Generic placeholder thumbnail">
                      <h4><?php echo Yii::$app->user->identity->name . ' ' .  Yii::$app->user->identity->surname?></h4>
                      <span class="text-muted">Something else</span>
                  </div>

                  <?php
                  echo Nav::widget([
                      'options' => ['class' => 'nav nav-sidebar'],
                      'items' => [
                          ['label' => 'Home', 'url' => ['/site/registration']],
                          ['label' => 'About', 'url' => ['/site/about']],
                          ['label' => 'Contact', 'url' => ['/site/contact']],
                      ],
                  ]);
                  ?>
              </div>
          </div>
      </div>

  <?php endif; ?>

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