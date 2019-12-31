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
       if(isset($_SESSION[$key])){
        return $_SESSION[$key];
       }
       return false;
    }

    public function unset_key($key){
        unset($_SESSION[$key]);
    }

    public static function has($key){
        return self::get($key);
    }

    public static function flash($key,$value='') {
        if(empty($value)) {
            $value = self::get($key);
            self::unset_key($key);
            return $value;
        }
        self::set($key,$value);
    }

    public function destroy(){
        session_destroy();
    }


}
