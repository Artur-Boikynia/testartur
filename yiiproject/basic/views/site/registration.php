<?php

use yii\web\View;
use app\models\forms\RegistrationForm;
use yii\bootstrap\ActiveForm;
/**
 * @var View $this
 * @var RegistrationForm $model
 */

?>

<?php $form = ActiveForm::begin(['method' => 'post']) ?>
    <?= $form->field($model, 'email')->textInput()?>
    <?= $form->field($model, 'name')->textInput()?>
    <?= $form->field($model, 'surname')->textInput()?>
    <?= $form->field($model, 'password')->passwordInput()?>
    <?= $form->field($model, 'repeatPassword')->passwordInput()?>
    <?= \yii\bootstrap\Html::submitButton('Registration', ['class' => 'btn btn-primary'])?>
<?php ActiveForm::end() ?>

