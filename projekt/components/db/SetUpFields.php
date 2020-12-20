<?php


namespace app\components\db;

use app\components\App;
use PDO;
class SetUpFields
{
    private static ?PDO $connection = null;

    public function __construct(){
        self::$connection = App::getApp()->getConnectDB()->getConnection();
    }

    public static function fieldsFilter(string $tableName, array $data):array{
     $arrayFromDb = self::setUpFields($tableName);
     $filteredArray = array_filter($data, static function($key) use ($arrayFromDb){
         $bool = in_array($key, $arrayFromDb)? true : false;
         return $bool;
     },ARRAY_FILTER_USE_KEY);

     return $filteredArray;
    }

    private static function setUpFields(string $tableName): array
    {
        self::$connection = App::getApp()->getConnectDB()->getConnection();
        $stmt = self::$connection->query("DESCRIBE `{$tableName}`");
        $fileds = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $fileds;
    }
}