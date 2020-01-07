<?php
   require_once "../config/init.php";

   if ($_GET) {
   	  $book_id = $_GET['book_id'];
   	  
   	  $delete_book = new Book();
   	  $delete_book->find($book_id);

   	  if ($delete_book->id) {
   	      $check = $delete_book->delete();

   	      if ($check) {
   	      	  Session::flash("success","Book deleted successfully");
   	      }
   	      else{
   	      	  Session::flash('errors',"Error while  deleting Book");
   	      }
   	   }
   	  header("Location: ../views/manage-books.php");  
   }