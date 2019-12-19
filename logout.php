<?php

  require_once "config/init.php";

$session = Session::getInstance();

$session->destroy();

  header("Location:login.php");
