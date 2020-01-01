<?php 

require_once "../config/init.php";

if($_GET){
    //Validation 
    // print_r($_POST);
    // exit;

    //Find in DB
        $user = new User();
        $user->find($_GET['user_id']);
     if ($user->id) {
        $check = $user->delete();
        // echo print_r($check);
        // exit;
        if($check){
            Session::flash('success',"User deleted successfully");
        }
        else{
            Session::flash('errors',"Error while  deleting user");
        }
     }
        else {
            echo "Error";
        }
   
    
    header("Location: ../views/manage-users.php");
    

}