<?php

namespace PatriciaClient\Actions;
use PatriciaClient\Model\databaseManager as dbConnection;

class Seeders
{


     /**
     * seeds data into for the client table
     * @return null
     */
    function createClientTableSeeder()
    {
        $data = [
            "uuid" =>  $uuid = uniqid('client-',true),
            "name" => "Admin",
            "type" => "admin",
            "is_blocked" => "0",
        ];
        (new dbConnection())->insertIntoTable("auth_clients", $data);
    }


     /**
     * seeds data into for the client key table
     * @return null
     */
    function createClientKeysTableSeeder()
    {
        $data = [
            "name" =>  "DefaultAdmin",
            "auth_client_id" => "1",
            "client_key" => $uuid = uniqid('pat_privkey_',true),
            "is_blocked" => "0",
        ];

        (new dbConnection())->insertIntoTable("auth_client_keys", $data);
    }
}
