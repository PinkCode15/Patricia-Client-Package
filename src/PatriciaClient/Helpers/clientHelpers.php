<?php

namespace PatriciaClient\Helpers;

use PatriciaClient\Model\databaseManager as dbConnection;
use PatriciaClient\Actions\Core\ReadQuery;

class ClientHelpers
{

    /**
     * perform check if a user (apiKey)  is an admin
     * @return bool
     */

    public static function isAdmin(string $apiKey)
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


     /**
     * perform check if a user (apiKey)  is authenticated
     * @return bool
     */

    function isAuthenticated(string $apiKey)
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

     /**
     * get a client details
     * @return array
     */
    function getClient(string $prop, string $value)
    {
        $client = (new ReadQuery)->readClient($prop, $value);
        return $client;
    }
}