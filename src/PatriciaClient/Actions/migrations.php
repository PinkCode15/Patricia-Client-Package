<?php

namespace PatriciaClient\Actions;

use PatriciaClient\Model\databaseManager as dbConnection;

class Migrations
{

    /**
     * runs migration for the client table
     * @return null
     */

    function createClientTable()
    {
        $attributes = "
            id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            uuid VARCHAR(255) NOT NULL,
            name VARCHAR(100) NOT NULL,
            type ENUM ('admin', 'user') DEFAULT 'user',
            is_blocked TINYINT(4) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ";

        (new dbConnection())->upTable("auth_clients", $attributes);
    }


     /**
     * runs migration for the client keys table
     * @return null
     */

    function createClientKeysTable()
    { 

        $attributes = "
            id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            auth_client_id INT(20) UNSIGNED NOT NULL,
            client_key VARCHAR(255) NOT NULL,
            is_blocked TINYINT(4) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ";
        (new dbConnection())->upTable("auth_client_keys", $attributes);
    }

    function dropClientTable()
    {
        (new dbConnection())->downTable("auth_clients");
    } 
 
    function dropClientKeysTable()
    {
        (new dbConnection())->downTable("auth_client_keys");
    }
}
