<?php

namespace Core;

use PDO, PDOException;

class Database
{
    /**
     * @var PDO
     */
    private $pdo;
    /**
     * @var PDO statement
     */
    private $stmt;
    /**
     * @var string
     */
    private $error;
    /**
     * Class instance
     *
     * @var Database
     */
    private static $instance;

    /**
     * Connect to database
     * Save instance into property $pdo
     *
     * @param string $type
     * @param string $host
     * @param string $dbname
     * @param string $username
     * @param string $password
     */
    private function __construct(string $type, string $host, string $dbname, string $username, string $password){
        $params = $type . ':host=' . $host . ';dbname=' . $dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->pdo = new PDO($params, $username, $password, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Singleton
     * Create object only if instance does't already exists
     *
     * @param string $type
     * @param string $host
     * @param string $dbname
     * @param string $username
     * @param string $password
     * @return Database
     */
    public static function getInstance(string $type, string $host, string $dbname, string $username, string $password)
    {
        if (self::$instance === null) {
            self::$instance = new self($type, $host, $dbname, $username, $password);
        }
        return self::$instance;
    }

    /**
     * Make prepared statement
     *
     * @param $sql
     * @return $this
     */
    public function query($sql){
        $this->stmt = $this->pdo->prepare($sql);

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
     * @param string $className
     * @return null | array [objects]
     */
    public function resultSet(string $className){
        $this->setFetchMode($className);
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * @param string $className
     * @return null | object
     */
    public function single(string $className){
        $this->setFetchMode($className);
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * @return integer
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    /**
     * Set PDO fetch mode into specific class
     *
     * @param string $className
     */
    private function setFetchMode(string $className)
    {
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $className);
    }
}