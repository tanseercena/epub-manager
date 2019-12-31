<?php 

class Unique implements ValidationInterface {
    
    private $name;
    private $value;
    private $table_column;
    
   

    public function __construct($name,$value,$table_column){
        $this->name = ucfirst($name);
        $this->value = $value;
        $this->table_column = $table_column;
    }

    public function validate(){
        $unique_check = explode(".",$this->table_column);
        $table= $unique_check[0];
        $column=$unique_check[1];
    
        $result =DB::query( "SELECT * FROM ".$table." where $column = '".$this->value."'");
        $data = $result->first();
        
        if($data){
          return $this->name." must be unique.";
        }

        return '';
    }
}