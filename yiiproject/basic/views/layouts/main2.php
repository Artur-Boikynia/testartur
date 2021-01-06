<?php
use yii\web\View;
use app\assets\AppAsset;
use yii\helpers\Html;
use app\assets\MainAsset;
use \yii\bootstrap\NavBar;
use \yii\bootstrap\Nav;
use app\controllers\UsersController;
use app\widgets\Language;
use app\components\getCurrentUser;


/**
 * @var $this View
 * @var $content string
 * @var $usersModel \app\models\entities\Yiiusers;
 *
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
        ['label' => 'Search Users', 'url' => ['/users/index']],
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
        Html::tag('li', Language::widget()),
    ],
]);
NavBar::end();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

            <div class="placeholder">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="100" height="100" class="img-responsive" alt="Generic placeholder thumbnail">
                <h4><?php echo getCurrentUser::$usersModel->name . ' ' . getCurrentUser::$usersModel->surname ?></h4>

                <?php switch(getCurrentUser::$usersModel->is_active == true):
                    case true: ?>
                        <div>
                            <span class="text-danger">Online</span>
                        </div>
                    <?php break; ?>
                    <?php case false: ?>
                        <div>
                            <span class="text-capitalize">Offline</span>
                        </div>
                     <?php break; ?>
                <?php endswitch; ?>

                <?php
                echo Nav::widget([
                    'options' => ['class' => 'nav nav-sidebar'],
                    'items' => [
                        ['label' => 'Main Info', 'url' => ['/users/view?id=' . getCurrentUser::$usersModel->id]],
                        ['label' => 'Programming languages', 'url' => ['programminglanguages/view?id=' . getCurrentUser::$usersModel->id]],
                        ['label' => 'Contact', 'url' => ['/site/contact']],
                    ],
                ]);
                ?>
        </div>
    </div>
</div>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?= $content  ?>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>