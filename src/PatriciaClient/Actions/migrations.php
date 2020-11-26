<?php

namespace PatriciaClient\Actions;
use PatriciaClient\Model\databaseManager as dbConnection;

class Migrations
{

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

        (new dbConnection())->upTable("clients", $attributes);
    }

    function createClientKeysTable()
    {
        $attributes = "
            id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            client_id INT(20) UNSIGNED NOT NULL,
            FOREIGN KEY(client_id) REFERENCES clients(id) ,
            client_key VARCHAR(255) NOT NULL,
            is_blocked TINYINT(4) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ";

        (new dbConnection())->upTable("client_keys", $attributes);
    }
}
