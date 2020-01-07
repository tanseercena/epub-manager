<?php 
require_once "../config/init.php";

if($_POST){
    $cover = '';
  	if ($_FILES['cover']) {
  		$upload = new Upload($_FILES['cover'],'../testing/',['size' => 10, 'ext' => ['jpeg','jpg','png']]);
        $upload_data =  $upload->upload();
        if (!$upload_data[0]['error']) {
        	 $cover = $upload_data[0]['filename'];
        }
       
        
    }
    
    $validated = false;
    $request = [
        [
            'name' =>  'book_title',
            'value'=>  $_POST['book_title'],
            'rules' =>  'required'
        ],
        [
            'name' =>  'penname',
            'value'=>  $_POST['penname'],
            'rules' =>  'required'
        ],
        [
            'name' =>  'isbn',
            'value'=>  $_POST['isbn'],
            'rules' =>  'required|numeric|count'
        ],
        [
            'name' =>  'publication_date',
            'value'=>  $_POST['publication_date'],
            'rules' =>  'required' 
        ],
        [
            'name' =>  'book_origin',
            'value'=>  $_POST['book_origin'],
            'rules' =>  'required' 
        ]
    ];

    $errors = Validator::doValidate($request);
    if(count($errors) == 0){
        $validated = true;
    }

    if($validated){
        $book = new Book();
        $book->find($_POST['book_id']);

        $book_data = [ 
            'book_title' => $_POST['book_title'],
            'penname'    => $_POST['penname'],
            'isbn'       => $_POST['isbn'],
            'book_origin'=> $_POST['book_origin'],
            'publication_date' => $_POST['publication_date'],
        ];

        if(!empty($cover)){
            $book_data['cover'] = $cover;
        }

        $check = $book->update($book_data);

        if($check){
            Session::flash('success',"Book Updated Successfully");
        }
        else{
            Session::flash('errors',"Error while updating Book name.");
        }

    }else{
        Session::flash('errors',$errors);
    }

    header("Location: ../views/manage-books.php");

}