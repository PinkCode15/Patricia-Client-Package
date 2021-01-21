<?php

namespace PatriciaClient\Actions\Core;
use PatriciaClient\Model\databaseManager as dbConnection;

class CreateQuery {

     /**
     * creates a client
     * @return array
     */

    public static function createClient(array $attributes)
    {
        $table = "auth_clients";
        $lastID = (new dbConnection())->insertIntoTable($table, $attributes);
        return (new dbConnection())->selectById($table, $lastID);
    }


    /**
     * creates a client key(s)
     * @return array
     */
    public static function createClientKeys(array $attributes)
    {
        $table = "auth_client_keys";
        $lastID = (new dbConnection())->insertIntoTable($table, $attributes);
        return (new dbConnection())->selectById($table, $lastID);
    }
}