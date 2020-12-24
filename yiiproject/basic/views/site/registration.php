<?php

use yii\web\View;
use app\models\forms\RegistrationForm;
use yii\bootstrap\ActiveForm;

//use yii\imagine\Image;
/**
 * @var View $this
 * @var RegistrationForm $model
 */

?>
<?php

$img = Yii::getAlias('@webroot/images/favicon.ico');
$image = Image::getImagine()->open($img);
?>

<?php $form = ActiveForm::begin(['method' => 'post', 'options'=>['class' => ['form-signin']]]) ?>
    <?= $form->field($model, 'email')
        ->textInput()
        ->input('email', ['placeholder' => "Enter Your Email"])
        ->label(false)
    ?>
    <?= $form->field($model, 'name')
        ->textInput()
        ->input('name', ['placeholder' => "Enter Your Name"])
        ->label(false)
    ?>
    <?= $form->field($model, 'surname')
        ->textInput()
        ->input('surname', ['placeholder' => "Enter Your Surname"])
        ->label(false)?>
    <?= $form->field($model, 'password')
        ->passwordInput()
        ->input('password', ['placeholder' => "Enter Your Password"])
        ->label(false)?>
    <?= $form->field($model, 'repeatPassword')
        ->passwordInput()
        ->input('repeatPassword', ['placeholder' => "Repeat Your Password"])
        ->label(false)?>
    <?= \yii\bootstrap\Html::submitButton('Registration', ['class' => 'btn btn-lg btn-primary btn-block'])?>

<?php
/*echo $form->field($model, 'email', [
    'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control transparent']
])->textInput()->input('email', ['placeholder' => "Enter Your Email"])->label(false); */?>

<?php ActiveForm::end() ?>

