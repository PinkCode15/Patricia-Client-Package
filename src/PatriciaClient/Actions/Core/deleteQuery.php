<?php

namespace PatriciaClient\Actions\Core;
use PatriciaClient\Model\databaseManager as dbConnection;

class DeleteQuery 
{
 
    /**
     * delete a client record
     * @return bool
     */
    public static function deleteClient(string $prop, string $value)
    {
        $table = "auth_clients";
        $key_table = "auth_client_keys";
        $client =  (new dbConnection())->selectByColumn($table, $prop, $value,1); //get Client ID first;
        $clientID = $client['id'];
        if($clientID)
        {
            (new dbConnection())->deleteFromTable($key_table, 'auth_client_id', $clientID);//Delete From Client Keys Table 
            (new dbConnection())->deleteFromTable($table, $prop, $value);//Delete From Client Table 
            return true;
        }
        else
        {
            return false;
        }
    }


    /**
     * delete a client key records
     * @return bool
     */
    public static function deleteClientKeys(string $prop, string $value)
    {
        $table = "auth_client_keys";
        (new dbConnection())->deleteFromTable($table, $prop, $value);
        return true;
    } 
}