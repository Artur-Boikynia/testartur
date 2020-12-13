<?php


namespace app\components\validation;


class CompareValidation extends AbstractValidatin
{
    private string $comparator = '';


    /**
     * CompareValidation constructor.
     * @param string $comparator
     */
    public function __construct(string $comparator){
        $this->comparator = $comparator;
    }

    /**
     * @param string $key
     * @param array $data
     */
    public function validation (string $key, array $data):void{
        if($data[$key] !== $data[$this->comparator]){
            $this->errors[] = " Password \"{$data[$key]}\" is not repeated";
        }
        else{
            $this->valid[] = $data[$key];
        }
    }
}