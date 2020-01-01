<<<<<<< HEAD
<?php 
require_once "config/init.php";
// $user = new User();
// echo $user->get_numeric('3'); // int(3)
// echo $user->get_numeric('A'); // float(1.2)
// echo $user->get_numeric('..');


$user_id = Session::get("user_id");
echo "User ID -> ".$user_id;

?>
=======
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
require_once "config/init.php";
echo "Home";

?>
>>>>>>> upstream/master
