<?php

namespace PatriciaClient\Helpers;

use PatriciaClient\Model\databaseManager as dbConnection;
use PatriciaClient\Actions\Core\ReadQuery;

class ClientHelpers
{

    public static function isAdmin(String $apiKey)
    {

        $clientKey = (new ReadQuery)->readClientKeys("client_key", $apiKey, 1);
       
        if (! $clientKey){
            return "Key does not belong to any client";
        }

        $client = (new ReadQuery)->readClient("id", $clientKey['auth_client_id']);

        if (! $client){
            return "Client does not exist";
        }

        if ($client['type'] == 'admin') {
            return true;
        }

        return false;

    }

    function isAuthenticated(String $apiKey)
    {
        $clientKey = (new ReadQuery)->readClientKeys("client_key", $apiKey, 1);
       
        if (! $clientKey){
            return "Key does not belong to any client";
        }

        $client = (new ReadQuery)->readClient("id", $clientKey['auth_client_id']);

        if($client){
            return true;
        }

        return false;

    }

    function getClient(String $prop, String $value)
    {
        $client = (new ReadQuery)->readClient($prop, $value);
        return $client;
    }
}