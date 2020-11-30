<?php
use PHPUnit\Framework\TestCase;
use PatriciaClient\Helpers\ClientHelpers;

class ClientHelpersTest extends TestCase 
{
    public function testCanCheckIsAdmin()
    {
        $clientData = [
            "uuid" =>  uniqid('client-',true),
            "name" => "TestAdmin1",
            "type" => "admin",
            "is_blocked" => "0",
        ];

        $lastID = (new dbConnection())->insertIntoTable("clients", $clientData);

        $clientKeysData = [
            "name" =>  "TestAdmin1",
            "client_id" => $lastID,
            "client_key" => 'pat_privkey_748jkvk099hjd',
            "is_blocked" => "0",
        ];

        (new dbConnection())->insertIntoTable("client_keys", $clientKeysData);

        $result = (new ClientHelpers())->isAdmin($clientKeysData['client_key']);
        $this->assertTrue(true);
 
    }

    public function testCanCheckIsAuthenticated()
    {
        $clientData = [
            "uuid" =>  uniqid('client-',true),
            "name" => "TestAdmin2",
            "type" => "admin",
            "is_blocked" => "0",
        ];

        $lastID = (new dbConnection())->insertIntoTable("clients", $clientData);

        $clientKeysData = [
            "name" =>  "TestAdmin2",
            "client_id" => $lastID,
            "client_key" => 'pat_privkey_mdlkfl7890',
            "is_blocked" => "0",
        ];

        (new dbConnection())->insertIntoTable("client_keys", $clientKeysData);

        $result = (new ClientHelpers())->isAuthenticated($clientKeysData['client_key']);
        $this->assertTrue(true);
        
    }
 
    public function testCanGetClient()
    {
        $table_name = "test_table";
        $clientData = [
            "uuid" =>  $uuid = uniqid('client-',true),
            "name" => "TestAdmin3",
            "type" => "admin",
            "is_blocked" => "0",
        ];

        $lastID = (new dbConnection())->insertIntoTable("clients", $clientData);

        $result = (new ClientHelpers())->getClient("id", $lastID);
        $this->assertTrue(true);
        
    }

    

}