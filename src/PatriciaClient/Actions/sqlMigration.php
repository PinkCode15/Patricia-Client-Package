<?php
namespace PatriciaClient\Actions;
use PatriciaClient\Model\DatabaseManager;
use Composer\Script\Event;

class sqlMigration {
    public static function runMigration(Event $event)
    {
        $composer = $event->getComposer();
        $attributes = "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        $var = (new DatabaseManager())->upTable("new_users", $attributes);
        var_dump($var);
    }

}