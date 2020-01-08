<?php
require_once "../config/init.php";
if (isset($_POST["submit"])) {
	$upload = new Upload($_FILES["file"] ,__DIR__."/../assets/uploads/",['size' => 30, 'ext' => ['xls']]);
    $upload = $upload->upload();
    if (!$upload[0]['error']) {
        	 $filename = $upload[0]['filename'];
        	 $import_excel = new ExcelImport(__DIR__."/../assets/uploads/".$filename); 
             $import_excel->importBooks();

        }
    else{
    	Session::flash("success","Error while uploading");
    }
}

header("Location:../views/manage-excel.php");