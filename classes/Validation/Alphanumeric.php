<?php

 class Alphanumeric implements ValidationInterface{

    private $name;

    private $value;

    public function __construct($name,$value){

    	$this->name  = ucfirst($name);
    	$this->value = $value;
    }

    public function Validate(){
        $this->value = str_replace(' ', '', $this->value);
    	if ((!ctype_digit($this->value) && !ctype_alpha($this->value) ) || is_numeric($this->value) ) {

    		return $this->name.' shouldnot be numeric';
    	}
    	return '';
    }
 }