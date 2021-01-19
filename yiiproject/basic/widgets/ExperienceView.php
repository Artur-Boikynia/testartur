<?php


namespace app\widgets;

use kartik\icons\Icon;
use yii\base\Widget;
use yii\web\View;
use yii\widgets\DetailView;
use Yii;
use app\components\Duration;

class ExperienceView extends Widget
{
    public ? View $viewObject = null;
    public array $modelsArray = [];

    public function init()
    {
        parent::init();
//        Icon::map($this->viewObject);

    }

    public function run()
    {

        return $this->template();

    }

    public function template(){

        foreach ($this->modelsArray as $query){
            $duration = new Duration($query);

            $template .=<<<HTML
                <div class="panel panel-default">
                    <div class="panel-heading">$duration->time</div>
                        <div class="panel-body">
                            <h4> Company:  $query->company </h4>
                            <h5> Post: $query->post  </h5>
                            <h5> Area of employment:  $query->areaOfEmployment </h5>
                            <div style="text-align: right">
                               $duration->updateButtons 
                               $duration->deleteButtons
                            </div>
                        </div>
                </div>
            HTML;
    }
        return $template;
    }

}