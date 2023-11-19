<?php
function getChap($url){
	require_once('library/get_html.php');
	//$url = 'http://truyentranhtuan.com/chung-cuc-dau-la-chuong-274/';
	$homepage = file_get_contents($url);

	$data=$homepage;
	$s="";
	$s2 = strpos($data, '"];');
	$array=array();
	$array2=array();
	$array3=array();
	if(strpos($data, 'var slides_page_url_path = [];')=="" && strpos($data, 'var slides_page_path = [];')!=""){		
		$s = strpos($data, 'var slides_page_url_path');	
		$array = explode(',', substr($data, $s+28,$s2-$s-27));
	}else if(strpos($data, 'var slides_page_path = [];')=="" && strpos($data, 'var slides_page_url_path = [];')!=""){
		$s = strpos($data, 'var slides_page_path');	
		
		
		$array = explode(',', substr($data, $s+24,$s2-$s-23));
	}else if(strpos($data, 'var slides_page_url_path = ["https://1.bp.blogspot.com')!=""){
		$s = strpos($data, 'var slides_page_path');			
		$array = explode(',', substr($data, $s+24,$s2-$s-23));
	}else if(strpos($data, 'var slides_page_path = ["https://1.bp.blogspot.com')!=""){
		$s = strpos($data, 'var slides_page_url_path');
	
		$array = explode(',', substr($data, $s+28,$s2-$s-27));
	}
	foreach($array as $tam)
	{ 
		$gach= strrchr($tam, "/");
		$cham= strpos($gach, ".");
		//$Idimg=(float)filter_var(substr($gach,1,$cham-1), FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION );
		$Idimg=tofloat(substr($gach,1,$cham-1));
		array_push($array2,$Idimg);
		
		
	}
	sort($array2);
	foreach($array2 as $tam2)
	{ 
		//echo $tam2;
		array_push($array3,str_replace('?imgmax=0','',checkArr($array,$tam2)));
	}


	return $array3;
}

function checkArr($a,$b){
	$d="";
	for($i=0;$i<$a;$i++){
		$gach= strrchr($a[$i], "/");
	    $cham= strpos($gach, ".");
		$c=tofloat(substr($gach,1,$cham-1));
		//$c=(float)filter_var(substr($gach,1,$cham-1), FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION );
		if($c==$b){
			$d=$a[$i];
			break;
		}
	}
	return $d;
}
?>