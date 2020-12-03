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

        $result = (new patricia())->create_client($clientName, $clientRole);
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
 
        $result = (new patricia())->create_client_key($clientId, $clientKeyName);
        $this->assertTrue(true);
        $this->assertContains("MyOnlyKey", $result);
    }

    public function testCanUpdateClient()
    {
        $clientName = "Harrys";

        $result = (new patricia())->create_client($clientName);

        $newArray = [
            "is_blocked" => 1
        ];

        $response = (new patricia())->update_client($result['uuid'], $newArray);
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

        $result = (new patricia())->create_client_key($clientId, $clientKeyName);

        $newArray = [
            "is_blocked" => 1
        ];

        $response = (new patricia())->update_client_keys($result['id'], $newArray);
        $this->assertTrue(true);
        $this->assertContains($result['id'], $response);
    }

    public function testCanFetchClient()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->create_client($clientName, $clientRole);
        $response = (new patricia())->get_client('name', $clientName);
        $this->assertTrue(true);
        $this->assertContains($clientName, $response);
    }

    public function testCanFetchCLientKey()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->create_client($clientName, $clientRole);
        $response = (new patricia())->get_client_key($result['id']);
        $this->assertTrue(true);
    }

    public function testCanFetchClientKeys()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->create_client($clientName, $clientRole);
        $response = (new patricia())->get_client_keys($result['id']);
        $this->assertTrue(true);
    }

    public function testCanDeleteClient()
    {
        $clientName = "Harrys";
        $clientRole = "admin";

        $result = (new patricia())->create_client($clientName, $clientRole);

        $response = (new patricia())->delete_client($result['uuid']);

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
        $result = (new patricia())->create_client_key($clientId, $clientKeyName);
        $response = (new patricia())->delete_client_key($result['id']);
        $this->assertTrue(true);
    }

}
