<?php

namespace PatriciaClient;

use PatriciaClient\Actions\Core\CreateQuery;
use PatriciaClient\Actions\Core\DeleteQuery;
use PatriciaClient\Actions\Core\UpdateQuery;
use PatriciaClient\Actions\Core\ReadQuery; 
use PatriciaClient\Actions\sqlMigration;

class Patricia
{
    public static function migrate()
    {
        sqlMigration::runMigration();
        return "migration successfull";
    }

    public static function create_client(String $name, String $role = 'admin')
    {
        $data = [
            "uuid" => uniqid('client-', true),
            "name" => $name,
            "type" => $role,
            "is_blocked" => "0",
        ];
        return CreateQuery::createClient($data);
    }

    public static function create_client_key(int $clientId, String $clientName)
    {
        $data = [
            "name" =>  $clientName,
            "auth_client_id" => $clientId,
            "client_key" => uniqid('pat_privkey_', true),
            "is_blocked" => "0",
        ];
        return CreateQuery::createClientKeys($data);
    }

    public static function update_client(string $uuid, array $array)
    {
        $array['uuid'] = $uuid;
        $result = UpdateQuery::updateClient($array);
        return $result ?  $result  : "No record found for uuid: " . $uuid . " \n";
    }

    public static function update_client_keys(Int $id, array $array)
    {
        $array['id'] = $id;
        $result = UpdateQuery::updateClientKeys($array);
        return $result ?  $result  : "No record found for id: " . $id . " \n";
    }

    public static function get_client(string $prop, string $value)
    {
        $result = ReadQuery::readClient($prop, $value, 1);
        return $result ?  $result  : "No record found for " . $prop . ": " . $value . " \n";
    }

    public static function get_client_key(Int $id)
    {
        $result = ReadQuery::readClientKeys('auth_client_id', $id, 1);
        return $result ?  $result  : "No record found for client_id: " . $id . " \n";
    }

    public static function get_client_keys(int $id)
    {
        $result = ReadQuery::readClientKeys('auth_client_id', $id);
        return $result ?  $result  : "No records found for client_id: " . $id . " \n";
    }


    public static function delete_client(String $uuid)
    {
        $result =  DeleteQuery::deleteClient('uuid', $uuid);
        return $result ?  "Client deleted \n" : "Could not process request \n";
    }

    public static function delete_client_key(Int $id)
    {
        $result = DeleteQuery::deleteClientKeys('id', $id);
        return $result ?  "Client key deleted \n" : "Could not process request \n";
    }
}
