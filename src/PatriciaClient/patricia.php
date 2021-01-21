<?php

namespace PatriciaClient;

use PatriciaClient\Actions\Core\CreateQuery;
use PatriciaClient\Actions\Core\DeleteQuery;
use PatriciaClient\Actions\Core\UpdateQuery;
use PatriciaClient\Actions\Core\ReadQuery;

class Patricia
{

    /**
     * creates a new client record
     * @return array
     */

    public static function createClient(string $name, string $role = 'admin')
    {
        $data = [
            "uuid" => uniqid('client-', true),
            "name" => $name,
            "type" => $role,
            "is_blocked" => "0",
        ];
        return CreateQuery::createClient($data);
    }

     /**
     * creates a new client key record
     * @return array
     */
    public static function createClientKey(int $clientId, string $clientName)
    {
        $data = [
            "name" =>  $clientName,
            "auth_client_id" => $clientId,
            "client_key" => uniqid('pat_privkey_', true),
            "is_blocked" => "0",
        ];
        return CreateQuery::createClientKeys($data);
    }


     /**
     * updates a client record
     * @return array
     */
    public static function updateClient(string $uuid, array $array) 
    {
        $array['uuid'] = $uuid;
        $result = UpdateQuery::updateClient($array);
        return $result ?  $result  : "No record found for uuid: " . $uuid . " \n";
    }


    /**
     * updates a client record
     * @return array
     */
    public static function updateClientKeys(int $id, array $array)
    {
        $array['id'] = $id;
        $result = UpdateQuery::updateClientKeys($array);
        return $result ?  $result  : "No record found for id: " . $id . " \n";
    }
    
 
    /**
     * gets a client record
     * @return array
     */
    public static function getClient(string $prop, string $value)
    {
        $result = ReadQuery::readClient($prop, $value, 1);
        return $result ?  $result  : "No record found for " . $prop . ": " . $value . " \n";
    }


     
    /**
     * gets a client key record
     * @return array
     */
    public static function getClientKey(int $id)
    {
        $result = ReadQuery::readClientKeys('auth_client_id', $id, 1);
        return $result ?  $result  : "No record found for client_id: " . $id . " \n";
    }

     
    /**
     * gets a client keys record
     * @return array
     */
    public static function getClientKeys(int $id)
    {
        $result = ReadQuery::readClientKeys('auth_client_id', $id);
        return $result ?  $result  : "No records found for client_id: " . $id . " \n";
    }


     
    /**
     * deletes a client record
     * @return array
     */

    public static function deleteClient(string $uuid)
    {
        $result =  DeleteQuery::deleteClient('uuid', $uuid);
        return $result ?  "Client deleted \n" : "Could not process request \n";
    }

     
    /**
     * deletes a client key record
     * @return array
     */

    public static function deleteClientKey(int $id)
    {
        $result = DeleteQuery::deleteClientKeys('id', $id);
        return $result ?  "Client key deleted \n" : "Could not process request \n";
    }

    
} 
