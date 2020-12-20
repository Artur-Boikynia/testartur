<?php


namespace app\components\db;


class Update extends DbAbstractQuery
{
    private array $fields = [];

    public function setTable(string $tabel):self{
        $this->table = $tabel;

        return $this;
    }
    public function set(array $data):self{
        $this->data = $data;
        return $this;
    }

    protected function getSQL(): string
    {
        $this->binds = SetUpFields::fieldsFilter($this->table, $this->data);

        $sqlSET = [];
        foreach ($this->data as $fields => $value){
            $sqlSET[] = "`{$fields}` = :{$fields}";
        }

        $fieldsSQL = implode(', ',$sqlSET);

        $sql = "UPDATE {$this->table} SET {$fieldsSQL}";

        if ($this->where instanceof Where) {
            $where = $this->where->getSql();
            $this->binds = array_merge($this->binds, $this->where->getBinds());
            $sql .= " WHERE {$where}";
        }

        return $sql;
    }

}