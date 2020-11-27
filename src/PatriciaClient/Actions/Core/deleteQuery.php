<?php

namespace PatriciaClient\Actions\Core;
use PatriciaClient\Model\databaseManager as dbConnection;

class DeleteQuery {
 
    public static function deleteClient(String $prop, String $value)
    {
        $table = "clients";
        $key_table = "client_keys";
        $client =  (new dbConnection())->selectByColumn($table, $prop, $value,1); //get Client ID first;
        $clientID = $client['id'];
        if($clientID)
        {
            (new dbConnection())->deleteFromTable($key_table, 'client_id', $clientID);//Delete From Client Keys Table 
            (new dbConnection())->deleteFromTable($table, $prop, $value);//Delete From Client Table 
            return true;
        }
        else
        {
            return false;
        }
    }


    public static function deleteClientKeys(String $prop, String $value)
    {
        $table = "client_keys";
        (new dbConnection())->deleteFromTable($table, $prop, $value);
        return true;
    }
}