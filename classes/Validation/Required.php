<?php 

class Required implements ValidationInterface {
    
    private $name;
    private $value;

    public function __construct($name,$value){
        $this->name = ucfirst($name);
        $this->value = $value;
    }

    public function validate(){
        //Main Validation
        if(empty($this->value)){
            return $this->name." is required.";
        }
        return '';
    }
}