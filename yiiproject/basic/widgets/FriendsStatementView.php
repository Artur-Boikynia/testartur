<?php


namespace app\widgets;


use app\components\Duration;
use app\models\entities\Yiiusers;
use kartik\icons\Icon;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;
use app\models\entities\StatementToFriendshipEntities;
use Yii;
use app\components\EditPhoto;
class FriendsStatementView extends Widget
{
    public ?View $viewObject = null;
    public array $modelsArray = [];
    public ?StatementToFriendshipEntities $model = null;

    public function init()
    {
        parent::init();


    }

    public function run()
    {
        return $this->template();
    }

    public function template(){

        foreach ($this->modelsArray as $query){

            $queryUserSurname = $query->userAsk->surname;
            $queryUserName = $query->userAsk->name;

            $acceptButton = Html::a(
                Yii::t('app', 'Accept'),
                ['accept-friend' , 'idStatement' => $query->id, 'user_answer_id' => $query->user_answer_id, 'user_ask_id' => $query->user_ask_id],
                ['class' => 'btn btn-primary',
                    'data' => [
                        'method' => 'post',
                    ],
                ]) ;
            $rejectButton = Html::a(
                Yii::t('app', 'Reject'),
                ['reject-friend' , 'idStatement' => $query->id],
                ['class' => 'btn btn-default',
                    'data' => [
                        'method' => 'post',
                    ],
                ]) ;

            $mainImage = EditPhoto::findMainPhoto($query->userAsk->id);

            $image = Html::img(['users/image', 'url' => $mainImage->path], [ 'width' => '100', 'height' => '100', 'class' => 'img-circle']);

            $icon = <<<HTML
                <div class="row">
                    <div class="col-md-8">
                        <div class="thumbnail">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="placeholder">
                                         $image 
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>$queryUserSurname $queryUserName</h3>
                                </div>
                            </div>
                          <div class="caption">
                            <p>$acceptButton $rejectButton</p>
                          </div>
                        </div>
                    </div>
                </div>  
                 
            HTML;

            $template .=<<<HTML
            <div class="row">
                <div class="col-md-4">
              
                </div>
                <div class="col-md-8">
                $icon
                </div>
            </div>      
            HTML;
        }
        return $template;
    }

}

