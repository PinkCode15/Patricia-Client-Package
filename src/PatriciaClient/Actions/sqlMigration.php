<?php
namespace PatriciaClient\Actions;
use PatriciaClient\Model\DatabaseManager;
use Composer\Script\Event;

class sqlMigration {
    public static function runMigration(Event $event)
    {
        $composer = $event->getComposer();
        $attributes = "
            id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            uuid VARCHAR(255) NOT NULL,
            name VARCHAR(100) NOT NULL,
            type ENUM ('admin', 'user') DEFAULT 'user',
            is_blocked TINYINT(4) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ";
        (new DatabaseManager())->upTable("clients", $attributes);



        $data = [
            "uuid" =>  $uuid = uniqid('client-',true),
            "name" => "Admin",
            "type" => "admin",
            "is_blocked" => "0",
        ];
        (new DatabaseManager())->insertIntoTable("clients", $data);

        // var_dump($hh);
    }

}