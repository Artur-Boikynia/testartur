<?php


namespace app\components\validation;


abstract class AbstractValidatin
{
    protected array $errors = [];
    protected array $valid = [];

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getValid(): array
    {
        return $this->valid;
    }

    /**
     * @param string $key
     * @param array $data
     * @return mixed
     */
    abstract public function validation(string $key, array $data);


}