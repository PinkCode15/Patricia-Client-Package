<?php

namespace PatriciaClient\Actions;
use PatriciaClient\Model\databaseManager as dbConnection;

class Seeders
{

    function createClientTableSeeder()
    {
        $data = [
            "uuid" =>  $uuid = uniqid('client-',true),
            "name" => "Admin",
            "type" => "admin",
            "is_blocked" => "0",
        ];
        (new dbConnection())->insertIntoTable("clients", $data);
    }

    function createClientKeysTableSeeder()
    {
        $data = [
            "name" =>  "DefaultAdmin",
            "client_id" => "1",
            "client_key" => $uuid = uniqid('pat_privkey_-',true),
            "is_blocked" => "0",
        ];

        (new dbConnection())->insertIntoTable("client_keys", $data);
    }
}
