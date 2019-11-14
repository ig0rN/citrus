<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    /**
     * @var PDO
     */
    private $db_handler;
    /**
     * @var PDO statement
     */
    private $stmt;
    /**
     * @var string
     */
    private $error;

    /**
     * Connect to database
     * Save instance to property $db_handler
     *
     * Database constructor.
     */
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

    /**
     * Make prepared statement
     *
     * @param $sql
     * @return $this
     */
    public function query($sql){
        $this->stmt = $this->db_handler->prepare($sql);

        return $this;
    }

    /**
     * Bind params to prepared statement if needed
     *
     * @param $param
     * @param $value
     * @param null $type
     * @return $this
     */
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

    /**
     * Execute prepared statement
     *
     * @return mixed
     */
    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * Return array of objects
     *
     * @return null | array of objects
     */
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * Return object
     *
     * @return mixed
     */
    public function single(){
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * Return row numbers;
     *
     * @return mixed
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}