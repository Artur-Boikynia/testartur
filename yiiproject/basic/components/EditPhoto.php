<?php


namespace app\components;


use app\models\entities\PhotoEntities;
use yii\helpers\FileHelper;


class EditPhoto
{
    public function delete (int $id, string $path):void {
        $photo = new PhotoEntities();
        $photo::deleteAll(['user_id' => $id, 'path' => $path]);
        unlink($path);
    }
}