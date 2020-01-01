<?php

require_once "../config/init.php";

if ($_GET) {
    //Find in DB
    $user = new User();
    $user->find($_GET['user_id']);
    if ($user->id) {

        $check = $user->update(['status' => $_GET['status']]);
        if ($check) {
            Session::flash('success', "User Status updated successfully");
        } else {
            Session::flash('errors', "Error while  updating status");
        }

        header("Location: ../views/manage-users.php");
    }
}
