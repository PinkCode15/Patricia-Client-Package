<?php

use PHPUnit\Framework\TestCase;
use PatriciaClient\Patricia as patricia;
use PatriciaClient\Model\DatabaseManager as dbConnection;

class CoreFunctionalityTest extends TestCase
{

    public function testCanCreateClient()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->createClient($clientName, $clientRole);
        $this->assertTrue(true);
        $this->assertContains("Harrys", $result);
    }

    public function testCanCreateClientKey()
    {
        $clientData = [
            "uuid" =>  uniqid('client-', true),
            "name" => "TestAdmin1",
            "type" => "admin",
            "is_blocked" => "0",
        ];

        $clientId = (new dbConnection())->insertIntoTable("auth_clients", $clientData);

        $clientKeyName = "MyOnlyKey";
 
        $result = (new patricia())->createClientKey($clientId, $clientKeyName);
        $this->assertTrue(true);
        $this->assertContains("MyOnlyKey", $result);
    }

    public function testCanUpdateClient()
    {
        $clientName = "Harrys";

        $result = (new patricia())->createClient($clientName);

        $newArray = [
            "is_blocked" => 1
        ];

        $response = (new patricia())->updateClient($result['uuid'], $newArray);
        $this->assertTrue(true);
        $this->assertContains($result['uuid'], $response);
    }

    public function testCanUpdateClientKey()
    {
        $clientData = [
            "uuid" =>  uniqid('client-', true),
            "name" => "TestAdmin1",
            "type" => "admin",
            "is_blocked" => "0",
        ];

        $clientId = (new dbConnection())->insertIntoTable("auth_clients", $clientData);

        $clientKeyName = "MyOnlyKey";

        $result = (new patricia())->createClientKey($clientId, $clientKeyName);

        $newArray = [
            "is_blocked" => 1
        ];

        $response = (new patricia())->updateClientKeys($result['id'], $newArray);
        $this->assertTrue(true);
        $this->assertContains($result['id'], $response);
    }

    public function testCanFetchClient()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->createClient($clientName, $clientRole);
        $response = (new patricia())->getClient('name', $clientName);
        $this->assertTrue(true);
        $this->assertContains($clientName, $response);
    }

    public function testCanFetchClientKey()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->createClient($clientName, $clientRole);
        $response = (new patricia())->getClientKey($result['id']);
        $this->assertTrue(true);
    }

    public function testCanFetchClientKeys()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->createClient($clientName, $clientRole);
        $response = (new patricia())->getClientKeys($result['id']);
        $this->assertTrue(true);
    }

    public function testCanDeleteClient()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->createClient($clientName, $clientRole);

        $response = (new patricia())->deleteClient($result['uuid']);

        $this->assertTrue(true);
    }

    public function testCanDeleteClientKey()
    {
        $clientData = [
            "uuid" =>  uniqid('client-', true),
            "name" => "TestAdmin1",
            "type" => "admin",
            "is_blocked" => "0",
        ];

        $clientId = (new dbConnection())->insertIntoTable("auth_clients", $clientData);
        $clientKeyName = "MyOnlyKey";
        $result = (new patricia())->createClientKey($clientId, $clientKeyName);
        $response = (new patricia())->deleteClientKey($result['id']);
        $this->assertTrue(true);
    }

}
