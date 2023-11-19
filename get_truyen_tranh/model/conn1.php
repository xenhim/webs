<?php
class config
{
	private $_conn;
	function config()
    {
		
		if (!$this->_conn)
		{			
		$dbconfig ="";			
		/*if (file_exists(".env")) {
			$dbconfig = parse_ini_file(".env");
		}else if (file_exists("../.env")){
			$dbconfig = parse_ini_file("../.env");
		}else if (file_exists("../../.env")){
			$dbconfig = parse_ini_file("../../.env");
		}else if (file_exists("../../../.env")){
			$dbconfig = parse_ini_file("../../../.env");
		}else if (file_exists("../../../../.env")){
			$dbconfig = parse_ini_file("../../../../.env");
		}else if (file_exists("../../../../../.env")){
			$dbconfig = parse_ini_file("../../../../../.env");
		}				
		$servername = $dbconfig["DB_HOST"];
		$username = $dbconfig["DB_USERNAME"];
		$password = $dbconfig["DB_PASSWORD"];
		$dbname = $dbconfig["DB_DATABASE"];*/	
		
		$servername = "127.0.0.1";
		$username = "root";
		$password = "2ec9affbdc8ca7d2";
		$dbname = "truyenfull";
	    $this->_conn =mysqli_connect($servername, $username , $password, $dbname) or die ('Lỗi kết nối'); 		  		  
	    //mysqli_query($this->_conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");			
		  mysqli_set_charset($this->_conn,"utf8");	
		  mysqli_set_charset($this->_conn,"SQL_BIG_SELECTS = 1");	
		}
	}

	function dis_connect()
	{
		if ($this->_conn)
		{
            mysqli_close($this->_conn);
        }
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
	function GetByDateChap($Id)
	{
		
		 date_default_timezone_set("Asia/Ho_Chi_Minh");	

		$sql = "SELECT * FROM qq_chapter  WHERE IdStory='$Id'  ORDER BY CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) DESC LIMIT 1";
		$r =mysqli_query($this->_conn, $sql);	
		$b="";
		$DateComment="??";
        $arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($arr!=[]){	
			foreach($arr as $muc){
				$b=$muc["DateUpload"];
			}
			
			
		}
        return $b;	
	}
	
	function GetByNameChap($Id)
	{
		
		$sql = "SELECT * FROM qq_chapter  WHERE IdStory='$Id'  ORDER BY CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) DESC LIMIT 1";
		$r =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Name"];
		}
        return $b;	
	}
	function check_story_exist($name)
	{
		//SUBSTRING(Name,8)
		//$n=mysqli_real_escape_string($this->_conn, $name);
		$sql = "select * from qq_story where Name='$name'";
		//echo $sql;
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);	
		return $num;
	}
	function UpdateChapStory($Id,$NameUpdate_Chap,$DateUpdate_Chap)
	{
			//$Name1=mysqli_real_escape_string($this->_conn,$Name);
		  //  $error="Sửa thất bại";
			$sql="UPDATE qq_story SET NameUpdate_Chap='$NameUpdate_Chap',DateUpdate_Chap='$DateUpdate_Chap' WHERE Id='$Id'";	
			mysqli_query($this->_conn, $sql);	          
			// if(mysqli_affected_rows($this->_conn)==1)
			// $error="Sửa thành công";
		// return  $error;
	}
	function GetNameStory($id)
	{
		$sql = "SELECT * from qq_story WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Name'];	
        return $b;	
	}
	function GetNameStoryOFChap($id)
	{
		$sql = "SELECT * from qq_story WHERE Name='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";$c="";
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
	   	    $b= $a['NameUpdate_Chap'];	
            $c= $a['Id'];
			break;
		}
       
        $a2=array();
        array_push($a2,$b);	
		array_push($a2,$c);
		return $a2;
	}
	function UpdateChapters($IdStory,$Name,$Content,$date,$site)
	{		
		$query = "UPDATE qq_chapter SET `Path`='$Content',DateUpload='$date',Content_04='$site' WHERE IdStory='$IdStory' and Name='$Name'";
		$result = mysqli_query($this->_conn, $query);
	}
	function UpdateChapters_2($chap,$date,$idStory,$link)
	{		
		$query = "UPDATE qq_chapter SET Name='$chap',url1='$link' WHERE IdStory='$idStory' and Name='$chap'";
		$result = mysqli_query($this->_conn, $query);
	}
	function check_chap_exist($name,$idStory)
	{
		//SUBSTRING(Name,8)
		$n=mysqli_real_escape_string($this->_conn, $name);
		$sql = "select * from qq_chapter where Name='$n' and IdStory='$idStory'";
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);	
		return $num;
	}
	function GetChapterLink($idStory)
	{
		$sql = "select * from qq_chapter where IdStory='$idStory' ORDER BY CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) DESC";	
		$r = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetListStoryUpload($arrStory)
	{
		$id=implode(",",$arrStory);
		$temp="";
		if($id!=""){
			$temp="AND Id NOT IN (".$id.")";
		}
		$sql = "SELECT Id,Name,Url2 FROM qq_story WHERE prioritized=1 ".$temp." LIMIT 1";	
		$r = mysqli_query($this->_conn,$sql);		
		$arr1 = "";
		$arr2 = "";
		$arr3 = "";
		$a2=array();
		
			
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr1 = $a["Id"];
			$arr2 = $a["Name"];
			$arr3 = $a["Url2"];
			break;
		}
		array_push($a2,$arr1);	
		array_push($a2,$arr2);
		array_push($a2,$arr3);
		return $a2;
	}
	function GetNumSumPrioritized()
	{
		$sql = "SELECT Id FROM qq_story WHERE prioritized=1";
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);	
		return $num;
	}
	function GetChapterLink2($idStory,$from,$to)
	{
		
		$sql = "SELECT * FROM `qq_chapter` WHERE IdStory='$idStory' AND CAST(SUBSTRING(Name,8) AS DECIMAL(30,5))>='$from' AND CAST(SUBSTRING(Name,8) AS DECIMAL(30,5))<='$to'";	
		if($from=="")
			$sql = "SELECT * FROM `qq_chapter` WHERE IdStory='$idStory' ORDER BY CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) ASC";	
		$r = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetAllStory($page,$per_page)
	{
		//$q = "select * from qq_story WHERE Id<600 and Id>299";
		//$q = "select * from qq_story WHERE Id<501 and Id>300";
		//$q = "select * from qq_story WHERE Id<9300 and Id>9199";
		//$q = "select Id,Name,Url2 from qq_story WHERE Id<9901 and Id>8900";
		$offset = ($page - 1) * $per_page;
		$l="LIMIT ".$per_page." OFFSET ".$offset;
		$q = "select Id,Name,Url2 from qq_story ".$l;
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	
	function UpdateChapToStory($Id,$NameUpdate_Chap,$DateUpdate_Chap)
	{
			$sql="UPDATE qq_story SET NameUpdate_Chap='$NameUpdate_Chap',DateUpdate_Chap='$DateUpdate_Chap' WHERE Id='$Id'";	
			mysqli_query($this->_conn, $sql);	          		
	}
	function UpdateDateChap($DateUpdate_Chap,$Name,$idStory)
	{
			$sql="UPDATE qq_chapter SET DateUpdate_Chap='$DateUpdate_Chap' WHERE Name='$Name' and IdStory='$idStory'";	
			mysqli_query($this->_conn, $sql);	          		
	}
	function GetAllStory1()
	{

		$q = "select Id from qq_story";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetListStoryDomain($domain_old)
	{

		$q = "select * from qq_story where Url2 like '%$domain_old%'";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetStoryAdmin($per_page,$page,$type,$key)
	{
		
		$key1=mysqli_real_escape_string($this->_conn,$key);		
		$l="";
		$offset = ($page - 1) * $per_page;
		if($type==0)
			$l="LIMIT ".$per_page." OFFSET ".$offset;
		   $sql = "SELECT * from qq_story where CONCAT(Name,NameOther,story_Status,Content,Genre,Country) like '%".$key1."%'"." and Male=0 ORDER BY Id ASC ".$l;
		   //echo $sql;
		   $r3 = mysqli_query($this->_conn,$sql);		
			
		//echo $sql;
		
		$arr = array();
		while($a = mysqli_fetch_array($r3,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type==0)
		return $arr;
	else
		    return mysqli_num_rows($r3);
        
	}
	function GetStoryAdmin1($per_page,$page,$type,$key,$qq)
	{
		$type1="";
		if($qq==1){
			$type1=" and prioritized=1 ";
		}else if($qq==2){
			$type1=" and prioritized=0 ";
		}
		$key1=mysqli_real_escape_string($this->_conn,$key);		
		$l="";
		$offset = ($page - 1) * $per_page;
		if($type==0)
			$l="LIMIT ".$per_page." OFFSET ".$offset;
		   $sql = "SELECT * from qq_story where CONCAT(Name,NameOther,story_Status,Content,Genre,Country) like '%".$key1."%'"." ".$type1." and Male=0 ORDER BY Id ASC ".$l;
		   
		   $r3 = mysqli_query($this->_conn,$sql);		
			
		//echo $sql;
		
		$arr = array();
		while($a = mysqli_fetch_array($r3,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type==0)
		return $arr;
	else
		    return mysqli_num_rows($r3);
        
	
	}
	function GetCountChap($id)
	{
		$sql = "select * from qq_chapter where IdStory='$id'";
		//explain select * from qq_chapter where IdStory='$id'
		//echo CREATE INDEX IdStory ON qq_chapter (IdStory);
		$result =mysqli_query($this->_conn, $sql);	
		
		 return mysqli_num_rows($result);;
        	
		
	}
	function GetCountChapImg($id)
	{
		$q = "select * from qq_chapter where IdStory='$id'";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		$t="Chưa cập nhật";
		foreach($arr as $item){
			$a1 = explode(',', $item["Path"]);
			if(count($a1)>2){
			 $t="Đã cập nhật";
			 break;
			}
		
		}
		return $t;
	}
	function UpdateStory2($Id,$Name)
	{
		$Name1=mysqli_real_escape_string($this->_conn,$Name);		     
		$sql="UPDATE qq_story SET Name='$Name1' WHERE Id='$Id'";	
		mysqli_query($this->_conn, $sql);	          
			
	}
	function UpdateDomain_story($id,$url)
	{
				     
		$sql="UPDATE qq_story SET Url2='$url' WHERE Id='$id'";	
		mysqli_query($this->_conn, $sql);	          
			
	}
	function UpdateDomain_site($id,$name)
	{
				     
		$sql="UPDATE qq_site SET Name='$name' WHERE Id='$id'";	
		mysqli_query($this->_conn, $sql);	          
			
	}
	
	function GetDomain_site($id)
	{
		$sql = "SELECT Name from qq_site WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Name'];	
        return $b;	
	}
	function UpdatePrioritized($Id,$type)
	{
		$flag=0;
		$sql="UPDATE qq_story SET prioritized='$type' WHERE Id='$Id'";	
		mysqli_query($this->_conn, $sql);
	   if(mysqli_affected_rows($this->_conn)==1)	
		  $flag=1; 
	  return $flag;	
	}
	
	function UpdateDomain_chap($domain_old,$domain_new)
	{
		$flag=0;
		$sql="UPDATE qq_chapter SET Content_04='$domain_new' WHERE Content_04 like '%$domain_old%'";	
		mysqli_query($this->_conn, $sql);
	   if(mysqli_affected_rows($this->_conn)==1)	
		  $flag=1; 
	  return $flag;	
	}
	function AddStory($Name,$NameOther,$Status,$Content,$Avatar,$Badge,$Waning,$Author,$Genre,$NameEncodeGenres,$Country,$DateUpload,$URL1,$URL2,$female,$male)
	{
		$hide_view=0;
		$Name1=mysqli_real_escape_string($this->_conn,$Name);
		$NameOther1=mysqli_real_escape_string($this->_conn,$NameOther);
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Author1=mysqli_real_escape_string($this->_conn,$Author);
		
			$sql="INSERT INTO qq_story (Name,NameOther,story_Status,Content,ImgAvatar,Badge,Waning,Author,Genre,NameEncodeGenres,Country,DateUpload,Url1,Url2,Female,Male,hide_view) VALUES ('$Name1','$NameOther1','$Status','$Content1','$Avatar','$Badge','$Waning','$Author1','$Genre','$NameEncodeGenres','$Country','$DateUpload','$URL1','$URL2','$female','$male','$hide_view')";
			
			$error="loi";
			mysqli_query($this->_conn, $sql);	
		  if(mysqli_affected_rows($this->_conn)==1)
			$error="Thêm thành công";
		return $error;
	}
	function GetStoryByLink($link)
	{
		$n=mysqli_real_escape_string($this->_conn, $link);
		$sql = "select * from qq_story where Name='$n'";
		$result =mysqli_query($this->_conn, $sql);			
		$arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		$a1=array();
	    foreach($arr as $item4){	
			array_push($a1,$item4["Id"]);
			array_push($a1,$item4["Name"]);
			break;
	    }
		return $a1;
	}
	function AddStory3($Name,$NameOther,$Status,$Content,$Avatar,$Badge,$Waning,$Author,$Genre,$NameEncodeGenres,$Country,$DateUpload,$URL1,$URL2,$female,$male)
	{
		$hide_view=0;
		$Name1=mysqli_real_escape_string($this->_conn,$Name);
		$NameOther1=mysqli_real_escape_string($this->_conn,$NameOther);
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Author1=mysqli_real_escape_string($this->_conn,$Author);
		
			$sql="INSERT INTO qq_story (Name,NameOther,story_Status,Content,ImgAvatar,Badge,Waning,Author,Genre,NameEncodeGenres,Country,DateUpload,Url1,Url2,Female,Male,hide_view) VALUES ('$Name1','$NameOther1','$Status','$Content1','$Avatar','$Badge','$Waning','$Author1','$Genre','$NameEncodeGenres','$Country','$DateUpload','$URL1','$URL2','$female','$male','$hide_view')";
			
			
			mysqli_query($this->_conn, $sql);	
		 $id_insert=mysqli_insert_id($this->_conn);
		return $id_insert;
	}
	function UpdateStory3($Id,$Name,$NameOther,$Status,$Content,$Avatar,$Badge,$Waning,$Author,$Genre,$NameEncodeGenres,$Country,$DateUpload,$URL1,$URL2,$female,$male)
	{
		$hide_view=0;
		$Name1=mysqli_real_escape_string($this->_conn,$Name);
		$NameOther1=mysqli_real_escape_string($this->_conn,$NameOther);
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Author1=mysqli_real_escape_string($this->_conn,$Author);
		   
		$sql="UPDATE qq_story SET NameOther='$NameOther1',story_Status='$Status',Content='$Content1',ImgAvatar='$Avatar',Badge='$Badge',Waning='$Waning',Author='$Author1',Genre='$Genre',NameEncodeGenres='$NameEncodeGenres',Country='$Country',DateUpload='$DateUpload',Url1='$URL1',Url2='$URL2',Female='$female',Male='$male',hide_view='$hide_view' WHERE Id='$Id'";	
			mysqli_query($this->_conn, $sql);	          
			
	}
	function UpdateStory($Id,$NameOther,$Content,$Waning,$Author,$Sum_like,$Sum_heart,$Sum_view)
	{
		$NameOther1=mysqli_real_escape_string($this->_conn,$NameOther);
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Author1=mysqli_real_escape_string($this->_conn,$Author);
		     $error="Sửa thất bại";
		$sql="UPDATE qq_story SET NameOther='$NameOther1',Content='$Content1',Waning='$Waning',Author='$Author1',Sum_Like='$Sum_like',Sum_Subscribe='$Sum_heart',Sum_Views='$Sum_view' WHERE Id='$Id'";	
			mysqli_query($this->_conn, $sql);	          
			if(mysqli_affected_rows($this->_conn)==1)
			$error="Sửa thành công";
	
		
		return  $error;
	}
	function AddChap($Name,$Content,$Notify,$Summary,$DateUpload,$IdStory,$Path,$Content_01,$Content_02,$Content_03,$Content_04,$Title,$url1="")
	{
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Content_03_1=mysqli_real_escape_string($this->_conn,$Content_03);
		$Title1=mysqli_real_escape_string($this->_conn,$Title);
		$error="Thêm thất bại";
$sql="INSERT INTO qq_chapter (Name,Content,Notify,Summary,DateUpload,IdStory,Path,Content_01,Content_02,Content_03,Content_04,Title,url1) VALUES ('$Name','$Content1','$Notify','$Summary','$DateUpload','$IdStory','$Path','$Content_01','$Content_02','$Content_03_1','$Content_04','$Title1','$url1')";

     //echo $sql;
			mysqli_query($this->_conn, $sql);	
		   if(mysqli_affected_rows($this->_conn)==1)
			$error="Thêm thành công";
		return $error;
	}
	function UpdateChap($IdChap,$Name,$Content,$Content_03,$Summary,$IdStory,$Path,$Title)
	{
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Content_03_1=mysqli_real_escape_string($this->_conn,$Content_03);
		$Title1=mysqli_real_escape_string($this->_conn,$Title);
		     $error="Sửa thất bại";
$sql="UPDATE qq_chapter SET Name='$Name',Content='$Content1',Content_03='$Content_03_1',Summary='$Summary',IdStory='$IdStory',Path='$Path',Title='$Title1' WHERE Id='$IdChap'";
			mysqli_query($this->_conn, $sql);	
	        if(mysqli_affected_rows($this->_conn)==1)
			$error="Sửa thành công";
		
		return  $error;
	}
	function UpdateChap3($IdStory,$Name,$Path,$Content_04,$Summary)
	{

	$sql="UPDATE qq_chapter SET Path='$Path',Content_04='$Content_04',Summary='$Summary' WHERE IdStory='$IdStory' and Name='$Name'";
	mysqli_query($this->_conn, $sql);	

	}
	function GetStoryComicAll()
	{
		$sql = "select * from qq_story where Female=1";	
		$r = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetChapBloger()
	{

		$q = "SELECT Id,url1 FROM qq_chapter WHERE `Path` LIKE '%blogger.googleusercontent.com%'";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function UpdateChapBloger($Id,$Path)
	{
    	$sql="UPDATE qq_chapter SET Path='$Path' WHERE Id='$Id'";
    	mysqli_query($this->_conn, $sql);	

	}
	function AddAuthors($name,$nameEncode)
	{
			$p=mysqli_real_escape_string($this->_conn,$name);
			$sql2 = "select * from qq_authors where Name='$p'";
			$result =mysqli_query($this->_conn, $sql2);	
			$num = mysqli_num_rows($result);
			if($num<=0){
				$sql="INSERT INTO qq_authors (Name,NameEncode) VALUES ('$p','$nameEncode')";				
				mysqli_query($this->_conn, $sql);
			}
	}
	function AddGenres($name,$nameEncode)
	{
			$p=mysqli_real_escape_string($this->_conn,$name);
			$sql2 = "select * from qq_genres where Name='$p'";
			$result =mysqli_query($this->_conn, $sql2);	
			$num = mysqli_num_rows($result);
			if($num<=0){
				$sql="INSERT INTO qq_genres (Name,NameEncode) VALUES ('$p','$nameEncode')";				
				mysqli_query($this->_conn, $sql);
			}
	}

}
?>