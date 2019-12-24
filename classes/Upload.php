<?php

/**
 * 
 */
class Upload
{
	private $path;

	private $file_post;

	private $validation_rule;

	private $errors;

	private $status;

	private $response;

	private $total_files;

	private $is_multiple = false;

	function __construct($file_post,$path,$validation_rule = ['size' => 5, 'ext' => ['xls']])
	{
		$this->file_post = $file_post; 
		$this->path = $path;  
		$this->validation_rule = $validation_rule;
        $this->total_files = 0;
        if (is_array($this->file_post['name'])) {
         		$this->is_multiple = true;
         		$this->total_files = count($this->file_post['name']);
         } 	
	}
	public function validate(){
		$status = true;
       if ($this->is_multiple == true) {
        	for($i=0;$i<$this->total_files;$i++){
              $filename = $this->file_post['name'][$i]; 
              $filesize = $this->file_post['size'][$i];

              $ext = pathinfo($filename, PATHINFO_EXTENSION);

              if (!in_array($ext, $this->validation_rule['ext'])) {
		      	 $this->errors[] = "Extension is wrong";
		      	 $status = false;
		      }

		      if ($filesize > $this->validation_rule['size']*1024*1024 || $filesize == 0) {
		      	 $this->errors[] = "Size is bigger than the recommended one";
		      	 $status = false;
		      }
            } 
            $this->status = $status;
        }
        else{
			  $filename = $this->file_post['name'];
			  $filesize = $this->file_post['size']; 

		      $ext = pathinfo($filename, PATHINFO_EXTENSION);

		      if (!in_array($ext, $this->validation_rule['ext'])) {
		      	 $this->errors[] = "Extension is wrong";
		      	 $status = false;
		      }
		      if ($filesize > ($this->validation_rule['size']*1024*1024) || $filesize == 0) {
		      	 $this->errors[] = "Size is bigger than the recommended one";
		      	 $status = false;
		      }

		      $this->status = $status;
		}

      return $this->status;
	}

	public function getErrors(){
		return $this->errors; 
	}

	public function upload(){ 
		$new_file_name = "";
		$status = false;
		$resp = [];

        if ($this->validate()) {
   
	        if ($this->is_multiple == true) {
	        	for($i=0;$i<$this->total_files;$i++) {
	        		    $file_post = $this->file_post['name'][$i];
	        		    $ext = pathinfo($file_post, PATHINFO_EXTENSION);
		        		$multiple_file_directory = $this->path;
					    $new_file_name = time()."_".$this->file_post['name'][$i]; 
					    $multiple_uploaded_file = $multiple_file_directory.basename($new_file_name); 

		        	    move_uploaded_file($this->file_post['tmp_name'][$i], $multiple_uploaded_file);
		        	    $resp[] =  [
								"status" => $status,
								"destination" => $this->path,
								"size_in_mb" => $this->file_post['size'][$i],
								"extension" => $ext,
								"original_filename" => $this->file_post['name'][$i],
								"filename" => $new_file_name,
								"post_data" => $this->file_post,
								"errors" => $this->getErrors(),
							];
	        	    }
	        	}
        
	        elseif ($this->is_multiple == false){
	        	    $file_post = $this->file_post['name'];
	        		$ext = pathinfo($file_post, PATHINFO_EXTENSION);
					$directory = $this->path;
					$new_file_name = time()."_".$this->file_post['name'];
					$uploaded_file = $directory.basename($new_file_name); 

					move_uploaded_file($this->file_post['tmp_name'], $uploaded_file);

		            $status = true;
		            $resp[] = [
							"status" => $status,
							"destination" => $this->path,
							"size_in_mb" => $this->file_post['size'],
							"extension" => $ext,
							"original_filename" => $this->file_post['name'],
							"filename" => $new_file_name,
							"post_data" => $this->file_post,
							"errors" => $this->getErrors(),
						];
			}
        }
        else{
        	$resp[] = [
				"status" => $status,
				"destination" => $this->path,
				"size_in_mb" => $this->file_post['size'],
				"extension" => " ",
				"original_filename" => $this->file_post['name'],
				"filename" => $new_file_name,
				"post_data" => $this->file_post,
				"errors" => $this->getErrors(),
			];
        }
	
		return $resp;	
	}

}