<?php 

require_once "../config/init.php";

if($_GET){
    //Validation 
    // print_r($_POST);
    // exit;
  


    

    //Find in DB
    
        $department = new Department();
        $department->find($_GET['department_id']);
     if ($department->id) {
        

        $check = $department->delete();
        // echo print_r($check);
        // exit;
        if($check){
            Session::flash('success',"Department deleted successfully");
        }
        else{
            Session::flash('errors',"Error while  deleting department");
        }
     }
        else {
            echo "Error";
        }
   
    
    header("Location: ../views/manage-department.php");
    

}