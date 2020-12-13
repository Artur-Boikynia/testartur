<?php


namespace app\models;


use app\components\App;
use app\components\validation\CompareValidation;
use app\components\validation\EnumValidation;
use app\components\validation\LenghtValidation;
use app\components\validation\EmailValidation;
use app\components\validation\UpperValidation;
use app\components\validation\PasswordValidation;

class RegistrationValidation
{
    /**
     * @return \app\components\validation\LenghtValidation[][]
     */
    private function rules(){
        return [
            'email' => [new EmailValidation("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix")],
            'name' => [
                new LenghtValidation(2,10),
                new UpperValidation(),
                ],
            'surname' => [
                new LenghtValidation(2,10),
                new UpperValidation(),
            ],
            'password' => [new PasswordValidation("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&_])[A-Za-z\d@$!%*#?&_]{8,}$/")],
            'repeated-password' => [
                new PasswordValidation("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&_])[A-Za-z\d@$!%*#?&_]{8,}$/"),
                new CompareValidation('password')
            ],
            'status' => [new EnumValidation()],
        ];
    }

    /**
     * @param array $data
     */
    public function doValidation(array $data){
        $validator = App::getApp()->setValidation($data,$this->rules());
    }



}