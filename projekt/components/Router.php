<?php
namespace app\components;

use app\components\Dispatcher;
use app\exceptions\FalseVariablesException;
use app\exceptions\InvalidException;
use app\controllers\TeacherController;

/**
 * Class Router
 * @package app\components
 */
class Router
{
    /**
     * @var \app\components\Dispatcher|null
     */
    private ?Dispatcher $dispatcher = null;

    /**
     * Router constructor.
     * @param \app\components\Dispatcher $dispatcher
     * @throws FalseVariablesException
     * @throws InvalidException
     */
    public function __construct( Dispatcher $dispatcher ){
        $this->dispatcher = $dispatcher;
        $this->doAction();
    }

    /**
     * @throws FalseVariablesException
     * @throws InvalidException
     */
    private function doAction(){
        if(!($this->dispatcher instanceof Dispatcher)){
            throw new FalseVariablesException('Variable has false type');
        }

        $nameOfController = $this->dispatcher->getController();

        if(!class_exists($nameOfController)){
            throw new InvalidException("Class \"{$nameOfController}\" is invalid");
        }

        $class = new $nameOfController();
        $nameOfMethod = $this->dispatcher->getMethod();

        if(!method_exists($nameOfController, $nameOfMethod)){
            throw new InvalidException("Method \"{$nameOfMethod}\" is invalid");
        }

        $goAction = $class->$nameOfMethod();
    }

}