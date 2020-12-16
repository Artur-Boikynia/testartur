<?php


namespace app\components\db;


use app\components\db\Limit;
use app\exceptions\DBException;

trait LimitTrait
{

   private ?int $limit = null;
   private int $offset = 0;
   private ?Limit $limitConditions = null;

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;
        $this->limitConditions = new Limit($limit);
        return $this;
    }

    public function offset(int $offset = 0): self
    {
        if(!$this->limitConditions instanceof Limit){
            throw new DBException('LIMIT was not set');
        }
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @return int|null
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

}