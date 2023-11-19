<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 

$email=$_POST['email_login'];
$pass=$_POST['password_login'];

			require_once('../../model/connection.php');
			$db=new config();
			$db->config();
			 $n=$db->CheckLogin($email,$pass);
			
				if($n==1){
					$_SESSION['email'] = $email;
					$temp=$db->GetInfoUser($email);
					if($temp[1]=="" && $temp[2]!=""){
						$_SESSION['name_comment']=$temp[2]; 
					}else if($temp[1]!="" && $temp[2]==""){
						$_SESSION['name_comment']=$temp[1]; 
					}else if($temp[1]=="" && $temp[2]==""){
						//echo substr($email,0,strpos($email, '@'));
						$_SESSION['name_comment']=substr($email,0,strpos($email, '@')); 
					}else if($temp[1]!="" && $temp[2]!=""){
						$_SESSION['name_comment']=$temp[1]." ".$temp[2]; 
					}
					  
				}
		  $db->dis_connect();//ngat ket noi mysql
 $array=array("success"=>"$n");
     	
echo json_encode($array);

?>