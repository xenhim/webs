<?php
    require_once('model/conn.php');
    require_once('class.cURL.php');
    require_once('function/function.php');
    $curl = new cURL();
    $db=new config();
    $db->config();
                $listBloger=$db->GetChapBloger();
                foreach($listBloger as $link) {
                	$html = $curl->getContent($link["url1"]);
    	
    				preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html, $list_chap_img);
    				$dom = new DOMDocument;
    				@$dom->loadHTML($list_chap_img[1][0]);
    				$x = new DOMXPath($dom); 
    				$arr_img=array();
    				foreach($x->query("//img") as $node) 
    				{
    					$cover="";
    					
    					if (strpos($node->getAttribute("src"), "blogger.googleusercontent.com") !== false)
    				    {
    						break;
    					}else if (!preg_match('#http#i', $node->getAttribute("src"))){
						    $cover = 'http:' . $node->getAttribute("src");
    					  	
    					}else{
    					    $cover =  $node->getAttribute("src"); 
    					  	
    					}
    					if($cover !="")
    					array_push($arr_img,$cover);
    					
    				}
    				
    				
    				if($arr_img !=[]){
    				    $image1=implode(",",$arr_img);
    				    $db->UpdateChapBloger($link["Id"],$image1);
    				}
    			
                }
$db->dis_connect();//ngat ket noi mysql	
?>
