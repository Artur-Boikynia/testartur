<?php


namespace app\components\db;



use app\components\db\DbAbstractQuery;
class Delete extends DbAbstractQuery
{
    private array $fields = [];

    public function setTable(string $table):self{
        $this->table = $table;

        return $this;
    }

    protected function getSQL(): string
    {
        $sql = "DELETE FROM {$this->table}";

        if ($this->where instanceof Where) {
            $where = $this->where->getSql();
            $this->binds = array_merge($this->binds, $this->where->getBinds());
            $sql .= " WHERE {$where}";
        }

        return $sql;
    }
}