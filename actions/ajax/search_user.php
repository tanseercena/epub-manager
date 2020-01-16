<?php
require_once "../../config/init.php";

if($_POST){

  $serach = $_POST['search']['term'];

  $book = new Book();
  $books = $book->where("book_title","%$serach%"," LIKE ")->get();
  $response = [];

  foreach($books as $b){
    $response[] = [
      'id' => $b['id'],
      'text' => $b['book_title']
    ];
  }

  echo json_encode($response);
}
