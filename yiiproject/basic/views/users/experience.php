<?php
use yii\helpers\Html;
use app\assets\MainAsset;
use kartik\icons\Icon;
use kartik\form\ActiveForm;
use app\widgets\SkillsView;
use kartik\date\DatePicker;
use app\components\Duration;
use app\widgets\ExperienceView;



/* @var yii\web\View $this */
/* @var app\models\entities\Yiiusers|app\models\forms\RegistrationForm $model */
/* @var app\models\entities\ExperienceEntities $experience */
/* @var array $query */
///* @var app\models\forms\AddSkill $skillsModel */

Icon::map($this);

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yiiusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//\yii\web\YiiAsset::register($this);
$this->registerAssetBundle(MainAsset::class);
?>

<h1> Experience of <?= $model->name . ' ' .   $model->surname?></h1>

<?= ExperienceView::widget([
    'modelsArray' => $query,
])?>


<?php foreach ($query as $queryOne ): ?>
    <div class="panel panel-default">
        <?php if($queryOne->from && $queryOne->to): ?>
            <?php  $years = date_diff(new DateTime($queryOne->from ), new DateTime($queryOne->to))->y?>
            <?php   $months = date_diff(new DateTime($queryOne->from ), new DateTime($queryOne->to))->m?>
            <?php  $days = date_diff(new DateTime($queryOne->from ), new DateTime($queryOne->to))->d?>
            <div class="panel-heading">
                <?= $queryOne->from ?>
                to
                <?= $queryOne->to ?>

                <?php if($years && !$months): ?>

                    <?php if($years): ?>
                        (<?= $years ?>)
                    <?php endif;?>
                <?php endif; ?>

                <?php if($years && $months): ?>
                    <?php $template = Yii::t('app', 'yeas') ?>
                    <?php if($years !== 1): ?>
                        <?php $template = Yii::t('app', 'year') ?>
                    <?php endif; ?>
                    <?php if($months !== 1): ?>
                        <?php $template = Yii::t('app', 'ye') ?>
                    <?php endif; ?>
                    (<?= $years . $template ?>  <?= $months ?> months)
                <?php endif; ?>

                <?php if(!$days && $months): ?>
                    <?php $template = [
                        'months' => Yii::t('app', 'months'),
                    ];
                    ?>

                    <?php if($months == 1): ?>
                        <?php $template['months'] = Yii::t('app', 'month') ?>
                    <?php endif; ?>
                    (<?= $months . PHP_EOL . $template['months'] ?> )
                <?php endif; ?>

                <?php if(!$years && $days && $months): ?>
                    <?php $template = [
                            'months' => Yii::t('app', 'months'),
                            'days' => Yii::t('app', 'days'),
                        ];
                    ?>

                     <?php if($months == 1): ?>
                        <?php $template['months'] = Yii::t('app', 'month') ?>
                     <?php endif; ?>

                    <?php if($days == 1): ?>
                        <?php $template['months'] = Yii::t('app', 'day') ?>
                     <?php endif; ?>

                    <?php if($months == 1): ?>
                        <?php $template = Yii::t('app', 'year') ?>
                     <?php endif; ?>

                    (<?= $months . PHP_EOL. $template['months'] ?>  <?= $days . PHP_EOL. $template['days'] ?>)
                <?php endif; ?>

                <?php if(!$years && !$months && $days): ?>
                    (<?= $days ?> days)
                <?php endif; ?>
            </div>

        <?php elseif ($queryOne->from && !$queryOne->to && $queryOne->to_this_day): ?>
            <?php  $years = date_diff(new DateTime($queryOne->from), new DateTime(date('Y-m-d', time())))->y?>
            <?php   $months = date_diff(new DateTime($queryOne->from ), new DateTime(date('Y-m-d', time())))->m?>
            <?php  $days = date_diff(new DateTime($queryOne->from ), new DateTime(date('Y-m-d', time())))->d?>
            <div class="panel-heading">
                <?= $queryOne->from ?> to Present

                <?php if($years && !$months): ?>
                    (<?= $years ?> years )
                <?php endif; ?>

                <?php if($years && $months): ?>
                    (<?= $years ?> years <?= $months ?> months)
                <?php endif; ?>

                <?php if(!$days && $months): ?>
                    (<?= $months ?> months )
                <?php endif; ?>

                <?php if(!$years && $days && $months): ?>
                    (<?= $months ?> months <?= $days ?>  days)
                <?php endif; ?>

                <?php if(!$years && !$months && $days): ?>
                    (<?= $days ?> days)
                <?php endif; ?>
            </div>

        <?php endif;?>
        <div class="panel-body">
            <h4> Company: <?= $queryOne->company ?> </h4>
            <h5> Post: <?= $queryOne->post ?> </h5>
            <h5> Area of employment: <?= $queryOne->areaOfEmployment ?></h5>
            <div style="text-align: right">
                <?= Html::a(
                    Icon::show('edit', ['class' => 'fa-2x', 'style' => 'color:Black', 'framework' => Icon::FAS]),
                    ['update-experience', 'id' => $model->id, 'update' => true, 'experienceId' =>  $queryOne->id],
                    ['class' => 'text-right',
                        'data' => [
                            'method' => 'post',
                        ],
                    ]) ?>

                <?= Html::a(
                    Icon::show('trash-alt', ['class' => 'fa-2x', 'label' =>'vsd', 'style' => 'color:Black', 'framework' => Icon::FAS]),
                    ['delete-experience' , 'id' => $model->id, 'delete' => true, 'experienceId' =>  $queryOne->id],
                    ['class' => 'text-right',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Add new Experience
</a>

<div class="collapse" id="collapseExample">
    <div style="margin-top: 1%">
        <div class="col-lg-5">
            <?php
            $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]);
            ?>
            <?= $form->field($experience, 'company')
                ->textInput()
                ->input('text')
                ->label(Yii::t('app', 'Company'))
            ?>

            <?= $form->field($experience, 'post')
                ->textInput()
                ->input('text')
                ->label(Yii::t('app', 'Post'))
            ?>

            <?= '<label>Termin:</label>';?>

            <?= $form->field($experience, 'from')
                ->widget(DatePicker::class, [
                    'name' => 'from',
                    'value' => null,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
            ?>

            <?= $form->field($experience, 'to_this_day')
                ->checkbox()
                ->label('To present')
            ?>

            <?= $form->field($experience, 'to')
                ->widget(DatePicker::class, [
                    'name' => 'to',
                    'value' => null,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
            ?>

            <?= $form->field($experience, 'areaOfEmployment')
                ->textarea()
                ->label(Yii::t('app', 'Are of Employment'))
            ?>

            <?= $form->field($experience, 'user_id')->input('integer')->hiddenInput()->label(false);?>

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <?= Html::submitButton('Add', ['class' => 'btn btn-primary mr-1']) ?>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-secondary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

