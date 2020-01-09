<?php
    require_once __DIR__."/../config/init.php";
    if ($_GET["id"]) {
    	$read_notification = new Notification();
    	$notify_id = $_GET["id"];
    	$read_notification->find($notify_id);
    	$read_notification->update(["notification_read"=>1]);
    	header('Location:../views/all-notification.php'); 
       
     }
     
       	
