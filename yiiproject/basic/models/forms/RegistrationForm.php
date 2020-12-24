<?php


namespace app\models\forms;


class RegistrationForm extends \yii\base\Model
{
    public string $email = '';
    public string $name = '';
    public string $surname = '';
    public string $password = '';
    public string $repeatPassword = '';

    public function rules():array
    {
        return [
        [['email', 'name', 'surname', 'password', 'repeatPassword'], 'required'],
        ['email', 'email'],
//        ['email', 'unique'],
        ['name', 'match', 'pattern' => '/[A-Z]{1}[A-Za-z]*/'],
        ['surname', 'match', 'pattern' => '/[A-Z]{1}[A-Za-z]*/'],
        ['email', 'email'],
        ['password', 'match', 'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&_])[A-Za-z\d@$!%*#?&_]{8,}$/'],
        ['repeatPassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }
}