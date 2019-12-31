<?php 

class DB {
    private static $connection = null;

    private static $query = null;

    private static $result = null;

    public static function query($sql = ''){
        if(self::$connection  == null){
            self::setConnection();
        }

        // if(self::$query  == null){
        //     self::$query = new Query(self::$connection);
        // }

        self::$result = mysqli_query(self::$connection,$sql);
        
        return new static();
        
    }

    public static function get(){
        $records = [];

        while($row = mysqli_fetch_array(self::$result)){
            $records[] = $row;
        }
        
        return $records;
    }

    public static function first(){
        if(mysqli_num_rows(self::$result) > 0){
            return mysqli_fetch_array(self::$result);
        }
        return false;
    }



    public static function setConnection(){
        self::$connection = Database::getInstance()->getConnection();
    }
}