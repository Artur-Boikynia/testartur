<?php
use yii\helpers\Html;
use app\assets\MainAsset;
use kartik\icons\Icon;
use app\widgets\FriendsStatementView;



/* @var yii\web\View $this */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model */
/* @var app\models\forms\AddSkill $skillsModel */
/* @var array $friendsQuery */

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
Icon::map($this);

?>
<h1> Friends of <?= $model->name . ' ' . $model->surname ?></h1>
<?= FriendsStatementView::widget([
    'modelsArray' => $friendsQuery,
])?>



