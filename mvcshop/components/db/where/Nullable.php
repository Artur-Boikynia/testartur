<?php

namespace app\components\db\where;

/**
 * Class Nullable
 * @package app\components\db\where
 */
class Nullable extends AbstractConditionBuilder
{
    private string $field;
    private string $operator;


    /**
     * In constructor.
     * @param string $field
     * @param string $operator
     * @param mixed ...$params
     */
    public function __construct(string $field, string $operator)
    {
        $this->field = $field;
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function build(): string
    {
        $sql = "`{$this->field}` {$this->operator}";

        return $sql;
    }
}
