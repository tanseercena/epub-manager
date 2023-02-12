<?php
require_once "../../config/init.php";

if($_POST){
  $user_id = $_POST['user_id'];
  $book_id = $_POST['book_id'];

  $book = new Book();
  $book->find($book_id);
  $check = $book->update(['user_id'=>$user_id]);
  if($check){
    Session::flash('success',"User Assigned to Book Successfully");
    echo "success";
  }else{
    Session::flash('errors',"Error while assigning User to Book.");
    echo "error";
  }
}
