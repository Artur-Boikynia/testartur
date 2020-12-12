<?php


namespace app\models;


use app\components\App;
use app\components\validation\LenghtValidation;

class RegistrationValidation
{
    /**
     * @return \app\components\validation\LenghtValidation[][]
     */
    private function rules(){
        return [
            'name' => [new LenghtValidation(2,10),new LenghtValidation(3,10)],
            'surname' => [new LenghtValidation(2,10)],
            'password' => [new LenghtValidation(8,20)],
        ];
    }

    /**
     * @param array $data
     */
    public function doValidation(array $data){
        $validator = App::getApp()->setValidation($data,$this->rules());
    }



}