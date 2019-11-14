<?php

namespace Core;
use PDO;
use PDOException;

class Database {
    private $db_handler;
    private $stmt;
    private $error;

    public function __construct(){
        $dbParams =  App::get('database');

        $params = 'mysql:host=' . $dbParams['host'] . ';dbname=' . $dbParams['dbname'];
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );

        try{
            $this->db_handler = new PDO($params, $dbParams['username'], $dbParams['password'], $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepared statments with query
    public function query($sql){
        $this->stmt = $this->db_handler->prepare($sql);

        return $this;
    }

    // Bind values
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOLL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);

        return $this;
    }

    // Execute the prepared statment
    public function execute(){
        return $this->stmt->execute();
    }

    // Get result set as array of object
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Get single record as object
    public function single(){
        $this->execute();
        return $this->stmt->fetch();
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}