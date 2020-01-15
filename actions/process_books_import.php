<?php
require_once "../config/init.php";

if($_POST){
  $books = unserialize(base64_decode($_POST['books']));
  $db = $_POST['db'];
  $book_type = "";

  foreach($books as $book){

    $books = new Book();
    $book_data = $books->where("isbn",$book['isbn'])->first();

    if (!$book_data) {
      if($book['book_type'] == "text+pic word" || $book['book_type'] == "illustration word" || $book['book_type'] == "text"){
        $book_type = "text";
      }else if($book['book_type'] == "text+pic indesign" || $book['book_type'] == "text+pic indesign"){
        $book_type = "indesign";
      }

      $db_con = Database::getInstance()->getConnection();
      $book_array = array(
            "book_title" => mysqli_real_escape_string($db_con,$book['book_title']),
            "penname" => mysqli_real_escape_string($db_con,$book['penname']),
            "isbn" => $book['isbn'],
            "publication_date" =>  date("Y-m-d",strtotime($book['date_publication'])),
            "status_id" => 1,
            "book_origin" => $db,
            "book_type" => $book_type,
            "user_id" => 2,
            'cover' => $book['cover'],
            'created_at' => date("Y-m-d H:i:s")
      );

      $book1 = new Book();
      $book_id = $book1->insert($book_array);
      $user_id = Session::get("user_id");

      if($book_type == 'text'){
        $department_id = 3;
      }
      else if($book_type == 'indesign'){
        $department_id = 2;
      }

      $action = new Action($book_id,1,$user_id,$department_id,'',$base_url,0,true);
      $check1 = $action->save();
    }
  }

  Session::flash("success","Books Successfully Imported");

}
header("Location:../views/books-import.php");
