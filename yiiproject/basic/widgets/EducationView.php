<?php


namespace app\widgets;


use app\components\FriendsTemplate;
use app\components\web\checkFriendship;
use app\models\entities\Yiiusers;
use app\components\getEducationParams;
use Yii;

class EducationView extends \yii\base\Widget
{
    public array $querySchool = [];
    public array $queryHighSchool = [];


    public function init()
    {
        parent::init();


    }

    public function run()
    {
        return $this->template();
    }

    public function template(){




        foreach ($this->querySchool as $query){
            $objectSchool = new getEducationParams($query);
            $objectSchool->setHeaderSchool(Yii::t('app', 'School Education'));
            $objectSchool->setDuration($query->begin, $query->end);
            $objectSchool->setSpecialty($query->specialty);
            $objectSchool->setNameOfSchool($query->nameOfSchool);
            $objectSchool->setNameOfPlace($query->place);
            $templateSchool .= <<<HTML
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                              <div class="col-md-11">$objectSchool->duration</div>
                              <div class="col-md-1">$objectSchool->deleteButtons</div>
                        </div>
                    </div>
                        <div class="panel-body">
                            <h5>$objectSchool->nameOfSchool</h5>
                            <h5>$objectSchool->specialty</h5>
                            <h5>$objectSchool->nameOfPlace</h5>
                        </div>
                </div>
            HTML;

        }

    foreach ($this->queryHighSchool as $query){
        $objectSchool->setDuration($query->begin, $query->end);
        $objectSchool->setNameOfUni($query->nameOfUni);
        $objectSchool->setSpecialty($query->specialty);
        $objectSchool->setNameOfFaculty($query->faculty);
        $objectSchool->setNameOfDepartament($query->departament);

        $templateHighSchool .= <<<HTML
            <div class="panel panel-primary">
                <div class="panel-heading"> <strong>$query->degree $query->specialty</strong> $objectSchool->duration</div>
                <div class="panel-body">
                    <h5>$objectSchool->nameOfUni</h5>
                    <h5>$objectSchool->nameOfPlace</h5>
                    <h5>$objectSchool->nameOfFaculty</h5>
                    <h5>$objectSchool->specialty</h5>
                    <h5>$objectSchool->nameOfDepartament</h5>
                </div>
            </div>
        HTML;
    }

        $schoolView = <<<HTML
            <div class="bs-callout bs-callout-danger" id="callout-overview-dependencies">
                <h4>$objectSchool->headerSchool</h4>
                <p>
                    $templateSchool
                </p>
            </div>
        HTML;

        $uniView = <<<HTML
           <div class="bs-callout bs-callout-uni" id="callout-overview-dependencies">
                <h4>$object->headerHighSchool</h4>
                <p>
                    $templateHighSchool
                </p>
           </div>
        HTML;

        return $schoolView . $uniView ;

    }

}