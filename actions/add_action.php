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

    if($_POST['book_id'] === 0){
      $validated = false;
    }


    //Insert into DB
    if($validated){

        $action_data  = [
            'book_id' => $_POST['book_id'],
            'user_id'    => $_POST['user_id'],
            'status_id'       => $_POST['status_id'],
            'created_at' => date("Y-m-d H:i:s",strtotime($_POST['created_date'])),
        ];

        // $check = $action->insert($action_data);
        $action = new Action($action_data['book_id'],$action_data['status_id'],$action_data['user_id'],1,"",$base_url);
        $action_id = $action->save($action_data);

        if($action_id){
            $book = new Book();
            $book->find($_POST['book_id']);
            $book->update(["status_id" => $_POST['status_id']]);

            Session::flash('success',"Action added successfully");
        }
        else{
            Session::flash('errors',"Error while Adding Action.");
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

    header("Location: ../views/manage-action.php");


}
