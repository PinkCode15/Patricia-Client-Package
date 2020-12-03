<?php

namespace PatriciaClient\Actions\Core;
use PatriciaClient\Model\databaseManager as dbConnection;

class UpdateQuery {
 
    public static function updateClient(Array $array)
    {
        $lastKey = array_key_last($array);
        $table = "auth_clients";
       (new dbConnection())->updateTableByColumn($table,  $array);
        return (new dbConnection())->selectByColumn($table, $lastKey, $array[$lastKey],1);
    }
    
    public static function updateClientKeys(Array $array)
    {
        $table = "auth_client_keys";
        $lastKey = array_key_last($array);
        (new dbConnection())->updateTableByColumn($table, $array);
        return (new dbConnection())->selectByColumn($table, $lastKey, $array[$lastKey], 1);
    }
}