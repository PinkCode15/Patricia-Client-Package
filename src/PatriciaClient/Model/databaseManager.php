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
            // $this->createClientTable();
            // $this->createClientKeysTable();

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
                // echo "Table created successfully";
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
        $statement =  "DROP TABLE IF EXISTS  " . $tableName;
        try {
            $query = $this->pdoConnection->prepare($statement);
            $query->execute();
        } catch (\PDOException $e) {
            throw new \Exception($e);
        }
    }
    

    /**
     * select from table based on id if the table  exists
     * @return Array
     */
    public function selectById(String $tableName, int $id)
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
     * @return Array
     */
    public function selectByColumn(String $tableName, String $column, String $value, $limit = null)
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
    public function insertIntoTable($tableName, $array)
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
     * update table by specific Column if the table  exists return the lastInsertId
     * @return Int
     */
    public function updateTableByColumn(String $tableName, array $array)
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
             return   $statement = "UPDATE " . $tableName . " SET " . $query . " WHERE " . $column . "= ? ";
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
    public function truncateTable(String $tableName)
    {
        if ($this->checkTable($tableName)) {
            try {
                $statement =  "TRUNCATE TABLE ". $tableName;
                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
                // return true;
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }



    /**
     * delete record table if the table  exists 
     * @return bool
     */
    public function deleteFromTable(String $tableName, String $column, String $id)
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
     * @return boolean
     */
    private function checkTable($tableName)
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
