<?php
require_once "../config/init.php";

if($_POST){
    //Validation
    //TODO

    $validated = true;
    if($validated){
        $user = new User();
        $user_data= $user->where("email",$_POST['email'])
            ->where("password",$_POST['password'])->first();
       
        // Set Session
        if(isset($user_data['id'])){

            Session::set('user_id',$user_data['id']);
            header("Location:../testing/testing1.php");
            
        }
        else 
        {
            Session::flash('error',"There was some error in login");
            header("Location:../login.php");
           
        }    
    }
}