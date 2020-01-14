<?php

class Action extends BaseModel
 {
 	private $status_id;
 	private $book_id;
   private $user_id;
   private $department_id;
   private $notes;
   private $base_url;
   private $checker_id;
   private $single_email;
   private $actions = [
      //Development Department Actions
      '1' => [
        //passed id
         '4' =>[2,3,5], //Actions
         '5' =>[6],
         '6' =>[7],
         '7' =>[8,9],
         '8' =>[7],
         '10'=>[7,9],
         '11'=> [12],
         '13'=> [1]
      ],
      //Graphic Department Actions
      '2' => [
         '1' => [4],
         '2' => [4],
         '3' => [4]
      ],
      //House Style Department Actions
      '3' => [
         '1' => [4],
         '2' => [4],
         '3' => [4]
      ],
      //QA Department Actions
      '4' => [
        '9' => [10,11],
        '12' => [13]

      ]
   ];

   private $file_required = [
      '1' => [
         '9' => 1,
         '7' => 1,
      ],
      '3' => [
         '4' => 1,
      ],
      '4' => [
         '11' => 1,
       ]
   ];

   private $next_department_ids = [
      //statusid to departmentid
      '1' => [2,3],
      '2' => [2,3],
      '3' => [2,3],
      '4' => [1],
      '5' => [1],
      '6' => [1],
      '7' => [1],
      '8' => [1],
      '9' => [4],
      '10' => [1],
      '11' => [1],
      '12' => [1],
      '13' => [1],

   ];

   private $to_user = [
      //Department ID => User ID
      '2' => 3,
      '3' => 4,
      '4' => 5
   ];
  private $email_status_ids = array( 1, 2, 3, 4, 5, 9, 12);



   public function __construct($book_id,$status_id,$user_id,$department_id = 0, $notes = '',$base_url = '', $checker_id=0, $single_email = false)
 	{
 		parent::__construct(); //1st implement the parent constructor

 		$this->status_id = $status_id;
 		$this->book_id   = $book_id;
       $this->user_id   = $user_id;
       $this->department_id = $department_id;
       $this->notes = $notes;
       $this->base_url = $base_url;
       $this->checker_id = $checker_id;
       $this->single_email = $single_email;
 	}

    public function save(){
       $data = [
                'book_id'    => $this->book_id,
                'user_id'    => $this->user_id,
                'department_id' => $this->department_id,
                'status_id'  => $this->status_id,
                'notes'  => $this->notes,
                'epubcheck_id'   => $this->checker_id,
                'created_at' => date("Y-m-d H:i:s"),
       ];
       $check=$this->insert($data);
       //Send Notification to DB & Email
      //  if($this->status_id == 1 || $this->status_id == 2 || $this->status_id == 3 || $this->status_id == 4 || $this->status_id == 5 ||
      //  $this->status_id == 9 || $this->status_id == 12)

      $this->sendNotification($check);

      return $check;

    }

    public function sendNotification($action_id)
    {

       $book = new Book();
       $book->find($this->book_id);

       $status = new Status();
       $status->find($this->status_id);

       if($this->department_id == 1){
         //$user_id = $book->user_id;
         $user_id = 2;  // Development User
       }else{
          $user_id = $this->to_user[$this->department_id];
       }
       $user = new User();
       //$user->find($this->user_id);
       $user->find($user_id);

       $app_notification = [
        'title' => "<strong>".$status->title."</strong> - ".$book->book_title,
        'details'   => "<strong>".$status->title."</strong> is processed with Book: ".$book->book_title,
        'user_id' => $user_id,
        'book_id' => $this->book_id,
        'action_id' => $action_id,
        'notify_at' => date("Y-m-d H:i:s")
     ];
     // App Notification
     $appnotification = new AppNotification($app_notification);

     $check = $appnotification->send();

     //Email Notification
     if (in_array($this->status_id, $this->email_status_ids) && !$this->single_email){

      $email_template = file_get_contents("../email_templates/basic.html");
      $search = array(
            '{{$first_msg}}',
            '{{$second_msg}}',
            '{{$third_msg}}',
            '{{$action_url}}',
            '{{$action_text}}'
      );
      $replace = array(
            'Following action is processed with Book: <strong>' .$book->book_title."</strong>",
            'Action: <strong>'.$status->title."</strong>",
            'Action Time: <strong>'.date("Y-m-d H:i:s")."</strong>",
            $this->base_url.'views/book-actions.php?id='.$this->book_id,
            'View Actions'
      );

      $email_template = str_replace($search,$replace,$email_template);

      $email_notification = [

            'to' => $user->email,
            'subject' => 'Epub Action Performed',
            'message' => $email_template,

         ];

      $emailnotification = new EmailNotification($email_notification);
      $check = $emailnotification->send();
    }


    }

    public function getNextAction($status_id, $department_id)
    {
      $next_actions = isset($this->actions[$department_id][$status_id]) ? $this->actions[$department_id][$status_id] : 0;

      return $next_actions;
    }

    public function fileRequired($status_id,$department_id){
      $required = isset($this->file_required[$department_id][$status_id]) ? $this->file_required[$department_id][$status_id] : 2;

      return $required;
    }

    public function getToDepartment($action_status_id){
       $dep_id = isset($this->next_department_ids[$action_status_id]) ? $this->next_department_ids[$action_status_id]: 0;
       return $dep_id;
    }

 }
