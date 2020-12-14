<?php

namespace app\components\db\where;

/**
 * Class In
 * @package app\components\db\where
 */
class In extends AbstractConditionBuilder
{
    private string $field;
    private string $operator;

    /**
     * @var float|int|string
     */
    private $param;

    /**
     * @var float|int|string
     */
    private $to;

    /**
     * Between constructor.
     * @param string $field
     * @param string $operator
     * @param string|int|float $from
     * @param string|int|float $to
     */
    public function __construct(string $field, string $operator, ...$params)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->param = $params;
    }

    /**
     * @return string
     */
    public function build(): string
    {
        $mainString = "`{$this->field}` {$this->operator}";
        $tailString = '';

        foreach ($this->param as $value) {
            $hash = uniqid($this->field);
            $alias = "{$this->field}_{$hash}";
            $this->binds[$alias] = $value;
            $tailString .= ":{$alias},";
        }

        $tailString = trim($tailString, " \t\n\r\0\x0B,");
        $tailString = "({$tailString})";

        $sql = $mainString . ' ' . $tailString;

        return $sql;
    }
}

