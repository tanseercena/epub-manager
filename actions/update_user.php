<?php

require_once "../config/init.php";

if($_POST){
    //Validation
    // print_r($_POST);
    // exit;
    $validated = false;
    $request = [
        [
            'name'  => 'name',
            'value' => $_POST['name'],
            'rules' => 'required'
        ],
    ];

    $errors = Validator::doValidate($request);
    if(count($errors) == 0){
        $validated = true;
    }



    //find in DB
    if($validated){
        $user = new User();
        $user->find($_POST['user_id']);

     if ($user->id) {
        $user_data = [
            'name' => $_POST['name']
        ];
        // print_r($dep_data);
        // exit;


        $check = $user->update($user_data);
        // print_r($dep_data);
        // exit;
        if($check){
            Session::flash('success',"User updated successfully");
        }
        else{
            Session::flash('errors',"Error while updating User name.");
        }
     }
        else {
            echo "Error";
        }
    }else{
        // Redirect back with errors
        $errors_txt = "";
        foreach($errors as $error){
          foreach($error as $err){
            $errors_txt .='<p>'.$err.'</p>';
          }
        }
         Session::flash('errors',$errors_txt);
    }

    header("Location: ../views/manage-users.php");


}
