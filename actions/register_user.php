<?php 

require_once "../config/init.php";

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
            'rules' => 'required|email|min:3|max:30|unique:users.email'
        ],
        [
            'name'  => 'password',
            'value' => $_POST['password'],
            'rules' => 'required|confirm:confirm_password'
        ],
    ];

    $errors = Validator::doValidate($request);
    if(count($errors) == 0){
        $validated = true;
    }

    

    //Insert to DB
    if($validated){
        $user = new User();
        // $user_data = [
        //     'firstname' => $_POST['firstname'],
        //     'lastname'  => $_POST['lastname'],
        //     'email'  => $_POST['email'],
        //     'password' => md5($_POST['password'])
        // ];
    
        $user_data = $_POST;
        unset($user_data['confirm_password']);
 
        $check = $user->insert($user_data);
        if($check){
            echo "User Register";
        }else{
            echo "Error while Register";
        }
    }else{
        // Redirect back with errors
        echo "<pre>";
        print_r($errors);
    }
    

}