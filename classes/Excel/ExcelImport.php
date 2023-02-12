<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 *
 */
class ExcelImport
{
	private $file;

	private $connection;

	function __construct($file)
	{
		$this->file = $file;
		$this->setConnection();

	}

    function importBooks(){

    	/** Create a new Xls Reader  **/
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($this->file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetData as $key => $book) {
        	if ($key == 1) {
        		continue;
        	}
        	$penname = mysqli_real_escape_string($this->connection,$book["A"]);
        	$title = mysqli_real_escape_string($this->connection,$book["B"]);
        	$isbn = mysqli_real_escape_string($this->connection,$book["C"]);
        	$publication_date = $book["D"];
          $book_type = $book["E"];
          $book_origin = $book["F"];

            $books = new Book();
            $book_data = $books->where("isbn",$isbn)->first();

            if (!$book_data) {
            	$book_array = array(
            				"book_title" => $title,
                    "penname" => $penname,
                    "isbn" => $isbn,
                    "publication_date" =>  date("Y-m-d",strtotime($publication_date)),
                    "status_id" => 1,
                    "book_origin" => $book_origin,
                    "book_type" => $book_type,
										"user_id" => 2,
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

    }

    public function setConnection(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getConnection(){
        return $this->connection;
    }
}
