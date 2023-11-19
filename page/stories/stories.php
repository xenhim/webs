<?php

if(count($arr)>0){
	echo '<ul class="list-stories grid-6">';
	 foreach($arr as $arr3) {
		   $nameChap=$db->GetByNameChap($arr3["Id"]);
		   $dateChap=$db->GetByDateChap($arr3["Id"]);
		   $countView=$db->GetCountView($arr3["Id"]);
		   $countSubscribe=$db->GetSumSubscribeStory($arr3["Id"]);
		   //$db->dis_connect();//ngat ket noi mysql	
	   echo '<li>';
			echo '<div class="story-item">';
				 echo '<a href="'.$linkOption.'truyen-tranh/'.vn_str_filter($arr3["Name"])."-".$arr3["Id"].'" title="'.$arr3["Name"].'">';
				  echo '<img class="story-cover lazy_cover" src="'.$arr3["ImgAvatar"].'" alt="'.$arr3["Name"].'" style="height: 190px; width: 247px">';
				 echo '</a>';
				echo '<div class="top-notice">';
					echo '<span class="time-ago">'.$dateChap.'</span>';
					if($arr3["Badge"]=="Hot")
					 echo '<span class="type-label hot">Hot</span>';
					else if($arr3["Badge"]=="New")
					 echo '<span class="type-label New">New</span>';
					else if($arr3["Badge"]=="Videos")
					 echo '<span class="type-label New">Videos</span>';
					
				echo '</div>';
				echo '<h3 class="title-book">';
					echo '<a href="'.$linkOption.'truyen-tranh/'.vn_str_filter($arr3["Name"])."-".$arr3["Id"].'" title="'.$arr3["Name"].'">'.ConvertStr($arr3["Name"],0).'</a>';
				echo '</h3>';
				echo '<div class="episode-book">';
					echo '<a href="'.$linkOption.'truyen-tranh/'.vn_str_filter($arr3["Name"])."-".$arr3["Id"]."-chap-".tofloat($nameChap).'.html">'.$nameChap.'</a>';
				echo '</div>';
				echo '<div class="more-info">';
					echo '<div class="title-more">'.$arr3["Name"].'</div>';
					echo '<p class="info">Tình trạng: '.$arr3["story_Status"].'</p>';
					echo '<p class="info">Lượt xem: '.$countView.'</p>';
					echo '<p class="info">Lượt theo dõi: '.$countSubscribe.'</p>';
					echo '<div class="list-tags">';
					$genreArr=ConvertStrToArr($arr3["Genre"]);
					for($i=0;$i<count($genreArr);$i++){
						$genre12=$db->GetIdGenre($genreArr[$i]);
						echo '<a class="blue" href="'.$linkOption.'the-loai/'.vn_str_filter($genreArr[$i]).'-'.$genre12.'.html">'.$genreArr[$i].'</a>';
					}
						
					echo '</div>';
					echo '<div class="excerpt">'.ConvertStr($arr3["Content"],1).'</div>';
				echo '</div>';
			echo '</div>';
			
		echo '</li>';
	 }
	echo '</ul>';
	}else{
		
		echo '<div class="warning-list box">Xin lỗi, không tìm thấy kết quả nào!!</div>';
	}
?>