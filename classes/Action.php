<?php

class Action extends BaseModel
 {
 	private $status_id;
 	private $book_id;
 	private $user_id;
  
   public function __construct($book_id,$status_id,$user_id)
 	{
 		parent::__construct();

 		$this->status_id = $status_id;
 		$this->book_id = $book_id;
 		$this->user_id = $user_id;
 	}

    public function save(){
       $data = [
                'book_id'   => $this->book_id,
                'user_id'    => $this->user_id,
                'status_id'  => $this->status_id,
                'created_at' => date("Y-m-d H:i:s"),
       ];

      return $this->insert($data); 
    }

 }