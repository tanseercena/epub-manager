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

        sleep(1); // Wait for 1 second to make time difference in file action

        //Save file if it is required
        $user_dep_id = Session::get("department_id");
        if($action->fileRequired($_POST['status_id'], $user_dep_id)){
          //Create folder with book ISBN if not exists
          if (!file_exists('../assets/epub_files/'.$isbn)) {
              mkdir('../assets/epub_files/'.$isbn, 0777,true);
              chmod('../assets/epub_files/'.$isbn, 0777);
          }

          //Upload File
          if ($_FILES['file'] && $_FILES['file']['size'] != 0) {
              if($_POST['status_id'] == 4){
                $validation = ['size' => 20, 'ext' => ['doc','docx']];
              }else{
                $validation = ['size' => 10, 'ext' => ['epub']];
              }
             $epub_file = new Upload($_FILES['file'],'../assets/epub_files/'.$isbn."/",$validation);
             $epub_file =  $epub_file->upload();
             if (!$epub_file[0]['errors']) {
            	  $epub_file = $epub_file[0]['filename'];

                if($_POST['status_id'] == 4){ // When HS upload File

                }else{  // When Development Upload Epub File
                  //Validate Epub using EpubChecker
                  $check_id = EpubChecker::validate('../assets/epub_files/'.$isbn."/".$epub_file,$book_id);
                  if($check_id){
                    $epub_check = new Epubcheck();
                    $epub_check->find($check_id);
                    $validated = $epub_check->validated;
                    if($validated){
                      // Successfully Validated
                      // Update Book Status and Add Action
                      $action = new Action($action_data['book_id'],9,$action_data['user_id'],4,"Auto Validated.",$base_url,$check_id);
                      $action_id = $action->save($action_data);
                      $book->update(['status_id' => 9]);
                      if($user_dep_id == 4 && $_POST['status_id'] == 11){ // If QA Passed
                        $book->update(['status_id' => 11]);
                      }
                    }else{
                      //Validation Faild
                      // Update Book Status and Add Action
                      $action = new Action($action_data['book_id'],8,$action_data['user_id'],$department_id,"Validation Fail. See Checker Logs.",$base_url,$check_id);
                      $action_id = $action->save($action_data);
                      $book->update(['status_id' => 8]);
                    }

                  }else{
                    //Validation Faild
                    // Update Book Status and Add Action
                    $action = new Action($action_data['book_id'],8,$action_data['user_id'],$department_id,"Validation Fail. See Checker Logs.",$base_url,$check_id);
                    $action_id = $action->save($action_data);
                    $book->update(['status_id' => 8]);
                  }
                }


                //Save file to DB
                $book_file = new BookFile();
                $book_file->insert([
                  'filename' => $epub_file,
                  'book_id' => $action_data['book_id'],
                  'action_id' => $action_id,
                  'user_id' => $action_data['user_id'],
                  'created_at' => date("Y-m-d H:i:s")
                ]);

             }
             else{
               // Validation Faild due to file size
               // Update Book Status and Add Action
               if($_POST['status_id'] != 4){
                   $action = new Action($action_data['book_id'],8,$action_data['user_id'],$department_id,"Validation Fail. File Size Issue.",$base_url,$check_id);
                   $action_id = $action->save($action_data);
                   $book->update(['status_id' => 8]);
                }
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
