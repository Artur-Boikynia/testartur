<?php


namespace app\components\db\where;

use app\components\db\where\AbstractConditionBuilder;
class IN extends AbstractConditionBuilder
{
    private string $field;
    private string $conditions;
    private array $values;

    public function __construct(string $fields, string $conditions, string ... $value){
        $this->field = $fields;
        $this->conditions = $conditions;
        $this->values = $value;
    }

    public function build(): string
    {
        $valueSQL = [];
        $i = 0;
        foreach ($this->values as $value){
            $i++;
            $nameAlias = "{$this->getHash()}_{$i}";
            $alias = ":$nameAlias";
            $valueSQL[] = $alias;
            $this->binds[$nameAlias] = $value;
        }

        $sql = implode(', ',$valueSQL);

        var_dump($sql);

        return  "`{$this->field}` {$this->conditions} ({$sql})";

    }
}