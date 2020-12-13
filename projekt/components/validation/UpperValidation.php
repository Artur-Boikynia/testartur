<?php


namespace app\components\validation;


class UpperValidation extends AbstractValidatin
{
    /**
     * UpperValidation constructor.
     */
    public function __construct(){

    }

    /**
     * @param string $key
     * @param array $data
     */
    public function validation (string $key, array $data):void{
        $first = substr($data[$key],0,1);
        if(!ctype_upper($first)){
            $this->errors[] = "First letter must be upper";
        }
        else{
            $this->valid[] = $first;
        }
    }
}