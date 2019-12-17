<?php 

class ValidationStrategy {
    private $validation;

    public function __construct(ValidationInterface $validation){
        $this->validation = $validation;
    }

    public function validate(){
        return $this->validation->validate();
    }
}