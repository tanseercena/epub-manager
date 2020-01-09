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
        $isbn = $book->isbn;
        $book_id = $book->id;
        $book->update(['status_id' => $_POST['status_id']]);

        //Add Action and Send Notification
        $action = new Action($action_data['book_id'],$action_data['status_id'],$action_data['user_id'],$department_id,$action_data['notes'],$base_url);
        $action_id = $action->save($action_data);

        //Save file if it is required
        $user_dep_id = Session::get("department_id");
        if($action->fileRequired($_POST['status_id'], $user_dep_id)){

          //Create folder with book ISBN if not exists
          if (!file_exists('../assets/epub_files/'.$isbn)) {
              mkdir('../assets/epub_files/'.$isbn, 0777, true);
          }

          //Upload File
          if ($_FILES['file'] && $_FILES['file']['size'] != 0) {
             $epub_file = new Upload($_FILES['file'],'../assets/epub_files/'.$isbn."/",['size' => 10, 'ext' => ['epub']]);
             $epub_file =  $epub_file->upload();
             if (!$epub_file[0]['errors']) {
            	  $epub_file = $epub_file[0]['filename'];
                //Validate Epub using EpubChecker
                $check_id = EpubChecker::validate('../assets/epub_files/'.$isbn."/".$epub_file,$book_id);
                if($check_id){
                  // Successfully Validated
                  // Update Book Status and Add Action
                }else{
                  //Validation Faild
                  // Update Book Status and Add Action
                }
             }
             else{
               // Validation Faild due to file size
               // Update Book Status and Add Action
             }
          }
        }

        if($action_id){
               SESSION::flash("success", "Action added Successfully");
        }else{
            SESSION::flash("error", "Error whle adding Action ");
        }
        header("Location:../views/books.php");

}
