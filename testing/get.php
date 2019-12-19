<?php
require_once "../config/init.php";

$Session =  Session::getInstance();
echo $Session->flash('message');