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
       return ''; 
    }

    public function unset_key($key){
        unset($_SESSION[$key]);
    }

    public function flash($key,$value='')
    {
        if(empty($value))
        {
            $value = Session::get($key);
            $this->unset_key($key);
            return $value;    
        }

        Session::set($key,$value);
    }

    public function destroy(){
        session_destroy();
    }


}