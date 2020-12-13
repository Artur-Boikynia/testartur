<?php


namespace app\components\validation;


class EnumValidation extends AbstractValidatin
{
    const RETURN_STATUS = ['teacher', 'student'];
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
        $lowercase = strtolower($data[$key]);
        if(!in_array($lowercase, self::RETURN_STATUS)){
            $this->errors[] = "\" {$lowercase}\" was not founded in Array";
        }
        else{
            $this->valid[] = $lowercase;
        }
    }


}