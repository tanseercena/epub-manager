<?php

require_once "../config/init.php";

if ($_POST) {

  
    //find in DB

        $sql_query = new Book();
        if (!empty($_POST["query"])) {
            $book_name = $_POST["query"];

            $sql_query->orWhere("isbn","%$book_name%"," LIKE ");
            $sql_query->orWhere("book_title","%$book_name%"," LIKE ")->orWhere("penname","%$book_name%"," LIKE ");

            $books = $sql_query->get();
            
            if (count($books) == 0) {
                echo '<li>No Book Found!</li>';
            }else{
                foreach($books as $book){
                    echo '<li><a href="../views/book-actions.php?id='.$book['id'].'">'.$book['book_title']. '('.$book['isbn'].')'.' - '.$book['penname'].'</a></li>';
                    
                }
            }

        } else{
            echo '<li>No Book Found!</li>';
        }
        

    // header("Location: ../views/dashboard.php");
}
