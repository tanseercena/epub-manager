<?php 

class Session{

    private static $instance;

    public function __construct(){
        session_start();
    }

    public static function getInstance(){
        if (!self::$instance){ 
            self::$instance = new Session(); 
        } 
        return self::$instance; 
    }

    public function set($key,$value){
        //$_SESSION['key']= value;
        $_SESSION[$key] = $value;
    }


    public function get($key){
        // echo $_SESSION['key'];
        return $_SESSION[$key];
    }

    public function unset_key($key){
        unset($_SESSION[$key]);
    }

    public function destroy(){
        session_destroy();
    }


}