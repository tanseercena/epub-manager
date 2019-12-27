<<<<<<< HEAD
<?php 

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/db_config.php";
require_once __DIR__."/site_config.php";
// require_once "models/Database.php";
$session = Session::getInstance();



// $db = new Database($db_host,$db_username,$db_password,$db_name);
// $db = Database::getInstance();
//Design Pattern -> Singleton Pattern

// // DB Class Testing 
// $records = DB::query("SELECT * FROM users WHERE id=1")->first();
// echo "<pre>";
// print_r($records);
// // $records = $db::get();

// // $id = 1;
// // $result = DB::query("UPDATE user SET name='Test' WHERE id=$id");

// // $result = DB:query("SELECT * FROM users LEFT JOIN books ON books.user_id = users.id WHERE users.user_id=1")

// exit;
// $user_data = [
//     'firstname' => 'faiza1',
//     'email' => 'ihsan@gmail.com',
//     'password' => 'sfsdfds'
// ];
 


// $user = new User();
// // $check = $user->insert($user_data);

// $user->where("id",1,'=');

// // $user->where("email",'test123@gmail.com')->where("status",1,'!=');

// $user->orWhere("email","ihsan@gmail.com");
// // $user->orWhere("id",14);


// $user_record = $user->first(); //get single record

// // $user_records = $user->get();    // get multiple records array
// echo $user->getSql();
// echo "<pre>";
// print_r($user_record);
// exit;

// // $users = $user->get();  // get multiple records


// exit;
// $all_users = $user->all();

// echo $user->getSql();

// echo "<pre>";
// print_r($all_users);


// $user->find(2);
// echo $user->getSql();   // Print Last SQL Query

// exit;

// // $check = $user->insert($user_data);
// $user->find(2);


// echo "User ID: ".$user->id;
// echo "<br>Name: ".$user->firstname;
// echo "<br>Email: ".$user->email;

// echo "<hr>";
// echo "After Update<br>";

// $user_update_data = [
//     'firstname' => 'Ihsan Update2',
//     'email' => 'ihsan_update2@gmail.com',
//     'password' => 'sfsdfds_update2'
// ];

// $user->update($user_update_data);

// echo "User ID: ".$user->id;
// echo "<br>Name: ".$user->firstname;
// echo "<br>Email: ".$user->email;
// $user->find(2);
// $user->delete();
// // $qnap_track = new QnapTrack();
=======
<?php 

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/db_config.php";
require_once __DIR__."/site_config.php";
// require_once "models/Database.php";
$session = Session::getInstance();



// $db = new Database($db_host,$db_username,$db_password,$db_name);
// $db = Database::getInstance();
//Design Pattern -> Singleton Pattern

// // DB Class Testing 
// $records = DB::query("SELECT * FROM users WHERE id=1")->first();
// echo "<pre>";
// print_r($records);
// // $records = $db::get();

// // $id = 1;
// $result = DB::query("UPDATE user SET name='Test' WHERE id=$id");

// // $result = DB:query("SELECT * FROM users LEFT JOIN books ON books.user_id = users.id WHERE users.user_id=1")

// exit;
// $user_data = [
//     'firstname' => 'faiza1',
//     'email' => 'ihsan@gmail.com',
//     'password' => 'sfsdfds'
// ];
 


// $user = new User();
// // $check = $user->insert($user_data);

// $user->where("id",1,'=');

// // $user->where("email",'test123@gmail.com')->where("status",1,'!=');

// $user->orWhere("email","ihsan@gmail.com");
// // $user->orWhere("id",14);


// $user_record = $user->first(); //get single record

// // $user_records = $user->get();    // get multiple records array
// echo $user->getSql();
// echo "<pre>";
// print_r($user_record);
// exit;

// // $users = $user->get();  // get multiple records


// exit;
// $all_users = $user->all();

// echo $user->getSql();

// echo "<pre>";
// print_r($all_users);


// $user->find(2);
// echo $user->getSql();   // Print Last SQL Query

// exit;

// // $check = $user->insert($user_data);
// $user->find(2);


// echo "User ID: ".$user->id;
// echo "<br>Name: ".$user->firstname;
// echo "<br>Email: ".$user->email;

// echo "<hr>";
// echo "After Update<br>";

// $user_update_data = [
//     'firstname' => 'Ihsan Update2',
//     'email' => 'ihsan_update2@gmail.com',
//     'password' => 'sfsdfds_update2'
// ];

// $user->update($user_update_data);

// echo "User ID: ".$user->id;
// echo "<br>Name: ".$user->firstname;
// echo "<br>Email: ".$user->email;
// $user->find(2);
// $user->delete();
// // $qnap_track = new QnapTrack();
>>>>>>> upstream/master
// // echo $qnap_track->getTable();