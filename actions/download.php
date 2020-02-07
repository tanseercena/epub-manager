<?php
require_once "../config/init.php";

if($_GET['file']){
  $isbn = $_GET['isbn'];
  $original_filename = "../assets/epub_files/$isbn/".trim($_GET['file']);
  if(file_exists($original_filename)){

    // headers to send your file
    // header("Content-Type: application/epub+zip");
    // header("Content-Length: " . filesize($original_filename));
    // header('Content-Disposition: attachment; filename="' . $file . '"');

    $book = new Book();
    $book = $book->where("isbn",$isbn)->first();

    if($book['book_type'] == "text"){ // if doc/docx file
      $file_org = explode(".",$_GET['file']);
      $file = $isbn.".".end($file_org);

      header('Content-Type: application/msword');
    }else{  // epub file
      $file_org = explode("_",$_GET['file']);
      $file = $file_org[1];
      header('Content-Type: application/epub+zip');
    }


    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="'.$file.'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($original_filename));
    flush(); // Flush system output buffer
    readfile($original_filename);
    die();
  }else{
    echo "File Not Found!";
  }

}else{
  echo "Error while downloading File. Please try again.";
}
