<?php


namespace app\components\db\where;

/**
 * Class AbstractConditionBuilder
 * @package app\components\db\where
 */
abstract class AbstractConditionBuilder
{
    public array $binds = [];

    abstract public function build():string;

    /**
     * @return string
     */
    public function getHash(): string
    {
        return spl_object_id($this) . '_' . mt_rand();
    }

    /**
     * @return array
     */
    public function getBinds(): array
    {
        return $this->binds;
    }
}