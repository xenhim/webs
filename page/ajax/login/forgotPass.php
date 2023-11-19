<?php
                    include "mail/src/PHPMailer.php";
                    include "mail/src/Exception.php";
                    include "mail/src/OAuth.php";
                    include "mail/src/POP3.php";
                    include "mail/src/SMTP.php";
                     
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;
                    
                    
                    $mail = new PHPMailer(true);


			$email_forgot=$_POST['email_forgot'];
			$passNew=rand(1000000,9999999);
			 require_once('../../model/connection.php');
			 $db=new config();
			 $db->config();
			 $n=0;
			 if($db->CheckMailExist($email_forgot)){
			     
			     
			     try {
                        //Server settings
                        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'kieule1612@gmail.com';                 // SMTP username
                        $mail->Password = 'tfuodifylbaasczh';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to
                     
                        //Recipients
                        $mail->setFrom('kieule1612@gmail.com', 'Mangavip');
                        $mail->addAddress($email_forgot, 'Password');     // Add a recipient
                        //$mail->addAddress('ellen@example.com');               // Name is optional
                        //$mail->addReplyTo('info@example.com', 'Information');
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com');
                     
                        //Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                     
                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Password new Mangavip';
                        $mail->Body    ='Password new: '.$passNew;
                        //$mail->AltBody = 'Mangavip';
                     
                        $mail->send();
                        //echo 'Message has been sent';
                         $n=1;
                    } catch (Exception $e) {
                        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                        $n=1.5;
                    }
			     
			     $db->UpdatePass($email_forgot,$passNew);
				 $n=$db->CheckMailExist($email_forgot); 
			 }
			 
			    
			 $db->dis_connect();//ngat ket noi mysql
			 
		     			 
 $array=array("success"=>"$n");
     	
echo json_encode($array);

?>