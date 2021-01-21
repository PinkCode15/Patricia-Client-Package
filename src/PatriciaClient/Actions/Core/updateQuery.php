<?php

namespace PatriciaClient\Actions\Core;
use PatriciaClient\Model\databaseManager as dbConnection;

class UpdateQuery 
{

    /**
     * updates a client record
     * @return array
     */
 
    public static function updateClient(array $array)
    {
        $lastKey = array_key_last($array);
        $table = "auth_clients";
       (new dbConnection())->updateTableByColumn($table,  $array);
        return (new dbConnection())->selectByColumn($table, $lastKey, $array[$lastKey],1);
    }
    

    /**
     * creates a client key record(s)
     * @return array
     */
    public static function updateClientKeys(array $array)
    {
        $table = "auth_client_keys";
        $lastKey = array_key_last($array);
        (new dbConnection())->updateTableByColumn($table, $array);
        return (new dbConnection())->selectByColumn($table, $lastKey, $array[$lastKey], 1);
    }
}