<?php

abstract class Notify {

private $connection;

private $query;

public $notification;

public $emailnotification;

public function __construct($notification){
    $this->setConnection();
    $this->notification = $notification; 
}

public abstract function send();

public function setConnection(){
    $this->connection = Database::getInstance()->getConnection();
}

public function getConnection(){
    return $this->connection;
}

}