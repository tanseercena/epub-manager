<?php 

require_once "../config/init.php";

if($_GET){
    //Validation 
    
    
        $action = new Action(0,0,0);
        $action->find($_GET['action_id']);
     if ($action->id) {
        
        $check = $action->delete();
       
        if($check){
            Session::flash('success',"Action deleted successfully");
        }
        else{
            Session::flash('errors',"Error while  deleting action");
        }
     }
        else {
            echo "Error";
        }
   
    
    header("Location: ../views/manage-action.php");
    

}