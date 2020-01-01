<?php 

class Session{

    private static $instance;

    public function __construct(){
        session_start();
    }

    public static function getInstance(){
<<<<<<< HEAD
<<<<<<< HEAD
        if (!self::$instance){ 
            self::$instance = new Session(); 
        } 
        return self::$instance; 
=======
=======
>>>>>>> upstream/master
        if (!self::$instance){
            self::$instance = new Session();
        }
        return self::$instance;
<<<<<<< HEAD
>>>>>>> upstream/master
=======
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
<<<<<<< HEAD
       return false; 
=======
       return false;
>>>>>>> upstream/master
=======
       return false;
=======
       return false;
>>>>>>> 0cd863a0aad0823647bdfa63530b0178d2f36e6a
>>>>>>> upstream/master
    }

    public function unset_key($key){
        unset($_SESSION[$key]);
    }
<<<<<<< HEAD
<<<<<<< HEAD
    
=======

>>>>>>> upstream/master
=======

=======

>>>>>>> 0cd863a0aad0823647bdfa63530b0178d2f36e6a
>>>>>>> upstream/master
    public static function has($key){
        return self::get($key);
    }

    public static function flash($key,$value='') {
        if(empty($value)) {
            $value = self::get($key);
            self::unset_key($key);
<<<<<<< HEAD
<<<<<<< HEAD
            return $value;    
=======
            return $value;
>>>>>>> upstream/master
=======
            return $value;
=======
            return $value;
>>>>>>> 0cd863a0aad0823647bdfa63530b0178d2f36e6a
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
<<<<<<< HEAD
>>>>>>> upstream/master
=======
>>>>>>> 0cd863a0aad0823647bdfa63530b0178d2f36e6a
>>>>>>> upstream/master
