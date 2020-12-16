<?php


namespace app\components\db\where;


use app\components\db\Limit;
use app\exceptions\DBException;

trait LimitTrait
{

   private ?int $limit = null;
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

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        if(!$this->limitConditions instanceof Limit){
            throw new DBException('Limit was not entered');
        }
        return $this->limit;
    }

}