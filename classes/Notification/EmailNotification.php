<?php

class EmailNotification extends Notify {

        
    public function send()
    {
         $mail = new PHPMailer(true);

            //Server settings     
            // $mail->SMTPDebug = true;               
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'dev.viralweb@gmail.com';                    
            $mail->Password   = 'viral321$';                              
            $mail->SMTPSecure = 'tls';         
            $mail->Port       = 587 ;  

                $mail->setFrom('info@viralwebbs.com');
                $mail->addAddress($this->notification['to']);    
                // $mail->addAddress('ellen@example.com');               
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');
                // // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    
                // Content
                // $mail->isHTML(true);                                  
                $mail->Subject = $this->notification['subject'] ;
                $mail->Body = $this->notification['message'];

            if (!$mail->send()){
            return false;
            }
            return true;
    }
    
}