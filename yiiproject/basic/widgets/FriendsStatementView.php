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
use app\components\web\checkFriendship;
class FriendsStatementView extends Widget
{
    public ?View $viewObject = null;
    public array $modelsArray = [];
    public ?Yiiusers $model = null;

    public function init()
    {
        parent::init();


    }

    public function run()
    {
        return $this->template();
    }

    public function template(){
        $countQuery = checkFriendship::getQueryCount($this->model->id)?: false;
        $flowIcon = <<<HTML
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Attention!</strong> You have $countQuery friend requests.
                </div>
            HTML;
        /*$headerFriends =<<<HTML
            <h3>Friends</h3>
        HTML;
        $headerRquest =<<<HTML
            <h3>Friend requests</h3>
        HTML;*/

        foreach ($this->modelsArray as $query){

            $userName = Html::a($query->userAsk->surname . PHP_EOL . $query->userAsk->name,
                ['/users/view' , 'id' =>  $query->userAsk->id],
                [
                    'data' => [
                        'method' => 'post',
                    ],
                ]) ;

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
                    <div class="col-md-10">
                        <div class="thumbnail">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="placeholder">
                                         $image 
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>$userName</h3>
                                </div>
                            </div>
                          <div class="caption">
                            <p>$acceptButton $rejectButton</p>
                          </div>
                        </div>
                    </div>
                </div>  
                 
            HTML;

            $layout .=<<<HTML
                <div >
                    $icon
                </div>
                 
            HTML;
        }


        if($countQuery){
            $template = $flowIcon . $layout;
        }
//        $template = $flowIcon . $layout;

        return $template;
    }

}

