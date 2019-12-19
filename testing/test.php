<?php
require_once "../config/init.php";

$Session =  Session::getInstance();
$message="login";
$Session->flash('message',$message);

?>