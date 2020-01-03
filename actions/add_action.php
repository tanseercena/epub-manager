<?php 

require_once "../config/init.php";
// print_r($_POST);
// exit;
if($_POST){
    //Validation 
    $validated = false;
    $request = [
        [
            'name'  => 'book_id',
            'value' => $_POST['book_id'],
            'rules' => 'required'
        ],
        [
            'name'  => 'user_id',
            'value' => $_POST['user_id'],
            'rules' => 'required'
        ],
        [
            'name'  => 'status_id',
            'value' => $_POST['status_id'],
            'rules' => 'required'
        ], 
         [
             'name' =>  'created_at',
             'value'=>  $_POST['created_date'],
              'rules' =>  'required'
               
         ],             
    ];

    $errors = Validator::doValidate($request);
    if(count($errors) == 0){
        $validated = true;
    }

    

    //Insert into DB
    if($validated){
        $action = new Action();
     
        $action_data  = [ 
            'book_id' => $_POST['book_id'],
            'user_id'    => $_POST['user_id'],
            'status_id'       => $_POST['status_id'],
            'created_at' => date("Y-m-d H:i:s",strtotime($_POST['created_date'])),    
];
        
        $check = $action->insert($action_data);
       
        if($check){
            Session::flash('success',"Action added successfully");
        }
        else{
            Session::flash('errors',"Error while Adding Action.");
        }
    }else{
        // Redirect back with errors
         Session::flash('errors',$errors);
    }
    
    header("Location: ../views/manage-action.php");
    

}

