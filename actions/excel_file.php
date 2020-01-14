<?php
require_once "../config/init.php";
if (isset($_POST["submit"])) {
	$upload = new Upload($_FILES["file"] ,__DIR__."/../assets/uploads/",['size' => 30, 'ext' => ['xls','xlsx']]);
    $upload = $upload->upload();
    if (!$upload[0]['error']) {
        	 $filename = $upload[0]['filename'];
        	 $import_excel = new ExcelImport(__DIR__."/../assets/uploads/".$filename);
             $import_excel->importBooks();
						 Session::flash("success","Books Successfully Imported");
        }
    else{
    	Session::flash("errors","Error while uploading");
    }
}

header("Location:../views/manage-excel.php");
