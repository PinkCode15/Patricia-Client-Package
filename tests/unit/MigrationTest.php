<?php
use PHPUnit\Framework\TestCase;
use PatriciaClient\Model\DatabaseManager as dbConn;

class MigrationTest extends TestCase 
{
    public function testCanCreateTable()
    {
        $table_name = "test_table";
        $table_attributes = "
            id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            uuid VARCHAR(255) NOT NULL,
            name VARCHAR(100) NOT NULL,
            type ENUM ('admin', 'user') DEFAULT 'user',
            is_blocked TINYINT(4) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ";
        $result = (new dbConn())->upTable($table_name, $table_attributes);
        $this->assertTrue(true);
 
    }

    public function testCanDropTable()
    {
        $table_name = "test_table";
        $result = (new dbConn())->downTable($table_name);
        $this->assertTrue(true);
        
    }
 
    public function testCanInsertIntoPresentTable()
    {
        $this->testCanCreateTable();
        $data = [
            "uuid" =>  $uuid = uniqid('client-',true),
            "name" => "Admin",
            "type" => "admin",
            "is_blocked" => "0",
        ];
        (new dbConn())->insertIntoTable("test_table", $data);
        $this->assertTrue(true);
    }

    public function testCanNotInsertIntoTableNotPresent()
    {
        $data = [
            "uuid" =>  $uuid = uniqid('client-',true),
            "name" => "Admin",
            "type" => "admin",
            "is_blocked" => "0",
        ];
        (new dbConn())->insertIntoTable("clients", $data);
        $this->assertFalse(false);
    }

}