<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 

$email=$_POST['email_register'];
$pass=$_POST['password_register'];
$k=1;
$n=1;
$emailErr ="";
// tạo kết nối
			require_once('../../model/connection.php');
			//require_once('../../function/function.php');
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format";
            }
			$db=new config();
			$db->config();
			$len=strlen($pass);
			if($len>6 && $emailErr==""){
			$n=$db->Register($email,$pass);
			        $temp=$db->GetInfoUser($email);
					if($temp[1]=="" && $temp[2]!=""){
						$_SESSION['name_comment']=$temp[2]; 
					}else if($temp[1]!="" && $temp[2]==""){
						$_SESSION['name_comment']=$temp[1]; 
					}else if($temp[1]=="" && $temp[2]==""){
						$_SESSION['name_comment']=substr($email,0,strpos($email, '@')); 
					}else if($temp[1]!="" && $temp[2]!=""){
						$_SESSION['name_comment']=$temp[1]." ".$temp[2]; 
					}
			}
			else
			$n=2;
		    $db->dis_connect();//ngat ket noi mysql	
		     
 $array=array("success"=>"$n");
     	
echo json_encode($array);

?>