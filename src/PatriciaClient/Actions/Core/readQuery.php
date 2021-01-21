<?php

namespace PatriciaClient\Actions\Core;
use PatriciaClient\Model\databaseManager as dbConnection;

class ReadQuery 
{
 
    /**
     * fetch a client record
     * @return array
     */
    public static function readClient(string $prop, string $value)
    {
        $table = "auth_clients";
        return (new dbConnection())->selectByColumn($table, $prop, $value,1);
    }



    /**
     * fetch a client key(s) record
     * @return array
     */
    public static function readClientKeys(string $prop, string $value, $limit=null)
    {
        $table = "auth_client_keys";
        return (new dbConnection())->selectByColumn($table, $prop, $value, $limit);
    }
}