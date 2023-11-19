<?php

$IdDiv=$_POST['IdDiv'];
$IdComment=$_POST['IdComment'];
$IdStory=$_POST['IdStory'];

		$arrj = array();
		$arrje1 = array();
		$arrje2 = array();
		require_once('../../model/connection.php');
		require_once('../../function/function.php');
		$db=new config();
		$db->config();
		$linkOption=siteURL();
		$linkOption1=$linkOption."page/";
		date_default_timezone_set("Asia/Ho_Chi_Minh");	
		$arrj=$db->GetListEmoji(0);		
		foreach($arrj as $c3)
		{
			array_push($arrje1,$c3['Code']);
			array_push($arrje2,$linkOption1.$c3['Path']);	
		}
		 if($IdComment==0){
			 
			$Id2 =$db->GetMaxComment();	
			$IdComment=$Id2+1;
		}else{
		    $IdComment=$IdComment+1;
		}
				
		$arr = array();
		$arr1 = array();
		
		$arr=$db->GetLimitComment($IdComment,$IdStory);
		
		if($arr!=""){

		  $arr1=$db->GetReplysASC();
		}
	function chuyen_timer($a,$b)
	{

	   $diff = abs(strtotime($b) - strtotime($a));
	   $years = floor($diff / (365*60*60*24));
	   $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	   $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
	   $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
	   $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60) / 60);
	   $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
	   $array=array("years"=>"$years","months"=>"$months","days"=>"$days","hours"=>"$hours","minutes"=>"$minutes","seconds"=>"$seconds");
		return json_encode($array);					
	 }
///////////////////////////////////////////////////    
	  
		$c1=array();
		$r1=array();
		
		
		foreach($arr as $c2)
		{
				
			$DateComment="<time itemprop='datePublished'>1 Phút Trước</time>";	
			 $o = json_decode(chuyen_timer($c2['DateComment'],date('Y-m-d H:i:s')));
			 if($o->years!=0)
			 echo "<time itemprop='datePublished'>".$o->years." Năm Trước</time>";
			 else if($o->months!=0) $DateComment= "<time itemprop='datePublished'>".$o->months." Tháng Trước</time>";
			 else if($o->days!=0) $DateComment= "<time itemprop='datePublished'>".$o->days." Ngày Trước</time>";
			 else if($o->hours!=0) $DateComment= "<time itemprop='datePublished'>".$o->hours." Giờ Trước</time>";
			 else if($o->minutes!=0) $DateComment= "<time itemprop='datePublished'>".$o->minutes." Phút Trước</time>";
			 else if($o->seconds!=0) $DateComment= "<time itemprop='datePublished'>1 Phút Trước</time>";
			 else{
				 $DateComment= "<time itemprop='datePublished'>1 Phút Trước</time>";
			 }
			
			array_push($c1,$DateComment);	
		}
		foreach($arr1 as $r2)
		{
			$DateReply="<time itemprop='datePublished'>1 Phút Trước</time>";	
			 $o1 = json_decode(chuyen_timer($r2['DateReply'],date('Y-m-d h:i:s')));
			 if($o1->years!=0)
			 echo "<time itemprop='datePublished'>".$o1->years." Năm Trước</time>";
			 else if($o1->months!=0) $DateReply= "<time itemprop='datePublished'>".$o1->months." Tháng Trước</time>";
			 else if($o1->days!=0) $DateReply= "<time itemprop='datePublished'>".$o1->days." Ngày Trước</time>";
			 else if($o1->hours!=0) $DateReply= "<time itemprop='datePublished'>".$o1->hours." Giờ Trước</time>";
			 else if($o1->minutes!=0) $DateReply= "<time itemprop='datePublished'>".$o1->minutes." Phút Trước</time>";
			 else if($o1->seconds!=0) $DateReply= "<time itemprop='datePublished'>1 Phút Trước</time>";
			 else{
				 $DateReply= "<time itemprop='datePublished'>1 Phút Trước</time>";
			 }
				array_push($r1,$DateReply);	
		}

	
	
	 
	
/////////////////////////////////////////////////////////		
$Comment_s=json_encode($arr);	
$reply_s=json_encode($arr1);	
//$cc1=json_encode($c1);
//$rr1=json_encode($r1);

$cc1=json_encode($c1);//array comnent
$rr1=json_encode($r1);//array reply
$ej_code=json_encode($arrje1);
$ej_path=json_encode($arrje2);
$db->dis_connect();//ngat ket noi mysql	
$array=array("Comment_s"=>"$Comment_s","reply_s"=>"$reply_s","cc1"=>"$cc1","rr1"=>"$rr1","ej_code"=>"$ej_code","ej_path"=>"$ej_path");
echo json_encode($array);

?>