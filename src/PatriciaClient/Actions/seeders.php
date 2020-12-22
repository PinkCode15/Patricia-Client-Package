<?php

namespace PatriciaClient\Actions;
use PatriciaClient\Model\databaseManager as dbConnection;

class Seeders
{
    private $auth_client_id;

    function createClientTableSeeder()
    {
        $data = [
            "uuid" =>  $uuid = uniqid('client-',true),
            "name" => "Admin",
            "type" => "admin",
            "is_blocked" => "0",
        ];
       $result = (new dbConnection())->insertIntoTable("auth_clients", $data);
       return $result;
    }


    function createClientKeysTableSeeder(int $auth_client_id)
    {
        $data = [
            "name" =>  "DefaultAdmin",
            "auth_client_id" => $auth_client_id,
            "client_key" => $uuid = uniqid('pat_privkey_',true),
            "is_blocked" => "0",
        ];
        (new dbConnection())->insertIntoTable("auth_client_keys", $data);
        
    }

    function deleteClientTable()
    {
        (new dbConnection())->truncateTable("auth_clients");
    }


    function deleteClientKeysTable()
    {
        // (new dbConnection())->dropForeignKey("auth_client_keys", "auth_client_id");
        (new dbConnection())->truncateTable("auth_client_keys");
    }
}
