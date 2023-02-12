<?php

require_once "../config/init.php";
// print_r($_POST);
// exit;
if($_POST){
    //Validation
    $validated = false;
    $request = [
        [
            'name'  => 'firstname',
            'value' => $_POST['firstname'],
            'rules' => 'required'
        ],
        [
            'name'  => 'email',
            'value' => $_POST['email'],
            'rules' => 'required|email'
        ],
        [
            'name'  => 'password',
            'value' => $_POST['password'],
            'rules' => 'required'
        ],
        [
            'name'  => 'department_id',
            'value' => $_POST['department_id'],
            'rules' => 'required'
        ],
    ];

    $errors = Validator::doValidate($request);
    if(count($errors) == 0){
        $validated = true;
    }



    //Insert into DB
    if($validated){
        $user = new User();

        $user_data = $_POST;

        $check = $user->insert($user_data);

        if($check){
            Session::flash('success',"User added successfully");
        }
        else{
            Session::flash('errors',"Error while Adding User.");
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
