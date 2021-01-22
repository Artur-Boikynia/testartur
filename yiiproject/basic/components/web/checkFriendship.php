<?php


namespace app\components\web;

use app\models\entities\StatementToFriendshipEntities;
class checkFriendship
{

    public function __construct(){

    }

    /**
     * @param int $user_ask_id
     * @param int $user_answer_id
     * @return StatementToFriendshipEntities|null
     */
    public static function check(int $user_ask_id  , int $user_answer_id){

        $queryModel = new StatementToFriendshipEntities();
        $query = $queryModel::findOne(['user_ask_id' => $user_ask_id, 'user_answer_id' => $user_answer_id]);

        return $query;
    }

    public static function findFriendsQuery(int $user_answer_id){
        $queryModel = new StatementToFriendshipEntities();

        $query = $queryModel::findAll(['user_answer_id' => $user_answer_id]);

        return $query;
    }

    public static function getQueryCount(int $id):int{
        $queryModel = new StatementToFriendshipEntities();

        $count = $queryModel::find()->where(['user_answer_id' => $id])->count();

        return $count;
    }


}