<?php
		$UID=$_POST['UID'];
		$last_name=$_POST['last_name'];
		$first_name=$_POST['first_name'];
		$birthday=$_POST['birthday'];
		$phone=$_POST['phone'];
		$Avatar=$_POST['Avatar'];
		$gender=$_POST['gender'];
		$Email=$_POST['Email'];
		
		$password_old=$_POST['password_old'];
		require_once('../../model/connection.php');
		$db=new config();
		$db->config();
		$error=$db->UploadInfoUser($UID,$last_name,$first_name,$birthday,$phone,$Avatar,$gender,$password_old);
		$db->UploadAvatarComment($Email,$Avatar);
		$db->UploadAvatarRelay($Email,$Avatar);
        $db->dis_connect();//ngat ket noi mysql	

		$array=array("Error"=>"$error");
     	
echo json_encode($array);

?>