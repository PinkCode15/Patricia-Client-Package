<?php

namespace PatriciaClient\Actions\Core;
use PatriciaClient\Model\databaseManager as dbConnection;

class ReadQuery {
 
    public static function readClient(String $prop, String $value)
    {
        $table = "auth_clients";
        return (new dbConnection())->selectByColumn($table, $prop, $value,1);
    }


    public static function readClientKeys(String $prop, String $value, $limit=null)
    {
        $table = "auth_client_keys";
        return (new dbConnection())->selectByColumn($table, $prop, $value, $limit);
    }
}