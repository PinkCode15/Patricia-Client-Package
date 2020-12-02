<?php

use PatriciaClient\Helpers\ClientHelpers as clientHelper;


if (!function_exists('is_admin')) {
    function is_admin(String $apiKey)
    {
        if($apiKey)
        {
            return (new clientHelper())->isAdmin($apiKey);
        }
        return false;
    }
}

if (!function_exists('get_client')) {
    function get_client(String $prop, String $value)
    {
        if($prop && $value)
        {
            return (new clientHelper())->getClient($prop, $value);
        }
        return false;
    }
}

if (!function_exists('is_authenticated')) {
    function is_authenticated(String $apiKey)
    {
        if($apiKey)
        {
            return (new clientHelper())->isAuthenticated($apiKey);
        }
        return false;
    }
}

