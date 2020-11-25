<?php

namespace PatriciaClient\Model;

use Dotenv\Dotenv;

class DatabaseManager
{

    function __construct()
    {
        if ($this->getEnv()) {
            $dotenv = Dotenv::createImmutable($this->getProjectRoot());
            $dotenv->load();
            $this->dbName = $_ENV['DB_DATABASE'] ?? '';
            $this->dbUser = $_ENV['DB_USERNAME'] ?? '';
            $this->dbPassword = $_ENV['DB_PASSWORD'] ?? '';
            $this->dbHost = $_ENV['DB_HOST'] ?? '';
            $this->dbPort = $_ENV['DB_PORT'] ?? '';
            $this->dbConnection = $_ENV['DB_CONNECTION'] ?? '';
            $this->pdoConnection = new \PDO(
                $this->dbConnection . ":host=" . $this->dbHost,
                $this->dbUser,
                $this->dbPassword
            );
            $this->createDataBase();
            $this->useDataBase();

            $this->pdoConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdoConnection->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        }
    }

    /**
     * creates a new table if the table doesn't exists
     * @return String
     */
    public function upTable($tableName, $attribute)
    {
        if (!$this->checkTable($tableName)) {
            $statement =  "CREATE TABLE " . $tableName . " ( " . $attribute . ")";
            try {

                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
                echo "Table created successfully";
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }


    /**
     * drops a table if the table  exists
     * @return String
     */
    public function downTable($tableName)
    {
        if ($this->checkTable($tableName)) {
            $statement =  "DROP TABLE " . $tableName;
            try {
                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
                echo "Table dropped successfully";
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }

     /**
     * inserts into table if the table  exists
     * @return String
     */
    public function insertIntoTable($tableName, $attribute, $value)
    {
        if ($this->checkTable($tableName)) {
            $statement =  "INSERT INTO " . $tableName . " ( " . $attribute . 
                            ") VALUES (" . $value . ")";
            try {
                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
                echo "Inserted into table successfully";
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }

    /**
     * checks if a table  exists
     * @return boolean
     */
    private function checkTable($tableName)
    {
        $statement = "select 1 from " . $tableName;
        try {
            $query = $this->pdoConnection->prepare($statement);
            $result = $query->execute();
            return $result;
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
            throw new \Exception($e);
        }
    }

    /**
     * creates a database 
     * @return null
     */
    private function createDataBase()
    {
        try {
            $statement = "CREATE DATABASE IF NOT EXISTS " . $this->dbName;
            $query = $this->pdoConnection->prepare($statement);
            $query->execute();
        } catch (\PDOException $e) {
            throw new \Exception($e);
        }
    }

    /**
     * gets the project root folder
     * @return filePath
     */
    private function getProjectRoot()
    {
        $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
        $vendorDir = dirname(dirname(dirname($reflection->getFileName())));
        return $vendorDir;
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
