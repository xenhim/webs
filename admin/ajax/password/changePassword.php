<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
if(!isset($_SESSION['password_old']))
	$_SESSION['password_old']="";
	if(!isset($_SESSION['password_new']))
	$_SESSION['password_new']="";
	if(!isset($_SESSION['confirm_password_new']))
	$_SESSION['confirm_password_new']="";
require_once('../../model/connection.php');
$db=new config();
$db->config();	
$password_old=$_POST['password_old'];
$password_new=$_POST['password_new'];
$confirm_password_new=$_POST['confirm_password_new'];
$email=$_SESSION['email'];
$error=0;
		$pass=$db->CheckLogin($email,$password_old);
		
		if(strlen($password_new)>6){
			if($pass==1){
			  $db->ChangePassword($email,$password_new);
			  $pass="Thay đổi mật khẩu thành công";
			}
		}else{
			$pass="Mật khẩu phải lớn hơn 7 ký tự";
		}
		$db->dis_connect();//ngat ket noi mysql	
		$array=array("Error"=>"$pass");
$_SESSION['password_old']=$password_old;
$_SESSION['password_new']=$password_new;
$_SESSION['confirm_password_new']=$confirm_password_new;    
echo json_encode($array);

?>