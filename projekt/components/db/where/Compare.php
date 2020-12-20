<?php


namespace app\components\db\where;


use app\components\db\where\AbstractConditionBuilder;
class Compare extends AbstractConditionBuilder
{
    private string $field;
    private string $conditions;
    private string $value;

    public function __construct(string $fields, string $conditions,  string $value){
        $this->field = $fields;
        $this->conditions = $conditions;
        $this->value = $value;
    }

    public function build(): string
    {
        $alias = "{$this->getHash()}_{$this->field}";
        $this->binds[$alias] = $this->value;
        return  "`{$this->field}` {$this->conditions} :{$alias}";

    }
}