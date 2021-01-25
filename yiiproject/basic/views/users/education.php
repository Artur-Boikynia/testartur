<?php
use yii\helpers\Html;
use app\assets\MainAsset;
use kartik\icons\Icon;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use app\widgets\EducationView;



/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model */
/* @var \app\models\entities\HighSchoolEntities $highSchoolModel */
/* @var \app\models\entities\SchoolEntities $schoolModel */
/* @var array $querySchool */
/* @var array $queryHighSchool */

Icon::map($this);

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
?>

<h1> Experience of <?= $model->name . ' ' .   $model->surname?></h1>

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#schoolEducation" data-whatever="@mdo">Add School Education</button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>


    <div class="modal fade" id="schoolEducation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_HORIZONTAL,
                        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
                    ]);
                    ?>
                    <?= $form->field($schoolModel, 'nameOfSchool')
                        ->textInput()
                        ->input('text')
                        ->label(Yii::t('app', 'School'))
                    ?>

                    <?= $form->field($schoolModel, 'place')
                        ->textInput()
                        ->input('text')
                        ->label(Yii::t('app', 'Place'))
                    ?>

                    <?= $form->field($schoolModel, 'specialty')
                        ->textInput()
                        ->input('text')
                        ->label(Yii::t('app', 'Specialty'))
                    ?>
                    <?= $form->field($schoolModel, 'begin')
                        ->widget(DatePicker::class, [
                            'name' => 'from',
                            'value' => null,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ])
                    ?>

                    <?= $form->field($schoolModel, 'to_this_day')
                        ->checkbox()
                        ->label('To present')
                    ?>

                    <?= $form->field($schoolModel, 'end')
                        ->widget(DatePicker::class, [
                            'name' => 'to',
                            'value' => null,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ])
                    ?>
                    <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'btn btn-primary'])?>
                    <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-secondary']) ?>
                    <?php ActiveForm::end();?>
                </div>
            </div>
        </div>
    </div>

<?= EducationView::widget([
    'querySchool' => $querySchool,
    'queryHighSchool' => $queryHighSchool
])?>