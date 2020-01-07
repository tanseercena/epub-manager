<?php
require_once "../config/init.php";
// print_r($_POST);
// exit;
if($_POST){
   
    //Insert into DB
        //[1], [2,3]
        $department_ids = json_decode($_POST['department_id']);
        if(count($department_ids) > 1){
            $book = new Book();
            $book->find($_POST['book_id']);
            if($book->book_type == "indesign"){
                $department_id = 2;
            }else{
                $department_id = 3;
            }
            

        }else{
            $department_id = $department_ids[0];
        }

        $action_data  = [ 
            'book_id' => $_POST['book_id'],
            'notes'    => $_POST['notes'],
            'status_id'       => $_POST['status_id'],
            'user_id'    => Session::get("user_id")
        ];

        //Update Book Status 
        $book = new Book();
        $book->find($_POST['book_id']);
        $book->update(['status_id' => $_POST['status_id']]);

        //Add Action and Send Notification
        $action = new Action($action_data['book_id'],$action_data['status_id'],$action_data['user_id'],$department_id,$action_data['notes'],$base_url);
        $check = $action->save($action_data);

        if($check){
               SESSION::flash("success", "Action added Successfully");
        }else{
            SESSION::flash("error", "Error whle adding Action ");
        }
        header("Location:../views/books.php");
       
}