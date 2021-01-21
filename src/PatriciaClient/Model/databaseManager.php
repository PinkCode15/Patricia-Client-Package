<?php

namespace PatriciaClient\Model;

use Dotenv\Dotenv;
use Composer\Composer;

class DatabaseManager
{

    public function __construct()
    {
        if ($this->getEnv()) {
            $dotenv = Dotenv::createImmutable($this->getProjectRoot());
            $dotenv->load();
            $this->dbName = $_ENV['DB_DATABASE'] ?? 'JilHQarrys';
            $this->dbUser = $_ENV['DB_USERNAME'] ?? 'root';
            $this->dbPassword = $_ENV['DB_PASSWORD'] ?? 'root';
            $this->dbHost = $_ENV['DB_HOST'] ?? '127.0.0.1';
            $this->dbPort = $_ENV['DB_PORT'] ?? '3306';
            $this->dbConnection = $_ENV['DB_CONNECTION'] ?? 'mysql';
            $this->pdoConnection = new \PDO(
                $this->dbConnection . ":host=" . $this->dbHost,
                $this->dbUser,
                $this->dbPassword
            );
            
            $this->createDataBase();
            $this->useDataBase();
            $this->createClientTable();
            $this->createClientKeysTable();

            $this->pdoConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdoConnection->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        }
    }

    /**
     * creates a new table if the table doesn't exists
     * @return null
     */
    public function upTable($tableName, $attribute)
    {
        if (!$this->checkTable($tableName)) {
            $statement =  "CREATE TABLE " . $tableName . " ( " . $attribute . ")";
            try {

                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }


    /**
     * drops a table if the table  exists
     * @return null
     */
    public function downTable($tableName)
    {
        if ($this->checkTable($tableName)) {
            $statement =  "DROP TABLE " . $tableName;
            try {
                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
            } catch (\PDOException $e) {
            }
        }
    }

    /**
     * select from table based on id if the table  exists
     * @return array
     */
    public function selectById(string $tableName, int $id)
    {
        if ($this->checkTable($tableName)) {
            try {
                $statement =  "SELECT * FROM  " . $tableName . " WHERE id=? LIMIT 1";
                $query = $this->pdoConnection->prepare($statement);
                $query->execute([$id]);
                return $query->fetch(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }

    /**
     * select from table based on id if the table  exists
     * @return array
     */
    public function selectByColumn(string $tableName, string $column, string $value, $limit = null)
    {
        if ($this->checkTable($tableName)) {
            try {
                if($limit)
                {
                    $statement =  "SELECT * FROM  " . $tableName . " WHERE ".$column."=? Limit $limit";
                    $query = $this->pdoConnection->prepare($statement);
                    $query->execute([$value]);
                    return $query->fetch(\PDO::FETCH_ASSOC);
                }
                else 
                {
                    $statement =  "SELECT * FROM  " . $tableName . " WHERE ".$column."=? ";
                    $query = $this->pdoConnection->prepare($statement);
                    $query->execute([$value]);
                    return $query->fetchAll(\PDO::FETCH_ASSOC);

                }
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }


    /**
     * inserts into table if the table  exists return the lastInsertId
     * @return Int
     */
    public function insertIntoTable(string $tableName, array $array)
    {
        if ($this->checkTable($tableName)) {
            $attribute = join(', ', array_keys($array));
            $value = str_replace(str_split("[]"), "", json_encode(array_values($array)));
            $statement =  "INSERT INTO " . $tableName . " ( " . $attribute .
                ") VALUES (" . $value . ")";
            try {
                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
                $last_id = $this->pdoConnection->lastInsertId();
                return $last_id;
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }

    /**
     * update table by specific Column if the table  exists
     * @return null
     */
    public function updateTableByColumn(string $tableName, array $array)
    {
        if ($this->checkTable($tableName)) {
            $column = array_key_last($array);
            $attribute = array_keys($array);
            array_pop($attribute);
            $value = array_values($array);
 
            $setStr = "";
            foreach ($attribute as $key) {
                $setStr .= $key . " = ?,";
            }
            $query = rtrim($setStr, ", ");

            try {
                $statement = "UPDATE " . $tableName . " SET " . $query . " WHERE " . $column . "= ? ";
                $query = $this->pdoConnection->prepare($statement);
                $query->execute($value);
            } catch (\PDOException $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }



    /**
     * delete record table if the table  exists 
     * @return bool
     */
    public function deleteFromTable(string $tableName, string $column, string $id)
    {
        if ($this->checkTable($tableName)) {
            try {
                $statement =  "DELETE  FROM  " . $tableName . " WHERE " . $column . "=?";
                $query = $this->pdoConnection->prepare($statement);
                $query->execute([$id]);
                return true;
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }

    /**
     * checks if a table  exists
     * @return bool
     */
    private function checkTable(string $tableName)
    {
        $statement = "select * from " . $tableName;
        try {
            $query = $this->pdoConnection->prepare($statement);
            $result = $query->execute();
            return  $result ? true : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * specifies the database to use
     * @return null
     */
    private function useDataBase()
    {
        try {
            $statement = "USE " . $this->dbName;
            $query = $this->pdoConnection->prepare($statement);
            $query->execute();
        } catch (\PDOException $e) {
        }
    }


    /**
     * creates a database if it doesn't exists
     * @return null
     */
    private function createDataBase()
    {
        try {
            $statement = "CREATE DATABASE IF NOT EXISTS " . $this->dbName;
            $query = $this->pdoConnection->prepare($statement);
            $query->execute();
        } catch (\PDOException $e) {
        }
    }


    /**
     * Create a client table if it doesn't exists
     * @return null
     */
    private function createClientTable()
    {
        if (!$this->checkTable("auth_clients")) 
        {
            try{
                $attributes = "
                    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    uuid VARCHAR(255) NOT NULL,
                    name VARCHAR(100) NOT NULL,
                    type ENUM ('admin', 'user') DEFAULT 'user',
                    is_blocked TINYINT(4) DEFAULT 1,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ";

                $this->upTable("auth_clients", $attributes);
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }

     /**
     * creates a client key table if it doesn't exists
     * @return null
     */
    private function createClientKeysTable()
    { 
        if (!$this->checkTable("auth_client_keys")) 
        {
            try{
                $attributes = "
                    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    auth_client_id INT(20) UNSIGNED NOT NULL,
                    FOREIGN KEY(auth_client_id) REFERENCES auth_clients(id) ,
                    client_key VARCHAR(255) NOT NULL,
                    is_blocked TINYINT(4) DEFAULT 1,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ";
                $this->upTable("auth_client_keys", $attributes);
            } catch (\PDOException $e) {
            }
        }
    } 

    /**
     * gets the project root folder
     * @return filePath
     */
    private function getProjectRoot()
    {
        return dirname(\Composer\Factory::getComposerFile());
    }

    /**
     * checks if .env file exists
     * @return bool
     */
    private function getEnv()
    {
        return file_exists($this->getProjectRoot() . "/.env");
    }
}
