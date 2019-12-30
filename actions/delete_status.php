<?php

require_once "../config/init.php";

if ($_GET) {
    //Validation 
    // print_r($_POST);
    // exit;





    //Find in DB

    $status = new Status();
    $status->find($_GET['status_id']);
    if ($status->id) {


        $check = $status->delete();
        // echo print_r($check);
        // exit;
        if ($check) {
            Session::flash('success', "Status deleted successfully");
        } else {
            Session::flash('errors', "Error while  deleting status");
        }
    } else {
        echo "Error";
    }


    header("Location: ../views/manage-status.php");
}
