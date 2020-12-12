<?php


namespace app\components;


use app\exceptions\InvalidException;

class Request
{
    private bool $isPost = false;

    /**
     * Request constructor.
     */
    public function __construct(){
        $this->isPost();
    }

    /**
     * @return array
     * @throws InvalidException
     */
    public function getPost():array{
        if(!$this->isPost){
            throw new InvalidException('Method POST was not sent');
        }
        return $_POST;
    }

    /**
     * @return bool
     */
    public function isPost():bool{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->isPost = true;
            return true;
        }
        else{
            return false;
        }
    }
}