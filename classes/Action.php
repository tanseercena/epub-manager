<?php

class Action extends BaseModel
 {
 	private $status_id;
 	private $book_id;
 	private $user_id;
  
   public function __construct($book_id,$status_id,$user_id)
 	{
 		parent::__construct(); //1st implement the parent constructor

 		$this->status_id = $status_id;
 		$this->book_id   = $book_id;
 		$this->user_id   = $user_id;
 	}

    public function save(){
       $data = [
                'book_id'    => $this->book_id,
                'user_id'    => $this->user_id,
                'status_id'  => $this->status_id,
                'created_at' => date("Y-m-d H:i:s"),
       ];
       $check=$this->insert($data);
       $this->sendNotification();
      return $check; 

    }
    public function sendNotification()
    {
      
       $book = new Book();
       $book->find($this->book_id);
       $user = new User();
       $user->find($this->user_id);
       $status = new Status();
       $status->find($this->status_id);
      
       $app_notification = [
        'title' => $book->book_title,
        'details'   => $user->firstname,
        'user_id' => 2, //later we will change this
        'book_id' => $this->book_id, 
        'action_id' => $this->id, 
        'notify_at' => date("Y-m-d H:i:s")
     ];
     // App Notification
     $appnotification = new AppNotification($app_notification);
     $check = $appnotification->send();

     //Email Notification
     $email_template = file_get_contents("../email_templates/basic.html");
     $search = array(
         '{{$first_msg}}',
         '{{$second_msg}}',
         '{{$third_msg}}',
         '{{$action_url}}',
         '{{$action_text}}'
     );
     $replace = array(
         'Following action is processed with book: ' .$book->book_title,
         'Action: '.$status->title,
         'Action Date: '.date("Y-m-d H:i:s"),
         'http://localhost/epub-manager/testing.php',
         'View DB'
     );
     
     $email_template = str_replace($search,$replace,$email_template);

     $email_notification = [
         
         'to' => 'dev.viralweb@gmail.com',
         'subject' => 'Epub Actions',
         'message' => $email_template,
        
      ];
     
     $emailnotification = new EmailNotification($email_notification);
     $check = $emailnotification->send();

    }
 }