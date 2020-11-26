<?php

namespace PatriciaClient\Actions;
use PatriciaClient\Model\databaseManager as dbConnection;

class Seeders
{

    function createClientTableSeeder()
    {
        $uuid = uniqid('client-',true);
        $attributes = "uuid, name, type, is_blocked";
        $values = "'$uuid', 'Admin', 'admin', '0'";
        
        (new dbConnection())->insertIntoTable("clients", $attributes, $values);
    }

    function createClientKeysTableSeeder()
    {

        $clientKey = uniqid('pat_privkey_',true);
        $attributes = "name, client_id, client_key, is_blocked";
        $values = "'DefaultAdmin', '1', '$clientKey', '0'";

        (new dbConnection())->insertIntoTable("client_keys", $attributes, $values);
    }
}
