<?php 

/** 
 * Database Connection Class
 * Singleton Design Pattern
 */
class Database {
    private static $instance;
    protected static $snakeCache = [];
    private $db_config;
    
    
    private $connection;

    public function __construct(){
        $this->db_config = $this->getDBConfig();

        //connect to DB
        $this->connection = mysqli_connect($this->db_config['db_host'],$this->db_config['db_username'],$this->db_config['db_password'],$this->db_config['db_name']);
        if(!$this->connection){
            die("Error while connecting to DB!");
        }
    }

    public static function getInstance(){
        if (!self::$instance){ 
            self::$instance = new Database(); 
        } 
        return self::$instance; 
    }

    public function getDBConfig(){
        return $db_config = include(__DIR__."/../config/db_config.php");
    }
    
    public function getConnection(){
        return $this->connection;
    }


}