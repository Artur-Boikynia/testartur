<?php


namespace app\components;

use app\models\entities\ExperienceEntities;
use SebastianBergmann\CodeCoverage\Report\PHP;
use yii\helpers\Html;
use kartik\icons\Icon;
use Yii;
class Duration
{
    public ? ExperienceEntities $query = null;
    public string $time = '';
    public string $duration = '';
    public string $updateButtons = '';
    public string $deleteButtons = '';

    public function __construct(ExperienceEntities $query){
        $this->query = $query;
        $this->checkTime();
        $this->setTime();
    }

    public function checkTime(){

        if($this->query->to_this_day){
            $this->query->to = null;
            $this->query->save();
        }
    }
    private function setTime(){

        if($this->query->from && $this->query->to_this_day && !$this->query->to){
            $this->time = $this->query->from . PHP_EOL . 'to' . PHP_EOL  . 'present';
        }
        if($this->query->from && $this->query->to){
            $this->time = $this->query->from . PHP_EOL . 'to' . PHP_EOL  . $this->query->to;
        }
        $this->setButtons();
    }

    private function setButtons(){

        $this->updateButtons = Html::a(
            Icon::show('edit', ['class' => 'fa-2x', 'style' => 'color:Black', 'framework' => Icon::FAS]),
            ['update-experience', 'id' => $this->query->user->id, 'update' => true, 'experienceId' => $this->query->id],
            ['class' => 'text-right',
                'data' => [
                    'method' => 'post',
                ],
            ]) ;

        $this->deleteButtons = Html::a(
            Icon::show('trash-alt', ['class' => 'fa-2x', 'label' =>'vsd', 'style' => 'color:Black', 'framework' => Icon::FAS]),
            ['delete-experience' , 'id' => $this->query->user->id, 'delete' => true, 'experienceId' => $this->query->id],
            ['class' => 'text-right',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ;

    }
    private function setDuration(){
//        $this->duration =
    }

}