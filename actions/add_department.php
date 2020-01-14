<?php

require_once "../config/init.php";

if($_POST){
    //Validation
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



    //Insert to DB
    if($validated){
        $department = new Department();

        $user_data = $_POST;

        $check = $department->insert($user_data);
        if($check){
            Session::flash('success',"Department added successfully");
        }
        else{
            Session::flash('errors',"Error while Adding Department.");
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

    header("Location: ../views/manage-department.php");


}
