<?php

class Count implements ValidationInterface{

	private $name;
	private $value;

	public function __construct($name,$value){
       $this->name  = ucfirst($name);
       $this->value = $value;
 	}

 	public function validate(){

 		if (strlen($this->value) != 13) {
 			echo strlen($this->value);
 			return $this->name." should have 13 characters.";
 		}
 		return '';
 	}
}