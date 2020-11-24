<?php

require_once 'vendor/autoload.php';
use PatriciaClient\Model\DatabaseManager;

$attributes = " id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
$gh =  (new DatabaseManager)->upTable("new_users", $attributes);

// $hh =  (new DatabaseManager)->downTable("new_users");

var_dump($gh);

// var_dump($hh);
 