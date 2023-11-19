<?php
require_once('model/connection.php'); 
require_once('function/function.php'); 
require_once('library/get_html.php');
$db=new config();
$db->config();
$url = $db->GetUrl1Chap($IdChapter,$IdStory);
if($url!=""){
			$html1 = file_get_html($url);
			$k1=$html1->find('p.padtext');
		    $html2="";
			$html2.="<p>";
			foreach($k1 as $item11){
	         $html2.=(str_replace("&nbsp;", '', $item11->innertext)).'</br></br>';
			}
			$html2.="</p>";
	//echo $url;
		$db->UpdateContentChapters($IdStory,$IdChapter,$html2);
		 	
}	

?>