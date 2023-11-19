<?php
require_once('model/conn.php');
$domain_old=$_POST['domain_old'];
$domain_new=$_POST['domain_new'];
$db=new config();
$db->config();
    $error=$db->UpdateDomain_chap($domain_old,$domain_new);
	
	$list=$db->GetListStoryDomain($domain_old);
	foreach($list as $item){
		
		$url=str_replace($domain_old,$domain_new,$item["Url2"]);
		$error=$db->UpdateDomain_story($item["Id"],$url);
		
	}
	$db->UpdateDomain_site($domain_old,$domain_new);
	$db->dis_connect();//ngat ket noi mysql	
	
	
			$array=array("Error"=>"$error");
     	
echo json_encode($array);	
?>