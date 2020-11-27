<?php
namespace PatriciaClient;
use PatriciaClient\Actions\Core\CreateQuery;

class Patricia {

    public static function create_client(String $name)
    {
        $data = [
            "uuid" => uniqid('client-',true),
            "name" => $name,
            "type" => "admin",
            "is_blocked" => "0",
        ];
        return CreateQuery::createClient($data);
    }

    public static function create_client_key(int $clientId, String $clientName)
    {
        $data = [
            "name" =>  $clientName,
            "client_id" => $clientId,
            "client_key" => uniqid('pat_privkey_-',true),
            "is_blocked" => "0",
        ];
        return CreateQuery::createClientKeys($data);
    }

    public static function get_client()
    {

    }

    public static function get_client_key()
    {
        
    }

    public static function get_client_keys()
    {
        
    }


    public static function delete_client()
    {
        
    }

    public static function delete_client_key()
    {
        
    }


    public static function delete_client_keys()
    {
        
    }



    public static function update_client()
    {
        
    }

    public static function update_client_keys()
    {
        
    }



}