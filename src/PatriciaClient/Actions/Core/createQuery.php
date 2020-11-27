<?php

namespace PatriciaClient\Actions\Core;
use PatriciaClient\Model\databaseManager as dbConnection;

class CreateQuery {
 
    public static function createClient(array $attributes)
    {
        $table = "clients";
        $lastID = (new dbConnection())->insertIntoTable($table, $attributes);
        return (new dbConnection())->selectById($table, $lastID);
    }


    public static function createClientKeys(array $attributes)
    {
        $table = "client_keys";
        $lastID = (new dbConnection())->insertIntoTable($table, $attributes);
        return (new dbConnection())->selectById($table, $lastID);
    }
}