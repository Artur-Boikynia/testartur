<?php


namespace app\components\db;


class Limit
{
    private ?int $limit = null;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }
}