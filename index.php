<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
require_once "config/init.php";
$user_id = Session::get("user_id");
if(isset($user_id)){
    header("Location: views/dashboard.php");
}

?>
