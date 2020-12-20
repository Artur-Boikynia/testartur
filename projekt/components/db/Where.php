<?php


namespace app\components\db;


use app\components\db\where\AbstractConditionBuilder;
use app\exceptions\DbExcetion;
use app\exceptions\FalseVariablesException;
use app\components\db\where\Compare;

class Where
{
    private array $conditions;
    private string $glue;
    private array $binds = [];
    private string $sql;

    public function __construct(array $conditions, string $glue){
        $this->conditions = $conditions;
        $this->glue = $glue;
        $this->buildWhere();
    }

    private function buildWhere():void{
        $conditions = [];
        foreach ($this->conditions as $condition){
            $objectConditions = $this->getBuilderObject($condition);

            if(!$objectConditions instanceof AbstractConditionBuilder){
                throw new FalseVariablesException('Value $objectConditions dont instance AbstractConditionBuilder');
            }

            $conditions[] = $objectConditions->build();
            $this->binds = array_merge($this->binds, $objectConditions->getBinds());
            $this->sql = implode(" {$this->glue} ", $conditions);

        }
    }

    private function getBuilderObject(array $condition): AbstractConditionBuilder
    {
        if (!isset($condition[1])) {
            $error = json_encode($condition);
            throw new DbExcetion("Operator is invalid in {$error}");
        }

        $operator = strtolower(trim($condition[1]));
        switch ($operator) {
            case '>':
            case '>=':
            case '<':
            case '<=':
            case '=':
            case '!=':
            case '<>':
            case 'like':
            case 'not like':
                return new Compare(...$condition);
/*            case 'between':
            case 'not between':
                return new Between(...$condition);
            case 'in':
            case 'not in':
                return new In(...$condition);
            case 'is null':
            case 'is not null':
                return new Nullable(...$condition);*/
            default:
                throw new DbExcetion("Operator '{$operator}' is invalid");
        }
    }

    /**
     * @return string
     */
    public function getSql(): string
    {
        return $this->sql;
    }

    /**
     * @return array
     */
    public function getBinds(): array
    {
        return $this->binds;
    }
}