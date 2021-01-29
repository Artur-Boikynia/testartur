<?php
use yii\helpers\Html;
use app\assets\MainAsset;
use kartik\icons\Icon;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use app\widgets\ExperienceView;


/* @var yii\web\View $this */
///* @var app\models\forms\AddSkill $skillsModel */

Icon::map($this);


//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
?>

<h1> Experience of</h1>

<form action="">
    <div class="chat-result" id="chat-result">

    </div>
</form>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>