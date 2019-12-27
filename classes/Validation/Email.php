<?php 

class Email implements ValidationInterface {
    
    private $name;
    private $value;

    public function __construct($name,$value){
        $this->name = ucfirst($name);
        $this->value = $value;
    }

    public function validate(){
        //Main Validation
        if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){
            
            return $this->name." is not valid email address.";
        }
        return '';
    }
}