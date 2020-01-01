<?php 

class Numeric implements ValidationInterface {
    
    private $name;
    private $value;

    public function __construct($name,$value){
        $this->name = ucfirst($name);
        $this->value = $value;
    }

    public function validate(){
        //Main Validation
        if(!is_numeric($this->value)){
            return $this->name." must be numeric.";
        }
        return '';
    }
}