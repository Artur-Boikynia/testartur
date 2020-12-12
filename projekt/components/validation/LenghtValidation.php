<?php


namespace app\components\validation;


class LenghtValidation extends AbstractValidatin
{
    private int $min = 0;
    private int $max = 0;

    /**
     * LenghtValidation constructor.
     * @param int $min
     * @param int $max
     */
    public function __construct(int $min, int $max){
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param string $key
     * @param array $data
     */
    public function validation (string $key, array $data):void{
        if(strlen($data[$key]) < $this->min){
            $this->errors[] = "String {$data[$key]} should be min {$this->min} symbols";
        }
        elseif(strlen($data[$key]) > $this->max){
            $this->errors[] = "String {$data[$key]} should be max {$this->min} symbols";
        }
        else{
            $this->valid[] = $data[$key];
        }
    }
}