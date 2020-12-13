<?php


namespace app\components\validation;


class PasswordValidation extends AbstractValidatin
{
    private string $patern = '';


    /**
     * EmailValidation constructor.
     * @param string $patern
     */
    public function __construct(string $patern){
        $this->patern = $patern;
    }

    /**
     * @param string $key
     * @param array $data
     */
    public function validation (string $key, array $data):void{
        if(!preg_match($this->patern, $data[$key])){
            $this->errors[] = "Password \"{$data[$key]}\" is not valid. It must have Minimum eight characters, at least one uppercase letter, one lowercase letter and one number";
        }
        else{
            $this->valid[] = $data[$key];
        }
    }
}