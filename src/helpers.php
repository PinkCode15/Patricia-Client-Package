<?php

use PatriciaClient\Helpers\ClientHelpers as clientHelper;


 
    /**
     * check if user is an admin
     * @return array|bool
     */

    if (!function_exists('isAdmin')) {
        function isAdmin(string $apiKey)
        {
            if($apiKey)
            {
                return (new clientHelper())->isAdmin($apiKey);
            }
            return false;
        }
    }


    /**
     * return a client details
     * @return array|false
     */
    if (!function_exists('getClient')) {
        function getClient(string $prop, string $value)
        {
            if($prop && $value)
            {
                return (new clientHelper())->getClient($prop, $value);
            }
            return false;
        }
    }


    /**
     * check if user is an authenticated
     * @return array|false
     */
    if (!function_exists('isAuthenticated')) {
        function isAuthenticated(string $apiKey)
        {
            if($apiKey)
            {
                return (new clientHelper())->isAuthenticated($apiKey);
            }
            return false;
        }
    }

