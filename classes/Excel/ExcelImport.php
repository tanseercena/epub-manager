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

            $book = new Book();
            $book_data = $book->where("isbn",$isbn)->first();

            if (!$book_data) {
            	$book_array = array(
            		"book_title" => $title,
                    "penname" => $penname,
                    "isbn" => $isbn,
                    "publication_date" =>  date("Y-m-d",strtotime($publication_date)),
                    // "origin" => $origin,
            	);
              $book = new Book();
            $check = $book->insert($book_array);
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