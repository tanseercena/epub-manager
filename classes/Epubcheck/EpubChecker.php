<?php
class EpubChecker {

  public static function validate($epub_file,$book_id){
    $file = basename($epub_file, ".epub");
    $epubcheckjar = __DIR__."/epubcheck/epubcheck.jar";
    $validated_json = __DIR__."/validated_json/".$file.".json"; // later change this path

    if(file_exists($epub_file)){
      //Setup Command
      $cmd = "java -jar $epubcheckjar $epub_file --json $validated_json";

      //Run Command
      exec($cmd);

      if(file_exists($validated_json)){
        //Get epubcheck json output into variable
        $result = file_get_contents($validated_json);
        $result = json_decode($result,true);

        $messages = json_encode($result['messages']);
        $checker = json_encode($result['checker']);

        $fatal_errors = $result['checker']['nFatal'];
        $errors = $result['checker']['nError'];
        $warnings = $result['checker']['nWarning'];

        $validated = true;
        if($fatal_errors > 0 || $errors > 0){
          $validated = false;
        }

        //Save to Database
        // Get DB connection for mysqli_real_escape_string string method
        $db_con = Database::getInstance()->getConnection();
        $data = [
          'book_id' => $book_id,
          'validated' => (!$validated) ? 0 : 1,
          'messages' => mysqli_real_escape_string($db_con,$messages),
          'checker' => mysqli_real_escape_string($db_con,$checker),
          'validated_at' => date("Y-m-d H:i:s")
        ];

        $epub_check = new Epubcheck();
        $epub_check->insert($data);

        //Remove JSON file
        unlink($validated_json);

        // get inserted record id
        $last_id = mysqli_insert_id($db_con);

        return $last_id;
      }
    }

    return false;
  }

}
