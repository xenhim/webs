<?php

function GetMenuSub($a1,$a2,$arr2,$c,$d,$linkOption){ 
	

	 $arrName=[];
	foreach($arr2 as $muc4){
		array_push($arrName,$muc4['Name']);
	}
	 $topHtml1=$a1;
	 // $topHtml2='';
	 // $botHtml1='';
	 $botHtml2=$a2;

	 $k=0;
	 $b=0;
												
	for($i=1;$i<=ceil(count($arr2)/$c);$i++)
	 {
				
			echo $topHtml1;			
				
		$j=0;
		$t=0;
		foreach($arr2 as $muc3){
				$j++;
				if($k==0){
					if($b==0){
						if($j<$c+1){
						if($d=="sort=")	
							echo '<li><a href="'.$linkOption.$muc3['NameEncode'].'.html">'.$muc3['Name'].'</a></li>';
						else{
							
							echo '<li><a href="'.$linkOption."the-loai/".vn_str_filter($muc3['Name']).'-'.$muc3['Id'].'.html">'.$muc3['Name'].'</a></li>';
						}
						$arrName=array_diff($arrName, array($muc3['Name']));
						}else{
							$b=1;
							
						}
					}else{
						$k=1;
						break;
						
					}
				}
				
				if(array_search($muc3['Name'],$arrName)>0 && $k==1){
					$t++;
					if($t<$c+1){
						if($d=="sort=")	
						    echo '<li><a href="'.$linkOption.$muc3['NameEncode'].'.html">'.$muc3['Name'].'</a></li>';
						else
							echo '<li><a href="'.$linkOption."the-loai/".vn_str_filter($muc3['Name']).'-'.$muc3['Id'].'.html">'.$muc3['Name'].'</a></li>';
						$arrName=array_diff($arrName, array($muc3['Name']));
					}else{
						$t=0;
						break;
					}

				}
			
		}			
			echo $botHtml2;
		
	 }
}
?>