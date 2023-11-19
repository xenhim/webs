<?php

		require_once('../../model/connection.php');
		$db=new config();
		$db->config();

		$txtsearch=$_POST['txtsearch'];
		$arr = array();
		$arr=$db->GetSearchFind($txtsearch);
		require_once('../../function/function.php');		
		$Id1=array();
		$Name1=array();
		$NameEncode1=array();
		$NameOther1=array();
		$ImgAvatar1=array();
		$NameChap=array();
		foreach($arr as $muc)
		{
			array_push($Id1,$muc['Id']);	
			array_push($Name1,$muc['Name']);
			array_push($NameEncode1,vn_str_filter($muc['Name']));				
			array_push($NameOther1,$muc['NameOther']);	
			array_push($ImgAvatar1,$muc['ImgAvatar']);	
			array_push($NameChap,$muc['NameUpdate_Chap']);	
		}		
		// for($i=0;$i<count($Id1);$i++)
		// {
			
			// $nameChap=$db->GetByNameChap($Id1[$i]);
			// array_push($NameChap,$nameChap);	
						
		// }		
		$Id=json_encode($Id1);
		$Name=json_encode($Name1);
		$NameOther=json_encode($NameOther1);
		$ImgAvatar=json_encode($ImgAvatar1);
		$NameChap1=json_encode($NameChap);
		$NameEncode2=json_encode($NameEncode1);
		$db->dis_connect();//ngat ket noi mysql	
     $array=array("Id"=>"$Id","Name"=>"$Name","NameOther"=>"$NameOther","ImgAvatar"=>"$ImgAvatar","NameChap"=>"$NameChap1","NameEncode"=>"$NameEncode2");
     	
	echo json_encode($array);

?>