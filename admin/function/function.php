<?php
//posting date descending
//posting date ascending
//date update descending
//date update ascending

//view descending
//view ascending
function str_replace_first($search, $replace, $subject)
{
    $search = '/'.preg_quote($search, '/').'/';
    return preg_replace($search, $replace, $subject, 1);
}
function check_chap($arr,$str){
       
        $t=0;
        for($i=0;$i<count($arr);$i++)
        {
            preg_match('#(chapter|chap|chương) ([\d.]+)#is', $arr[$i], $chapter);
            
            $chap2=str_replace('Chapter','Chương',$chapter[0]);
            $chap3=str_replace('Chapter','Chương',$str);
            if($chap2==$chap3){
              // echo  $chap2;
             $t=$i;
             break;
            }
            
            
        }
        return $t;
    }
function check_blogger($str){
	$str1="";
  if (strpos($str, "https://images2-focus-opensocial.googleusercontent.com") !== false){
	$str1=substr($str,strpos($str, "https://blogger.googleusercontent.com"));
  }else{
  	$str1=$str;  
  }
  return $str1;
}
function url(){
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $_SERVER['REQUEST_URI']
  );
}
function siteURL() {
		  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
			$_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		  $domainName = $_SERVER['HTTP_HOST'];
		    $whitelist = array(
				'127.0.0.1',
				'::1'
			);

			if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
				return $protocol.$domainName."/";
				//hossitng
			}else{
				return $protocol.$domainName."/truyenqq/";
				//localhost
			
			}
}
function getrealip() {
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            if (strpos($ip, ",")) {
                $exp_ip = explode(",", $ip);
                $ip = $exp_ip[0];
            }
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
            if (strpos($ip, ",")) {
                $exp_ip = explode(",", $ip);
                $ip = $exp_ip[0];
            }
        } else if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else {
            $ip = getenv('REMOTE_ADDR');
        }
    }
    return $ip;
}

function storiesListHistory($arr,$linkOption){
	  //echo count($arr);
					  $db=new config();
					  $db->config();
						
	if($arr !=[]){					
   $nameChap=$arr[13];
   $dateChap=$db->convert_timer1($arr[14]);  
echo '<li>';
	echo '<div class="story-item">';
	$the_loai="truyen-tranh/";
	$color="";
	if($arr[15]==1){
		$the_loai="tieu-thuyet/";
		$color='style="background-color:red;"';
	}
		 echo '<a href="'.$linkOption.$the_loai.vn_str_filter($arr[1])."-".$arr[0].'" title="'.$arr[1].'">';						
		  echo '<img class="story-cover lazy_cover" src="'.$arr[4].'" alt="'.$arr[1].'" style="width:190px;height:247px;"/>';
		 echo '</a>';
		echo '<div class="top-notice">';
			echo '<span class="time-ago" '.$color.'>'.$dateChap.'</span>';
			if($arr[5]=="Hot")
			 echo '<span class="type-label hot">Hot</span>';
			else if($arr[5]=="New")
			 echo '<span class="type-label New">New</span>';
			
		echo '</div>';
		echo '<h3 class="title-book">';
			echo '<a href="'.$linkOption.'truyen-tranh/'.vn_str_filter($arr[1])."-".$arr[0].'" title="'.$arr[1].'">'.ConvertStr($arr[1],0).'</a>';
		echo '</h3>';
		echo '<div class="episode-book">';
			echo '<a href="'.$linkOption.'truyen-tranh/'.vn_str_filter($arr[1])."-".$arr[0]."-chap-".tofloat($nameChap).'.html">'.$nameChap.'</a>';
		echo '</div>';
		echo '<div class="more-info">';
			echo '<div class="title-more">'.$arr[1].'</div>';
			echo '<p class="info">Tình trạng: '.$arr[2].'</p>';
			echo '<p class="info">Lượt xem: '.$arr[12].'</p>';
			echo '<p class="info">Lượt theo dõi: '.$arr[10].'</p>';
			echo '<div class="list-tags">';
			$genreArr=ConvertStrToArr($arr[8]);
			for($i=0;$i<count($genreArr);$i++){
				$genre12=$db->GetIdGenre($genreArr[$i]);
				echo '<a class="blue" href="'.$linkOption.'the-loai/'.vn_str_filter($genreArr[$i]).'-'.$genre12.'.html">'.$genreArr[$i].'</a>';
			}
				
			echo '</div>';
			echo '<div class="excerpt">'.ConvertStr($arr[3],1).'</div>';
		echo '</div>';
	echo '</div>';
echo '</li>';
//echo '</ul>';						 
}else{
		
		//echo '<div class="warning-list box">Xin lỗi, không tìm thấy kết quả nào!!</div>';
		
	}							
			
}
function storiesListFollow($arr,$linkOption){
	  
   $db=new config();
   $db->config();
   
	if($arr !=[]){					
   $nameChap=$arr[13];
   $dateChap=$db->convert_timer1($arr[14]);
   
//echo '<ul class="list-stories grid-6">';   
echo '<li>';
	echo '<div class="story-item">';
		echo '<span class="remove-subscribe" title="Bỏ Theo Dõi" data-id="'.$arr[0].'">';
		  echo '<i class="far fa-times-circle"></i>';
		echo '</span>';
		$the_loai="truyen-tranh/";
		$color="";
    	if($arr[15]==1){
	    	$the_loai="tieu-thuyet/";
	    	 $color='style="background-color:red;"';
    	}
		 echo '<a href="'.$linkOption.$the_loai.vn_str_filter($arr[1])."-".$arr[0].'" title="'.$arr[1].'">';							
		  echo '<img class="story-cover lazy_cover" src="'.$arr[4].'" alt="'.$arr[1].'" style="width:190px;height:247px;"/>';
		 echo '</a>';
		echo '<div class="top-notice">';
			echo '<span class="time-ago" '.$color.'>'.$dateChap.'</span>';
			if($arr[5]=="Hot")
			 echo '<span class="type-label hot">Hot</span>';
			else if($arr[5]=="New")
			 echo '<span class="type-label New">New</span>';
			
		echo '</div>';
		echo '<h3 class="title-book">';
			echo '<a href="'.$linkOption.$the_loai.vn_str_filter($arr[1])."-".$arr[0].'" title="'.$arr[1].'">'.ConvertStr($arr[1],0).'</a>';
		echo '</h3>';
		echo '<div class="episode-book">';
			echo '<a href="'.$linkOption.$the_loai.vn_str_filter($arr[1])."-".$arr[0]."-chap-".tofloat($nameChap).'.html">'.$nameChap.'</a>';
		echo '</div>';
		echo '<div class="more-info">';
			echo '<div class="title-more">'.$arr[1].'</div>';
			echo '<p class="info">Tình trạng: '.$arr[2].'</p>';
			echo '<p class="info">Lượt xem: '.$arr[12].'</p>';
			echo '<p class="info">Lượt theo dõi: '.$arr[10].'</p>';
			echo '<div class="list-tags">';
			$genreArr=ConvertStrToArr($arr[8]);
			for($i=0;$i<count($genreArr);$i++){
				$genre12=$db->GetIdGenre($genreArr[$i]);
				echo '<a class="blue" href="'.$linkOption.'the-loai/'.vn_str_filter($genreArr[$i]).'-'.$genre12.'.html">'.$genreArr[$i].'</a>';
			}
				
			echo '</div>';
			echo '<div class="excerpt">'.ConvertStr($arr[3],1).'</div>';
		echo '</div>';
	echo '</div>';
echo '</li>';
//echo '</ul>';						 
	}else{
		
		//echo '<div class="warning-list box">Xin lỗi, không tìm thấy kết quả nào!!</div>';
		
	}						
			
}
function base64url_decode( $data ){
  return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
}
// function chuyen_timer($a,$b)
// {

   // $diff = abs(strtotime($b) - strtotime($a));
   // $years = floor($diff / (365*60*60*24));
   // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
   // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
   // $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
   // $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60) / 60);
   // $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
   // $array=array("years"=>"$years","months"=>"$months","days"=>"$days","hours"=>"$hours","minutes"=>"$minutes","seconds"=>"$seconds");
					// return json_encode($array);					
// }
// function convert_timer($str){
	// date_default_timezone_set("Asia/Ho_Chi_Minh");	
	// $DateComment="1 Phút Trước";
					
				 // $o = json_decode(chuyen_timer($str,date('Y-m-d H:i:s')));
				 // if($o->years!=0)
				  // $DateComment=$o->years." Năm Trước";
				 // else if($o->months!=0) $DateComment= $o->months." Tháng Trước";
				 // else if($o->days!=0) $DateComment= $o->days." Ngày Trước";
				 // else if($o->hours!=0) $DateComment= $o->hours." Giờ Trước";
				 // else if($o->minutes!=0) $DateComment= $o->minutes." Phút Trước";
				 // else if($o->seconds!=0) $DateComment= "1 Phút Trước";
				 // return $DateComment;
// }
function storiesList($arr,$linkOption){	  
	 $db=new config();
     $db->config();	
	if(count($arr)>0){
	echo '<ul class="list-stories grid-6">';
	 foreach($arr as $arr3) {
		   $nameChap=$arr3["NameUpdate_Chap"];
		   //echo $arr3["DateUpdate_Chap"];
		   //if()
		   $dateChap=$db->convert_timer1($arr3["DateUpdate_Chap"]);
		   $countView=$arr3["Sum_Views"];
		   $countSubscribe=$arr3["Sum_Subscribe"];
		   //$db->dis_connect();//ngat ket noi mysql
		    $color="";
			$the_loai="truyen-tranh/";
			if($arr3["Male"]==1){
			 $the_loai="tieu-thuyet/";
			 $color='style="background-color:red;"';
			}
	   echo '<li>';
			echo '<div class="story-item">';
				 echo '<a href="'.$linkOption.$the_loai.vn_str_filter($arr3["Name"])."-".$arr3["Id"].'" title="'.$arr3["Name"].'">';						
				echo '<img class="story-cover lazy_cover" src="'.$arr3["ImgAvatar"].'" alt="'.$arr3["Name"].'" style="width:190px;height:247px;"/>';
				echo '</a>';
				echo '<div class="top-notice">';
					echo '<span class="time-ago" '.$color.'>'.$dateChap.'</span>';
					if($arr3["Badge"]=="Hot")
					 echo '<span class="type-label hot">Hot</span>';
					else if($arr3["Badge"]=="New")
					 echo '<span class="type-label New">New</span>';
					
				echo '</div>';
				echo '<h3 class="title-book">';
					echo '<a href="'.$linkOption.$the_loai.vn_str_filter($arr3["Name"])."-".$arr3["Id"].'" title="'.$arr3["Name"].'">'.ConvertStr($arr3["Name"],0).'</a>';
				echo '</h3>';
				echo '<div class="episode-book">';
					echo '<a href="'.$linkOption.$the_loai.vn_str_filter($arr3["Name"])."-".$arr3["Id"]."-chap-".tofloat($nameChap).'.html">'.$nameChap.'</a>';
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
			
}

function ConvertStrToArr($str){
	
	$a=[];
	$a=explode(",",$str);
	return $a;
}
function ConvertStr($str,$index){
	$a=$str;
	if($index==0){
		if (mb_strlen($str, 'UTF-8') >36){
			$a=mb_substr($str,0, 36)."...";
		}
	}else{
		if (mb_strlen($str, 'UTF-8') >200){
			$a=mb_substr($str,0, 200)."...";
		}
	}
	return $a;
}
function convert_string_json($name){
		$string = str_replace('\n', '', $name);
		$string = rtrim($string, ',');
		$string = "[" . trim($string) . "]";
		$json = json_decode($string, true);
		return $json;
}
function tofloat($num) {
	$num1=substr_count($num, "–");
    if($num1==2)
    $num=substr($num,0,strripos($num,'–')-1);
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : 
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
   
    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    } 

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}
function vn_str_filter ($str){
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ", "-", $str);
        $str = str_replace("_", "-", $str);
        $str = str_replace(".", "-", $str);
        $str = str_replace(":", "-", $str);
        $str = str_replace("/", "-", $str);
        $str = preg_replace('/[^A-Za-z0-9\-._]/', '', $str); // Removes special chars.
        $str = preg_replace('/-+/', '-', $str);

        $str = strtolower($str);
        return $str;
}
function findTop($type)
{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date=date("Y-m-d");
		$rYear=date("Y");
		$rMonth=date("m");
		$topWeek=array();
		$topDate=array();
		$topDay="";
		switch ($type) {
		  case "week":
			$day1 = DateTime::createFromFormat('Y-m-d', $date);
			$day1->setISODate((int)$day1->format('o'), (int)$day1->format('W'), 1);	
			$date2=date('Y-m-d', strtotime('-1 day', strtotime($day1->format('Y-m-d'))));
			$day2 = DateTime::createFromFormat('Y-m-d',$date2 );
			$day2->setISODate((int)$day2->format('o'), (int)$day2->format('W'), 1);
			$date3=$day2->format('Y-m-d');
			array_push($topWeek,$date3);
			array_push($topWeek,$date2);
			break;
		  case "day":
			$topDay=date('Y-m-d', strtotime('-1 day', strtotime($date)));
			break;
		  case "month":
			$t1=$rYear.'-'.$rMonth.'-01';
			$t2=$date2=date('Y-m-d', strtotime('-1 day', strtotime($t1)));
			$r2Year=date("Y", strtotime($t2));
			$r2Month=date("m", strtotime($t2));
			$t3=$r2Year.'-'.$r2Month.'-01';
			array_push($topDate,$t3);
			array_push($topDate,$t2);
			break;
		  
		}
		
		if($type=="week")
		return $topWeek;
		else if($type=="day")
		return $topDay;
		else return $topDate;
		
}

function base64url_encode($data) {
	$data1=base64_encode($data);
	$temp=rtrim(strtr(base64_encode($data1), '+/', '-_'), '=');
    return $temp;
}
function getParseUrl($url,$site,$domain){	
    $temp_url = html_entity_decode($url);	
	$t1=base64url_encode($temp_url);
	$link_temp="&data=".$t1;
	$link_out=$domain."wp-content/uploads/image.jpg?size=".base64url_encode($site).$link_temp;
	 return $link_out;
}
function swap($IdStory,$arr){
    $c=array();	
    if($arr !=[]){
    	$temp_7 = $arr[0];				
    	$arr[0] = $arr[array_search($IdStory,$arr)];
    	$arr[array_search($IdStory,$arr)] = $temp_7;
    	if(array_search($IdStory,$c)==[])
    	array_push($c,$IdStory);
    	for($i=0;$i<count($arr);$i++){
    		if($IdStory!=$arr[$i])
    		array_push($c,$arr[$i]);	
    	}
    }
	return $c;							
	
}

?>