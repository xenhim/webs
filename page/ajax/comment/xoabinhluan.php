<?php



$res=$_POST['res'];
$res2=$_POST['res2'];
$tong="";  
		require_once('../../model/connection.php');
		$db=new config();
		$db->config(); 
if($res=="c"){
$tong=$res.$res2;
		$db->DeleteComment($res2);
		$db->DeleteReplyByIdComment($res2);	
}else if($res=="r"){
		$tong=$res.$res2;
		$db->DeleteReplyByIdReply($tong);
		$db->DeleteReplyById($res2);
}

 $db->dis_connect();//ngat ket noi mysql		 		    
 $array=array("tong"=>"$tong");  	
echo json_encode($array);

?>