<?php 

require_once "../config/init.php";

if($_POST){
    //Validation 
    // print_r($_POST);
    // exit;
    $validated = false;
    $request = [
        [
            'name'  => 'title',
            'value' => $_POST['title'],
            'rules' => 'required'
        ],      
    ];

    $errors = Validator::doValidate($request);
    if(count($errors) == 0){
        $validated = true;
    }

    

    //find in DB
    if($validated){
        $status = new Status();
        $status->find($_POST['id']);
    
     if ($status->id) {
        $status_data = [
            'title' => $_POST['title']
        ];
        // print_r($dep_data);
        // exit;
       
        
        $check = $status->update($status_data);
        // print_r($dep_data);
        // exit;
        if($check){
            Session::flash('success',"Status updated successfully");
        }
        else{
            Session::flash('errors',"Error while updating status name.");
        }
     }
        else {
            echo "Error";
        }
    }else{
        // Redirect back with errors
         Session::flash('errors',$errors);
    }
    
    header("Location: ../views/manage-status.php");
    

}