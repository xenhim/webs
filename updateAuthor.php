<?php 
    $con=mysqli_connect("localhost","wp_puwe8","X4v86bgttv9u","wp_tpj8b");
	function check_story_exist($name,$con)
	{
		$sql = "select * from qq_authors where Name='$name'";
		$result =mysqli_query($con, $sql);	
		$num = mysqli_num_rows($result);	
		return $num;
	}
	function vn_str_filter ($str){
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        $str= str_replace(array( '\'', '"',',' , ';', '<', '>','-' ,'/',':','_','.',',','\\','{','}','|','~','`','!','@','#','$','%','^','&','*','(',')','+','=','?','–'), '', $str);
        $str=preg_replace('/[\s]+/', ' ', trim($str));
        $str=str_replace(' ','-',strtolower($str));
        return  $str;
        }
	function AddStory($Name,$NameEn,$con)
	{
		
		
			$sql="INSERT INTO qq_authors (Name,NameEncode) VALUES ('$Name','$NameEncode')";
			
			$error="loi";
			mysqli_query($con, $sql);	
		  if(mysqli_affected_rows($con)==1)
			$error="Thêm thành công";
		return $error;
	}
	function GetAuthor($con)
	{
		$arr = array();
		
			$sql = "SELECT * from qq_story";
		    $r = mysqli_query($con,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}		
		return $arr;
	}
	
	$arr=GetAuthor($con);
	foreach($arr as $item) {
	   
	   $author = explode(',', $item["Author"]);
	   foreach($author as $item1) {
	       if(check_story_exist($item1,$con)<1)
	       AddStory($item1,vn_str_filter($item1),$con);
	   }
	}

?>