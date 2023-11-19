<?php
    require_once('model/conn.php');
    require_once('class.cURL.php');
    require_once('function/function.php');

function uploadToCloudflare($imageUrl, $url, $chap2, $ii) {
	//global $ii;
    $prefix = "https://nhattruyenplus.com/truyen-tranh/";
    $slug = str_replace($prefix, "", $url);
	$chap = str_replace("Chương ", "chapter-", $chap2);
    //echo $slug."-".$chap."-".$ii."\n";
	

$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
$datapost = $imageUrl;
$sungs = $slug."-".$chap."-".uniqid(rand())."-".$ii;
$datasave = base64_decode("Y3VybCAtLXJlcXVlc3QgUE9TVCBcCiAtLXVybCBodHRwczovL2FwaS5jbG91ZGZsYXJlLmNvbS9jbGllbnQvdjQvYWNjb3VudHMvNzkyYzJmZDdlOTc3YWM1MTkyZWE0NDRlZDlhOTY4MTYvaW1hZ2VzL3YxIFwKIC0taGVhZGVyICdBdXRob3JpemF0aW9uOiBCZWFyZXIg");
$datasave .= $ids.base64_decode("JyBcCiAtLWZvcm0gJ3VybD1odHRwczovL3dvcmtlci1yYXBpZC1idXR0ZXJmbHktM2YzYS54ZW1pbmluZy53b3JrZXJzLmRldi8/dXJsPQ==");
$datasave .= $datapost.base64_decode("JyBcCiAtLWZvcm0gJ21ldGFkYXRhPXsia2V5IjoidmFsdWUifScgXAogLS1mb3JtICdpZD0=");
$datasave .= $sungs.base64_decode("JyBcCiAtLWZvcm0gJ3JlcXVpcmVTaWduZWRVUkxzPWZhbHNlJw==");
//echo $datasave."\n";
$result = shell_exec($datasave);
//echo $result."\n";

    //$ii++;
    return $result;
}

    $curl = new cURL();
    $db=new config();
    $db->config();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $site=$db->GetDomain_site(3);
    $proxu="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";

    $url="http://".$site."/the-loai";
    $string = $curl->getContent($proxu.$url);
	//echo $string."\n";
    //preg_match('#<div class="items">(.*)id="ctl00_mainContent_ctl00_divPager"#ismU', $string, $content);

    preg_match('#<div class="items">(.*)id="ctl00_mainContent_ctl01_divPager"#ismU', $string, $content);
    preg_match_all('#<a class="jtip".*href="(.*)">(.*)</a>#imsU', $content[1], $list_name);
    $list_manga = array_combine($list_name[1], $list_name[2]);
	print_r($list_manga);

    foreach ($list_manga as $url => $name) {
      $nameStory=$name;
	//print_r($nameStory."\n");

   
    if($db->check_story_exist($nameStory,1,0)>0){
         
    $html= $curl->getContent($proxu.$url);
    preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $html, $name);
	//var_dump($html."\n");

   
    if($html !=""){
	var_dump($html."\n");	
        
    $parse = parse_url($url);
    preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
    $Name_Chapter=$db->GetNameStoryOFChap($nameStory,1,0);
    $posity= check_chap($list_chap[2],$Name_Chapter[0]);
	print_r($posity);

	$e=0;
    for($i=$posity-1;$i>-1;$i--)
    {
            preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
        	 $chap2=str_replace('Chapter','Chương',$chapter[0]);
        	 print_r($chap2."\n");

       if($db->check_chap_exist($chap2,$Name_Chapter[1])<1){
        if($e<6){
        	$html1 = $curl->getContent($proxu.$list_chap[1][$i]);
			if($html1 !=""){
				preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html1, $list_chap_img);
				$dom = new DOMDocument();
				@$dom->loadHTML($list_chap_img[1][0]);
				$x = new DOMXPath($dom); 
				$arr_img=array();
				$ii = 1;
				foreach($x->query("//img") as $node) 
				{
					$cover="";
					if (!preg_match('#http#i', $node->getAttribute("src"))) {
					//$ii++;	
						$cover = 'http:' . $node->getAttribute("src");
					}else{
					  	$cover =  check_blogger($node->getAttribute("src"));  
					}
					if($cover !="")
					$ii++;	
					array_push($arr_img,$cover);
				}
				 $dateChap=date('Y-m-d H:i:s');
				 if($arr_img !=[] && $db->check_chap_exist($chap2,$Name_Chapter[1])<1){
				     $image1=implode(",",$arr_img);
				     //print_r($image1);
					 
$uploadedImageUrls = []; // This array will store all successfully uploaded URLs

// Iterate over each image and upload it
foreach ($arr_img as $img) {
    //$imgs = 'https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=';
    print_r($img."\n");
    $imageUrl = $img;
    $responseJson = uploadToCloudflare($imageUrl, $url, $chap2, $ii);
    //echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responseJson, true);

    // Check if the upload was successful and the variants key exists
    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
        $uploadedImageUrl = $response['result']['variants'][0];
        $uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
    }
}

// Output all uploaded URLs as a comma-separated string
$ImageUrls = implode(",", $uploadedImageUrls);
					 
    				 $db->AddChap($chap2,"","","Ẩn",$dateChap,$Name_Chapter[1],$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
    				 $db->UpdateChapToStory($Name_Chapter[1],$chap2,$dateChap);	 
    				 $e++;
    				 
				 }
			   }
		  }else{
			  break;
		  }	
        }
        
    }
     
  }

 }
 
}
$db->dis_connect();//ngat ket noi mysql	
?>
