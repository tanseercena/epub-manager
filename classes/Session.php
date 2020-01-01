<?php 

class Session{

    private static $instance;

    public function __construct(){
        session_start();
    }

    public static function getInstance(){
<<<<<<< HEAD
        if (!self::$instance){ 
            self::$instance = new Session(); 
        } 
        return self::$instance; 
=======
        if (!self::$instance){
            self::$instance = new Session();
        }
        return self::$instance;
>>>>>>> upstream/master
    }

    public function set($key,$value){
        //$_SESSION['key']= value;
        $_SESSION[$key] = $value;
    }


    public function get($key){
       if(isset($_SESSION[$key])){
        return $_SESSION[$key];
       }
<<<<<<< HEAD
       return false; 
=======
       return false;
>>>>>>> upstream/master
    }

    public function unset_key($key){
        unset($_SESSION[$key]);
    }
<<<<<<< HEAD
    
=======

>>>>>>> upstream/master
    public static function has($key){
        return self::get($key);
    }

    public static function flash($key,$value='') {
        if(empty($value)) {
            $value = self::get($key);
            self::unset_key($key);
<<<<<<< HEAD
            return $value;    
=======
            return $value;
>>>>>>> upstream/master
        }
        self::set($key,$value);
    }

    public function destroy(){
        session_destroy();
    }


<<<<<<< HEAD
}
=======
}
>>>>>>> upstream/master
