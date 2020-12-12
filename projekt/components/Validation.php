<?php


namespace app\components;


use app\components\validation\AbstractValidatin;
use app\exceptions\InvalidException;

class Validation
{
    private array $data = array();
    private array $rules = array();
    private array $keysOfRules = array();
    private array $validData = array();
    private array $falseData = array();

    /**
     * Validation constructor.
     * @param array $data
     * @param array $rules
     * @throws InvalidException
     */
    public function __construct(array $data, array $rules){
        $this->rules = $rules;
        $this->data = $data;
        $this->keysOfRules = array_keys($rules);
        $this->selectKeyForValidation($this->data);
        var_dump($this->getFalseData());
        var_dump($this->getValidData());
    }

    /**
     * @param array $data
     * @throws InvalidException
     */
    public function selectKeyForValidation(array $data):void{
        $keysOfData = array_keys($data);
        foreach ($keysOfData as $value){
          if(in_array($value, $this->keysOfRules)){
              $inKey = $this->rules[$value];
              $this->selectValidator($inKey, $value);
          }
        }
    }

    /**
     * @param array $inKey
     * @param string $mainKey
     * @throws InvalidException
     */
    private function selectValidator(array $inKey, string $mainKey){
        foreach ($inKey as $value){
            if ($value instanceof AbstractValidatin){
                $value->validation($mainKey, $this->data);
                $this->setFalseData($value->getErrors(), $mainKey);
                $this->setValidData($value->getValid(), $mainKey);

            }
            else{
             throw new InvalidException("\"{$value}\" is not instanceof \"AbstractValidatin\"");
            }
        }
    }

    /**
     * @param array $falseData
     * @param string $mainKey
     */
    public function setFalseData(array $falseData, string $mainKey): void
    {   if (empty($falseData)){
            $falseData = null;
        }
        elseif (array_key_exists($mainKey, $this->falseData)) {
           $this->falseData[$mainKey] = array_merge($this->falseData[$mainKey], $falseData);
        }
        else{
            $this->falseData[$mainKey] = $falseData;
        }
    }

    /**
     * @param array $validData
     * @param string $mainKey
     */
    public function setValidData(array $validData, string $mainKey): void
    {
        if (empty($validData)){
            $validData = null;
        }
        elseif (array_key_exists($mainKey, $this->validData)) {
            $this->validData[$mainKey] = array_merge($this->validData[$mainKey], $validData);
        }
        else{
            $this->validData[$mainKey] = $validData;
        }
    }

    /**
     * @return array
     */
    public function getFalseData(): array
    {
        return $this->falseData;
    }

    /**
     * @return array
     */
    public function getValidData(): array
    {
        return $this->validData;
    }


}