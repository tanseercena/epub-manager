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
        $department = new Department();
        $department->find($_POST['department_id']);
    
     if ($department->id) {
        $dep_data = [
            'name' => $_POST['name']
        ];
        // print_r($dep_data);
        // exit;
       
        
        $check = $department->update($dep_data);
        // print_r($dep_data);
        // exit;
        if($check){
            Session::flash('success',"Department updated successfully");
        }
        else{
            Session::flash('errors',"Error while updating department name.");
        }
     }
        else {
            echo "Error";
        }
    }else{
        // Redirect back with errors
         Session::flash('errors',$errors);
    }
    
    header("Location: ../views/manage-department.php");
    

}