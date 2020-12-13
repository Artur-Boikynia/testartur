<?php


namespace app\components\validation;


class EmailValidation extends AbstractValidatin
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
            $this->errors[] = "Email \"{$data[$key]}\" is not valid";
        }
        else{
            $this->valid[] = $data[$key];
        }
    }
}