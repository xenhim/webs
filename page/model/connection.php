<?php
 if (session_status() == PHP_SESSION_NONE) {
		  session_start();
		  // session_unset(); 
		  // session_destroy();
		}
		
		
class config
{
	private $_conn;
	function config()
    {
		
		if (!$this->_conn)
		{			
		$dbconfig ="";			
		if (file_exists(".env")) {
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
		$dbname = $dbconfig["DB_DATABASE"];
	    $this->_conn =mysqli_connect($servername, $username , $password, $dbname) or die ('Lỗi kết nối'); 		  		  
	    //mysqli_query($this->_conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");			
		  mysqli_set_charset($this->_conn,"utf8");	
		  mysqli_set_charset($this->_conn,"SQL_BIG_SELECTS = 1");
	  
		  //define('MYSQL_BOTH',MYSQLI_BOTH);
		  //define('MYSQL_NUM',MYSQLI_NUM);
		  //define('MYSQLI_ASSOC',MYSQLI_ASSOC);	
		}
	}

	function dis_connect()
	{
		if ($this->_conn)
		{
            mysqli_close($this->_conn);
        }
	}
	function GetNewsById($id)
	{		
		$sql = "SELECT * from qq_news where Id='$id'";
		$result = mysqli_query($this->_conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$Id=$row['Id'];
		$Name=$row['Name'];
		$Img=$row['Img'];		
		$Content=$row['Content'];
		$UpdateBy=$row['UpdateBy'];
		$UpdateDate=$row['UpdateDate'];
		$a=array();
		array_push($a,$Id);
		array_push($a,$Name);
		array_push($a,$Img);
		array_push($a,$Content);
		array_push($a,$UpdateBy);
		array_push($a,$UpdateDate);
        return $a;
	}
	function GetNewsTop($type,$item_per_page,$current_page)
	{
		$sql="";
		$k="";		
		$offset = ($current_page - 1) * $item_per_page;		

		
		$sql = "SELECT * FROM qq_news where 1 ";
	
		$sql6=$sql;		
		$sql=$sql6." LIMIT ".$item_per_page." OFFSET ".$offset;
		mysqli_query($this->_conn, "SET SQL_BIG_SELECTS = 1");
		
		//echo $sql;
		//$time = microtime(true);
		$rr = mysqli_query($this->_conn,$sql);		
		//echo microtime(true)-$time;
		$arr = array();
		$arr2=array();		
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type=="total"){//trả vê tổng số dòng
		
			$r3 = mysqli_query($this->_conn,$sql6);		
			$arr3 = array();
			while($a3 = mysqli_fetch_array($r3,MYSQLI_ASSOC))
			{
				$arr3[] = $a3;
			}
		
		    return mysqli_num_rows($r3);
		}
			else
		return $arr;
	
	}

	function GetOptionLink($id=1)
	{
		$sql = "SELECT * from qq_optionslink WHERE Id=$id";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Link'];	
        return $b;	
	}
    function test1($str)
	{
	    $name1= mysqli_real_escape_string($this->_conn, $str);
        $sql = "select Id from qq_story where Name='$name1' and Female=1 and Male=0";
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);	
		return $num;	
        //return mysqli_real_escape_string($this->_conn, $str);	
	}
	
    function GetInfoUser($email)
	{		
		$sql = "SELECT * from qq_users where Email='$email'";
		$result = mysqli_query($this->_conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$Id=$row['Id'];
		$LastName=$row['LastName'];
		$FirstName=$row['FirstName'];		
		$Birthday=$row['Birthday'];
		$Phone=$row['Phone'];
		$Gender=$row['Gender'];
		$Path=$row['Path'];			
		$a=array();
		
		array_push($a,$Id);
		array_push($a,$LastName);
		array_push($a,$FirstName);
		array_push($a,$Birthday);
		array_push($a,$Phone);
		array_push($a,$Gender);
		array_push($a,$Path);
        return $a;
	}
	
	function GetLogo()
	{		
		$sql = "SELECT * from qq_logo where Id=1";
		$result = mysqli_query($this->_conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$Id=$row['Id'];
		$url_logo=$row['url_logo'];
		$url_logo_on=$row['url_logo_on'];		
		$url_favicon=$row['url_favicon'];
		$url_group=$row['url_group'];				
		$a=array();		
		array_push($a,$Id);
		array_push($a,$url_logo);
		array_push($a,$url_logo_on);
		array_push($a,$url_favicon);
		array_push($a,$url_group);
        return $a;
	}
	function GetCountryFind()
	{
		$arr = array();
		
			$sql = "SELECT * from qq_countrys where Type<> -1 ORDER BY Type ASC";
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}		
		return $arr;
	}
	
	function GetStatusFind()
	{
		$arr = array();
		
			$sql = "SELECT * from qq_status ORDER BY Type ASC";
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}		
		return $arr;
	}
	function GetMinchapterFind()
	{
		$arr = array();		
			$sql = "SELECT * from qq_minchapter ORDER BY Type ASC";
		    $r = mysqli_query($this->_conn,$sql);				
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}		
		return $arr;
	}
	function GetSortFind()
	{
		$arr = array();
		
			$sql = "SELECT * from qq_searchsort ORDER BY Type ASC";
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}		
		return $arr;
	}
	function checkGenres($nameEncode)
	{
		$b="";
		$sql = "SELECT * from qq_genres WHERE NameEncode='$nameEncode'";
		$result =mysqli_query($this->_conn, $sql);			
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Type'];	
        return $b;	
	}
	function GetSort()
	{
		$arr = array();
		
			$sql = "SELECT * from qq_sort where Type=0";
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}
		
		
		return $arr;
	}
	function GetNameSort($NameEncode)
	{
		
		
		$sql = "SELECT * from qq_sort WHERE NameEncode='$NameEncode'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['NameFull'];	
        return $b;	
		
	}
	function GetGenres()
	{
		
		$arr = array();
		
			$sql = "SELECT * from qq_genres where Type=''";
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}
		
		
		return $arr;
	}
	function GetImageChap($IdChapter)
	{
		$arr = array();
		
			$sql = "SELECT * from qq_chapter where Id='$IdChapter'";
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}
		
		
		return $arr;
	}
	function GetImageChap2($IdChapter,$IdStory)
	{
		$arr = array();
		
			$sql = "SELECT * from qq_chapter where Name='$IdChapter' and IdStory='$IdStory'";
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}
		
		
		return $arr;
	}
	
	function GetListEmoji($a)
	{
		$arr = array();
		if($a==0){
			$sql = "SELECT * from qq_emojis";
			
			mysqli_query($this->_conn,"SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}
		}else{
			$sql = "SELECT * from qq_emojis GROUP BY NameEmoji";
			mysqli_query($this->_conn,"SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
		    $r = mysqli_query($this->_conn,$sql);		
		
			while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}
		}
		
		return $arr;
	}
	function GetListGenre($id)
	{
		$sql = "SELECT * from qq_story WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Name'];	
        return $b;	
	}
	function GetNameStory($id)
	{
		$sql = "SELECT * from qq_story WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Name'];	
        return $b;	
	}
	function GetChapter($IdStory)
	{
		$q = "select Name,IdStory,DateUpload from qq_chapter where IdStory='$IdStory' ORDER BY CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) DESC";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetNameChapter($name)
	{
		$q = "select * from qq_chapter where Name='$name' ORDER BY Id DESC";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetChapter2($IdStory)
	{
		$q = "select Name,Title,DateUpload from qq_chapter where IdStory='$IdStory' ORDER BY CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) DESC";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
function GetChapter3($IdStory)
	{
		$q = "select Name,Title,DateUpload from qq_chapter where IdStory='$IdStory' ORDER BY CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) DESC";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetAllChapter($IdStory)
	{
		$q = "select * from qq_chapter where IdStory='$IdStory'";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	
	function GetIdChapter1($IdChap)
	{
		$sql = "select * from qq_chapter where Id='$IdChap'";	
		$result = mysqli_query($this->_conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$Name=$row['Name'];
		$Content=$row['Content'];
		$Content_03=$row['Content_03'];		
		$Path=$row['Path'];
		$Summary=$row['Summary'];
		$Title=$row['Title'];	
		$Content_04=$row['Content_04'];
		$a=array();
		
		array_push($a,$Name);
		array_push($a,$Content);
		array_push($a,$Content_03);
		array_push($a,$Path);
		array_push($a,$Summary);
		array_push($a,$Title);
		array_push($a,$Content_04);
        return $a;
	}
	function GetIdStory($id)
	{
		$sql = "select * from qq_story where Id='$id' and hide_view=0";	
		$result = mysqli_query($this->_conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$numRow=mysqli_num_rows($result);
		$a=array();
		if($numRow!=0){
		$Avatar=$row['ImgAvatar'];//0
		$Name=$row['Name'];
		$NameOther=$row['NameOther'];
		$Status=$row['story_Status'];
		$Content=$row['Content'];
		$Badge=$row['Badge'];
		$Waning=$row['Waning'];
		$Author=$row['Author'];
		$Genre=$row['Genre'];
		$Country=$row['Country'];		
		$DateUpload=$row['DateUpload'];		
		$url1=$row['Url1'];
		$url2=$row['Url2'];
		$female=$row['Female'];
		$male=$row['Male'];
		$id=$row['Id'];
		$Sum_Subscribe=$row['Sum_Subscribe'];
		$Sum_Like=$row['Sum_Like'];
		$Sum_Views=$row['Sum_Views'];
		$NameUpdate_Chap=$row['NameUpdate_Chap'];
		$DateUpdate_Chap=$row['DateUpdate_Chap'];
		
		array_push($a,$Avatar);
		array_push($a,$Name);
		array_push($a,$NameOther);
		array_push($a,$Status);
		array_push($a,$Content);
		array_push($a,$Badge);
		array_push($a,$Waning);
		array_push($a,$Author);
		array_push($a,$Genre);
		array_push($a,$Country);		
		array_push($a,$DateUpload);
		
		array_push($a,$url1);//11
		array_push($a,$url2);//12
		array_push($a,$female);//13
		array_push($a,$male);//14
		array_push($a,$id);//15
		array_push($a,$Sum_Subscribe);//16
		array_push($a,$Sum_Like);//17
		array_push($a,$Sum_Views);//18
		array_push($a,$NameUpdate_Chap);//19
		array_push($a,$DateUpdate_Chap);//20
		}
		
        return $a;
	}
	function GetChapterLink($idStory)
	{
		$sql = "select * from qq_chapter where IdStory='$idStory'";	
		$r = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetStory()
	{
		$q = "select * from qq_story";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetStoryJoinSlider()
	{
		$q = "SELECT * FROM qq_story WHERE Id NOT IN(SELECT IdStory FROM qq_slider)";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetStoryJoinRelease()
	{
		$q = "SELECT * FROM qq_story WHERE Id NOT IN(SELECT IdStory FROM qq_release)";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetByIdStory($idStory)
	{
		$sql = "select * from qq_story where Id='$idStory'";
		$result =mysqli_query($this->_conn, $sql);			
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$c=array();
		if($a!=null){
        $b1= $a['Id'];//0	
		$b2= $a['Name'];//1	
		$b3= $a['story_Status'];//2	
		$b4= $a['Content'];	//3
		$b5= $a['ImgAvatar'];//4
		$b6= $a['Badge'];//5	
		$b7= $a['Waning'];	//6
		$b8= $a['Author'];//7
		$b9= $a['Genre'];//8		
		$b10= $a['Country'];//9		
		$b11= $a['Sum_Subscribe'];//10
		$b12= $a['Sum_Like'];//11
		$b13= $a['Sum_Views'];	//12
		$b14= $a['NameUpdate_Chap'];	//13	
		$b15= $a['DateUpdate_Chap'];	//14
		$b16= $a['Male'];	//15				
			array_push($c,$b1);
			array_push($c,$b2);
			array_push($c,$b3);
			array_push($c,$b4);
			array_push($c,$b5);
			array_push($c,$b6);
			array_push($c,$b7);
			array_push($c,$b8);
			array_push($c,$b9);
			array_push($c,$b10);
			array_push($c,$b11);
			array_push($c,$b12);
			array_push($c,$b13);
			/////////////////////
			array_push($c,$b14);
			array_push($c,$b15);
			array_push($c,$b16);
		}
        return $c;	      
	}
	function GetInfoGenre($id)
	{
		$sql = "select * from qq_genres where Id='$id'";
		$result =mysqli_query($this->_conn, $sql);			
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$c=array();
		if($a!=null){
        $b1= $a['Id'];//0	
		$b2= $a['Name'];//1	
		$b3= $a['Title'];//2	
		array_push($c,$b1);
		array_push($c,$b2);
		array_push($c,$b3);
		
		}
        return $c;	      
	}
	function GetGenre()
	{
		$q = "select * from qq_genres";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetAuthor()
	{
		$q = "select * from qq_authors";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetIdAuthor($name)
	{
		$n=mysqli_real_escape_string($this->_conn, $name);
		$sql = "SELECT * from qq_authors WHERE Name=N'$n'";
		$result =mysqli_query($this->_conn, $sql);	
		//echo "<br>".$sql;
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$b="";
		if(isset($a['Id']))
        $b= $a['Id'];	
        return $b;	
	}
	// function GetIdGenres($name)
	// {
		// $n=mysqli_real_escape_string($this->_conn, $name);
		// $sql = "SELECT * from qq_genres WHERE Name=N'$n'";
		// $result =mysqli_query($this->_conn, $sql);	
		// //echo "<br>".$sql;
		// $a = mysqli_fetch_array($result,MYSQLI_ASSOC);
		// $b="";
		// if(isset($a['Name']))
        // $b= $a['Name'];	
        // return $b;	
	// }
	function GetPathSliderById($id)
	{
		$sql = "SELECT * from qq_slider WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Path'];	
		$b1= $a['IdStory'];	
		
				
		$c=array();
		
		array_push($c,$b);
		array_push($c,$b1);
        return $c;	
	}
	
	function GetNameAuthor($name)
	{
		$sql = "SELECT * from qq_authors WHERE NameEncode='$name'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Name'];	
        return $b;	
	}
	function GetCountry()
	{
		$q = "select * from qq_countrys";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function check_story_exist5($name)
	{
		//SUBSTRING(Name,8)
		$n=mysqli_real_escape_string($this->_conn, $name);
		$sql = "select * from qq_story where Name='$n'";
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);	
		return $num;
	}
	function check_story_exist($name,$Female,$Male)
	{
		//SUBSTRING(Name,8)
		//$n=mysqli_real_escape_string($this->_conn, $name);
		//$Female=0;truyentranh
		//$Male=1;truyen chu
		$sql = "select Id from qq_story where Name='$name' and Female='$Female' and Male='$Male'";
		//echo $sql;
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);	
		return $num;
	}
	function get_story_exist($name)
	{
		//SUBSTRING(Name,8)
		$n=mysqli_real_escape_string($this->_conn, $name);
		$sql = "select Id from qq_story where Name='$n'";
		$result =mysqli_query($this->_conn, $sql);	
		$b="";
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($a!=[])
        $b= $a['Id'];
	
		return $b;
	}
	function get_story_exist2($name,$Female,$Male)
	{
		//SUBSTRING(Name,8)
		$n=mysqli_real_escape_string($this->_conn, $name);
		$sql = "select Id from qq_story where Name='$name' and Female='$Female' and Male='$Male'";
		$result =mysqli_query($this->_conn, $sql);	
		$b="";
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($a!=[])
        $b= $a['Id'];
	
		return $b;
	}
	function check_chap_exist_getlink($name,$idStory)
	{
		//SUBSTRING(Name,8)
		$n=mysqli_real_escape_string($this->_conn, $name);
		$sql = "select * from qq_chapter where Name='$n' and IdStory='$idStory'";
		$result =mysqli_query($this->_conn, $sql);	
		$b="";
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($a!=[])
        $b= $a['Id'];
		$flac=1;
		if($b==""){
			$flac=0;
		}
	
		return $flac;
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
	function get_chap_exist($name,$idStory)
	{
		//SUBSTRING(Name,8)
		$sql = "select * from qq_chapter where Name='$name' and IdStory='$idStory'";
		$result =mysqli_query($this->_conn, $sql);	
		$b="";
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($a!=[])
        $b= $a['Id'];
	
		return $b;
	}
	function next_chap($idstory,$idchap)
	{
		//SUBSTRING(Name,8)
		$sql = "select Name from qq_chapter where CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) = (select min(CAST(SUBSTRING(Name,8) AS DECIMAL(30,5))) from qq_chapter where CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) > '$idchap' AND IdStory='$idstory') AND IdStory='$idstory'";
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);
		//echo $sql; 	
		$a=1;
		$b=1;
		if($num>0){
			$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$b= $a['Name'];	
		}
		//echo $b;		
		return $b;
	}
	function previous_chap($idstory,$idchap)
	{
		$sql = "select Name from qq_chapter where CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) = (select max(CAST(SUBSTRING(Name,8) AS DECIMAL(30,5))) from qq_chapter where CAST(SUBSTRING(Name,8) AS DECIMAL(30,5)) < '$idchap' AND IdStory='$idstory') AND IdStory='$idstory'";
		$result =mysqli_query($this->_conn, $sql);
		$num = mysqli_num_rows($result);	
			//echo $sql; 		
		$a=1;
		$b=1;
		if($num>0){
			$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$b= $a['Name'];	
		}
		//echo $sql;		
        return $b;	
	}
	function GetIdChap($name)
	{
		$sql = "SELECT * from qq_chapter WHERE Name='$name'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Id'];	
        return $b;	
	}
	
	function GetByIdChap($Id)
	{
		$sql = "SELECT * from qq_chapter WHERE IdStory='$Id' ORDER BY Id DESC LIMIT 1";
		$r =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Id"];
		}	
        return $b;	
	}
	function GetUrl1Chap($name,$Id)
	{
		$sql = "SELECT * from qq_chapter WHERE IdStory='$Id' and Name='$name'";
		$r =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["url1"];
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
	function convert_timer1($str){
		$db=new config();
				$db->config();		
		date_default_timezone_set("Asia/Ho_Chi_Minh");	
		$DateComment="1 Phút Trước";
						
				 $o = json_decode($db->chuyen_timer($str,date('Y-m-d H:i:s')));
				 if($o->years!=0)
				  $DateComment=$o->years." Năm Trước";
				 else if($o->months!=0) $DateComment= $o->months." Tháng Trước";
				 else if($o->days!=0) $DateComment= $o->days." Ngày Trước";
				 else if($o->hours!=0) $DateComment= $o->hours." Giờ Trước";
				 else if($o->minutes!=0) $DateComment= $o->minutes." Phút Trước";
				 else if($o->seconds!=0) $DateComment= "1 Phút Trước";
				 return $DateComment;
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
			
			$DateComment="1 Phút Trước";
				$db=new config();
				$db->config();		
				 $o = json_decode($db->chuyen_timer($b,date('Y-m-d H:i:s')));
				 if($o->years!=0)
				  $DateComment=$o->years." Năm Trước";
				 else if($o->months!=0) $DateComment= $o->months." Tháng Trước";
				 else if($o->days!=0) $DateComment= $o->days." Ngày Trước";
				 else if($o->hours!=0) $DateComment= $o->hours." Giờ Trước";
				 else if($o->minutes!=0) $DateComment= $o->minutes." Phút Trước";
				 else if($o->seconds!=0) $DateComment= "1 Phút Trước";
		}
        return $DateComment;	
	}
	function GetMinChap($Id)
	{
		$sql = "SELECT count(*) as min from qq_chapter WHERE IdStory='$Id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["min"];
		}
        return $b;	
       
	}
	function GetGenresByIdAndNameCode($Id)
	{
		$sql = "SELECT * from qq_genres WHERE Id='$Id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Name"];
		}
        return $b;	
	}
	function GetIdGenre($name)
	{
		$sql = "SELECT * from qq_genres WHERE Name='$name'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Id"];
		}
        return $b;	
       
	}
	function GetFind($category_notcategory,$country,$status,$min,$sort,$type,$item_per_page,$current_page)
	{
		$k="";
		//echo 
		$offset = ($current_page - 1) * $item_per_page;
		if($category_notcategory !="")
		$k.=$category_notcategory;
		
		if($country!="0"){
			
			switch ($country) {
			  case "1":	
				$country="Trung Quốc";
				break;
			  case "2":
			    $country="Việt Nam";
				break;
			  case "3":
				$country="Hàn Quốc";
				break;
			  case "4":
				$country="Nhật Bản";
				break;
			  case "5":
				$country="Mỹ";
				break;			
			}
			$k.=" and Country LIKE '%".$country."%'";
				
		}
		if($status!="0"){
			switch ($status) {
			  case "1":	
				$status="Đang tiến hành";
				break;
			  case "2":
			    $status="Hoàn thành";
				break;
			 
				break;			
			}
			$k.=" and story_Status LIKE '%".$status."%'";
		}
		$k.=" and CAST(SUBSTRING(NameUpdate_Chap,8) AS DECIMAL(30,5))>".$min;
		if($sort==3){
		//ngay cap nhat tang dan dan				
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpdate_Chap ASC";				
		}else if($sort==0){
		//ngay dang giam dan				
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpload DESC ";		
		}else if($sort==1){
		//ngay dang tang dan dan			
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpload ASC ";
		}else if($sort==5){
		//luot xem tang dan			
		$sql="SELECT d.Male,d.NameUpdate_Chap,d.DateUpdate_Chap,d.Sum_Subscribe,d.Sum_Like,d.Sum_Views,d.Id,d.Name,d.ImgAvatar,d.Badge,d.Country,d.Genre,d.Content,d.story_Status,d.DateUpload FROM qq_story d WHERE d.hide_view=0 ".$k." ORDER BY d.Sum_Views ASC";
		}else if($sort==4){
		//luot xem giam dan			
		$sql="SELECT d.Male,d.NameUpdate_Chap,d.DateUpdate_Chap,d.Sum_Subscribe,d.Sum_Like,d.Sum_Views,d.Id,d.Name,d.ImgAvatar,d.Badge,d.Country,d.Genre,d.Content,d.story_Status,d.DateUpload FROM qq_story d WHERE d.hide_view=0 ".$k." ORDER BY d.Sum_Views DESC";
		}else{			
		//ngay cap nhat giam dan				
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpdate_Chap DESC ";	
		}
		//echo $sort;
		$sql6=$sql;
		$sql=$sql." LIMIT ".$item_per_page." OFFSET ".$offset;
		
		
		//echo $sql;
		
		mysqli_query($this->_conn, "SET SQL_BIG_SELECTS = 1");
		$r = mysqli_query($this->_conn,$sql);		
		$arr = array();
		
		
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		
		if($type=="total"){//trả vê tổng số dòng
		
			$r3 = mysqli_query($this->_conn,$sql6);		
			$arr3 = array();
		
		
			while($a3 = mysqli_fetch_array($r3,MYSQLI_ASSOC))
			{
				$arr3[] = $a3;
			}
		
		    return mysqli_num_rows($r3);
		}
			else
		return $arr;//trả về mảng đã phân trang
	
	}
	
	function GetSortTop($country,$status,$sort,$date,$type,$item_per_page,$current_page)
	{
		$sql="";
		$k="";		
		$offset = ($current_page - 1) * $item_per_page;		
		switch ($country) {
		  case "1":	
			$country="Trung Quốc";
			break;
		  case "2":
			$country="Việt Nam";
			break;
		  case "3":
			$country="Hàn Quốc";
			break;
		  case "4":
			$country="Nhật Bản";
			break;
		  case "5":
			$country="Mỹ";
			break;
		  default:
 		  $country="";
		}
		switch ($status) {
		  case "0":	
			$status="Đang tiến hành";
			break;
		  case "2":
			$status="Hoàn thành";
			break;
		  default:
 		  $status="";	
		}
		if($country!=""){			
			$k.=" and Country LIKE '%".$country."%'";				
		}
		if($status!=""){
			if($sort!="truyen-hoan-thanh")
			$k.=" and story_Status LIKE '%".$status."%'";
		}
		$sql = "SELECT * FROM qq_story where 1 ";
		switch ($sort) {
		  case "truyen-hot":	
			$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id, a.Name, a.ImgAvatar, a.Badge, a.Country, a.Genre, a.Content, a.story_Status, a.DateUpload FROM qq_story a WHERE a.Badge='Hot' and a.hide_view=0 ".$k." ORDER BY `Sum_Views` DESC ";
			break;
		  case "top-ngay":	
			$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id, a.Name, a.ImgAvatar, a.Badge, a.Country, a.Genre, a.Content, a.story_Status, a.DateUpload FROM qq_story a WHERE a.Badge='Hot' and a.hide_view=0 ".$k." ORDER BY `Sum_Views` DESC ";
			break; 
		  case "xem-nhieu-nhat":	
			$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id, a.Name, a.ImgAvatar, a.Badge, a.Country, a.Genre, a.Content, a.story_Status, a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY `Sum_Views` DESC ";
			break;  	
		  case "top-ngay":	
			$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id, a.Name, a.ImgAvatar, a.Badge, a.Country, a.Genre, a.Content, a.story_Status, a.DateUpload, COUNT(a.Id) as topDay FROM qq_story a, qq_viewschap c WHERE a.hide_view=0 and a.Id = c.IdStory and c.DateInsert BETWEEN '".$date."' AND '".$date."'  GROUP BY c.IdStory UNION SELECT Male,NameUpdate_Chap,DateUpdate_Chap,Sum_Subscribe,Sum_Like,Sum_Views,Id, Name, ImgAvatar, Badge, Country, Genre, Content, story_Status, DateUpload, 0 AS topDay FROM qq_story WHERE Id NOT IN( SELECT a.Id FROM qq_story a, qq_viewschap c WHERE a.hide_view=0 and a.Id = c.IdStory and c.DateInsert BETWEEN '".$date."' AND '".$date."'  GROUP BY c.IdStory ) and hide_view=0 ".$k."";
			break;
		  case "top-tuan":
			$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id, a.Name, a.ImgAvatar, a.Badge, a.Country, a.Genre, a.Content, a.story_Status, a.DateUpload, COUNT(a.Id) as topWeek FROM qq_story a, qq_viewschap c WHERE a.hide_view=0 and a.Id = c.IdStory and c.DateInsert BETWEEN '".$date[0]."' AND '".$date[1]."'  GROUP BY c.IdStory UNION SELECT Male,NameUpdate_Chap,DateUpdate_Chap,Sum_Subscribe,Sum_Like,Sum_Views,Id, Name, ImgAvatar, Badge, Country, Genre, Content, story_Status, DateUpload, 0 AS topWeek FROM qq_story WHERE Id NOT IN( SELECT a.Id FROM qq_story a, qq_viewschap c WHERE a.hide_view=0 and a.Id = c.IdStory and c.DateInsert BETWEEN '".$date[0]."' AND '".$date[1]."'  GROUP BY c.IdStory ) and hide_view=0 ".$k."";
			break;
		  case "top-thang":
			$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id, a.Name, a.ImgAvatar, a.Badge, a.Country, a.Genre, a.Content, a.story_Status, a.DateUpload, COUNT(a.Id) as topDate FROM qq_story a, qq_viewschap c WHERE a.hide_view=0 and a.Id = c.IdStory and c.DateInsert BETWEEN '".$date[0]."' AND '".$date[1]."'  GROUP BY c.IdStory UNION SELECT Male,NameUpdate_Chap,DateUpdate_Chap,Sum_Subscribe,Sum_Like,Sum_Views,Id, Name, ImgAvatar, Badge, Country, Genre, Content, story_Status, DateUpload, 0 AS topDate FROM qq_story WHERE Id NOT IN( SELECT a.Id FROM qq_story a, qq_viewschap c WHERE a.hide_view=0 and a.Id = c.IdStory and c.DateInsert BETWEEN '".$date[0]."' AND '".$date[1]."'  GROUP BY c.IdStory ) and hide_view=0 ".$k."";
			break;
		  case "truyen-yeu-thich":
			$sql="SELECT * FROM qq_story WHERE hide_view=0 ".$k." ORDER BY `Sum_Subscribe` DESC ";
			break;
		  case "truyen-moi-cap-nhat":
			$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpdate_Chap DESC";
			//echo $sql;
			break;
		  case "truyen-tranh-moi":
			$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpload DESC";
			break;
		  case "truyen-hoan-thanh":
		    $sql="SELECT * FROM qq_story where hide_view=0 and story_Status='Hoàn Thành' ".$k." ORDER BY DateUpdate_Chap DESC";
		    break;
		  case "truyen-tranh-hay":
		    $sql = "SELECT * FROM qq_story where hide_view=0 and Female=1 ".$k." ORDER BY DateUpdate_Chap DESC";
		    break;
		  case "tieu-thuyet-hay":
			$sql = "SELECT * FROM qq_story where hide_view=0 and Male=1 ".$k." ORDER BY DateUpdate_Chap DESC";
		    break;
		}		
		$sql6=$sql;		
		$sql=$sql6." LIMIT ".$item_per_page." OFFSET ".$offset;
		mysqli_query($this->_conn, "SET SQL_BIG_SELECTS = 1");
		
		//echo $sql;
		//$time = microtime(true);
		$rr = mysqli_query($this->_conn,$sql);		
		//echo microtime(true)-$time;
		$arr = array();
		$arr2=array();		
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type=="total"){//trả vê tổng số dòng
		
			$r3 = mysqli_query($this->_conn,$sql6);		
			$arr3 = array();
			while($a3 = mysqli_fetch_array($r3,MYSQLI_ASSOC))
			{
				$arr3[] = $a3;
			}
		
		    return mysqli_num_rows($r3);
		}
			else
		return $arr;
	
	}
	function GetGenreTop($country,$status,$sort,$Genre,$type,$item_per_page,$current_page)
	{
	    //echo "status:".$status;
		
		$k="";
		$offset = ($current_page - 1) * $item_per_page;
		switch ($country) {
		  case "1":	
			$country="Trung Quốc";
			break;
		  case "2":
			$country="Việt Nam";
			break;
		  case "3":
			$country="Hàn Quốc";
			break;
		  case "4":
			$country="Nhật Bản";
			break;
		  case "5":
			$country="Mỹ";
			break;
		  default:
 		  $country="";
		}
		switch ($status) {
		  case "0":	
			$status="Đang tiến hành";
			break;
		  case "2":
			$status="Hoàn thành";
			break;
		  default:
 		  $status="";	
		}
		if($Genre!=""){
			$k.=" and Genre LIKE '%".$Genre."%' ";
					
		}
		if($country!=""){
	
				$k.=" and Country LIKE '%".$country."%' ";
			
		}
		if($status!=""){
			
			$k.=" and story_Status LIKE '%".$status."%' ";
				
		}
		if($sort==4){
		//ngay cap nhat tang dan dan				
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpdate_Chap ASC";				
		}else if($sort==1){
		//ngay dang giam dan				
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpload DESC ";		
		}else if($sort==2){
		//ngay dang tang dan dan			
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpload ASC ";
		}else if($sort==6){
		//luot xem tang dan			
		$sql="SELECT d.Male,d.NameUpdate_Chap,d.DateUpdate_Chap,d.Sum_Subscribe,d.Sum_Like,d.Sum_Views,d.Id,d.Name,d.ImgAvatar,d.Badge,d.Country,d.Genre,d.Content,d.story_Status,d.DateUpload FROM qq_story d WHERE d.hide_view=0 ".$k." ORDER BY d.Sum_Views ASC";
		}else if($sort==5){
		//luot xem giam dan			
		$sql="SELECT d.Male,d.NameUpdate_Chap,d.DateUpdate_Chap,d.Sum_Subscribe,d.Sum_Like,d.Sum_Views,d.Id,d.Name,d.ImgAvatar,d.Badge,d.Country,d.Genre,d.Content,d.story_Status,d.DateUpload FROM qq_story d WHERE d.hide_view=0 ".$k." ORDER BY d.Sum_Views DESC";
		}else{			
		//ngay cap nhat giam dan				
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload FROM qq_story a WHERE a.hide_view=0 ".$k." ORDER BY a.DateUpdate_Chap DESC ";	
		}
	
		$sql6=$sql;		
		$sql=$sql6." LIMIT ".$item_per_page." OFFSET ".$offset;
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		$arr2=array();		
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type=="total"){//trả vê tổng số dòng
		
			$r3 = mysqli_query($this->_conn,$sql6);		
			$arr3 = array();
			while($a3 = mysqli_fetch_array($r3,MYSQLI_ASSOC))
			{
				$arr3[] = $a3;
			}
		
		    return mysqli_num_rows($r3);
		}
			else
		return $arr;
		
	}
	function GetAuthorTop($status,$name,$type,$item_per_page,$current_page)
	{
		
		$k="";
		$offset = ($current_page - 1) * $item_per_page;
		
		switch ($status) {
		  case "0":	
			$status="Đang tiến hành";
			break;
		  case "2":
			$status="Hoàn thành";
			break;
		  default:
 		  $status="";	
		}
		if($status!=""){
			
			$k.=" and story_Status LIKE '%".$status."%' ";
				
		}
		$sql = "SELECT * FROM qq_story where Author like '%".$name."%' ".$k."";
		$sql6=$sql;
		
		$sql=$sql6." LIMIT ".$item_per_page." OFFSET ".$offset;
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		$arr2=array();
		
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type=="total"){//trả vê tổng số dòng
		
			$r3 = mysqli_query($this->_conn,$sql6);		
			$arr3 = array();
		
		
			while($a3 = mysqli_fetch_array($r3,MYSQLI_ASSOC))
			{
				$arr3[] = $a3;
			}
		
		    return mysqli_num_rows($r3);
		}
			else
		return $arr;
		
	}
	function InsertView($idStory,$userName,$ip)
	{
			$sql1 = "SELECT * FROM qq_viewschap WHERE IdStory='$idStory' AND Ip='$ip' AND UserName='$userName' ORDER BY `DateInsert` DESC LIMIT 1";
			$result1 =mysqli_query($this->_conn, $sql1);	
			 date_default_timezone_set("Asia/Ho_Chi_Minh");		
			$a = mysqli_fetch_array($result1,MYSQLI_ASSOC);
			
			$b=date('Y-m-d H:i:s');
			
			if(mysqli_num_rows($result1)>0)
			$b= $a['DateInsert'];
			/////////
				
			 $dateStart=date('Y-m-d H:i:s');	
			 $db=new config();
			 $db->config();		
			 $o = json_decode($db->chuyen_timer($b,$dateStart));	 	
			 if($o->years!=0 || $o->months!=0 || $o->days!=0 || $o->hours!=0) {
				    $db->UpdateViewChapStory($idStory,1);
					$query = "INSERT INTO qq_viewschap (`IdStory`, `DateInsert`, `Ip`, `UserName`) VALUES ('$idStory','$dateStart','$ip','$userName')";
					$result = mysqli_query($this->_conn, $query);	
			 }
			 else if($o->minutes!=0) {
				 if($o->minutes>=2){
					$db->UpdateViewChapStory($idStory,1);
					$query = "INSERT INTO qq_viewschap (`IdStory`, `DateInsert`, `Ip`, `UserName`) VALUES ('$idStory','$dateStart','$ip','$userName')";
					$result = mysqli_query($this->_conn, $query);
				 }
			 }

		
					
	}
	function UploadAvatarUser($email,$path)
	{
		    $query = "UPDATE qq_users SET `Path`='$path' WHERE Email='$email'";
			$result = mysqli_query($this->_conn, $query);
	}
	function UploadAvatarStory($id,$path)
	{
		    $query = "UPDATE qq_story SET `ImgAvatar`='$path' WHERE Id='$id'";
			$result = mysqli_query($this->_conn, $query);
	}
	function GetAvatarUser($email)
	{
		 $sql = "SELECT Path from qq_users WHERE Email='$email'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['Path'];	
        return $b;	
	}
	function GetAvatarUser1($email)
	{
		 $sql = "SELECT Path from qq_users WHERE Email='$email'";
		$result =mysqli_query($this->_conn, $sql);	
		$b="";
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
     	if(count($a)!=0)
        $b= $a['Path'];	
		
        return $b;	
	}
	function GetAvatarStory($id)
	{
		   $sql = "SELECT ImgAvatar from qq_story WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b= $a['ImgAvatar'];	
        return $b;	
	}
	function GetStoryAdmin($key,$per_page,$page,$type)
	{
		
		$kk=mysqli_real_escape_string($this->_conn, $key);
		$l="";
		$offset = ($page - 1) * $per_page;
		if($type==0)
			$l="LIMIT ".$per_page." OFFSET ".$offset;
		   $sql = "SELECT * from qq_story WHERE concat(`Name`,`NameOther`,`Content`,`story_Status`,`DateUpload`) like '%$kk%' ".$l;
		   
		   $r3 = mysqli_query($this->_conn,$sql);		
			
		
		
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
	function GetSliderAdmin($key,$per_page,$page,$type)
	{
		$l="";
		$offset = ($page - 1) * $per_page;
		if($type==0)
			$l="LIMIT ".$per_page." OFFSET ".$offset;
		   $sql = "SELECT a.Id,b.Name,a.Path from qq_slider a LEFT JOIN qq_story b ON a.IdStory=b.Id WHERE concat(b.Name,b.NameOther,b.Content,b.story_Status,b.DateUpload) like '%$key%' ".$l;
		   
		   $r3 = mysqli_query($this->_conn,$sql);		
			
		
		
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
	function GetReleaseAdmin($key,$per_page,$page,$type)
	{
		$l="";
		$offset = ($page - 1) * $per_page;
		if($type==0)
			$l="LIMIT ".$per_page." OFFSET ".$offset;
		   $sql = "SELECT a.Id,a.IdStory,b.Name,a.DateRelease,a.TimeRelease,a.NameChap from qq_release a LEFT JOIN qq_story b ON a.IdStory=b.Id WHERE concat(b.Name,b.NameOther,b.Content,b.story_Status,b.DateUpload) like '%$key%'".$l;
		   
		   $r3 = mysqli_query($this->_conn,$sql);		
			
		
		
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
	function GetChapAdmin($key,$per_page,$page,$type,$idStory)
	{
		$l="";
		$offset = ($page - 1) * $per_page;
		if($type==0)
			$l="LIMIT ".$per_page." OFFSET ".$offset;
		   $sql = "SELECT * from qq_chapter WHERE `IdStory`='$idStory' and concat(`Name`,`Notify`,`Summary`,`DateUpload`) like '%$key%' ".$l;
		   
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
	function GetFeedbackAdmin($key,$per_page,$page,$type)
	{
		$l="";
		$offset = ($page - 1) * $per_page;
		if($type==0)
			$l="LIMIT ".$per_page." OFFSET ".$offset;
		   $sql = "SELECT a.Id,a.Content,b.Name as NameStory,a.IdChap,a.DateInsert,a.CheckFinish from qq_feedback a,qq_story b WHERE a.IdStory=b.Id and CheckFinish='Chờ xử lý' and concat(b.Name,b.NameOther,a.CheckFinish,a.DateInsert) like '%$key%' ".$l;
		   
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
	function CountFeedbackAdmin()
	{
		
		   $sql = "SELECT * from qq_feedback where CheckFinish='Chờ xử lý'";
		   
		   $r3 = mysqli_query($this->_conn,$sql);		
		    return mysqli_num_rows($r3);        
	}
	
	function GetGenreAdmin($key,$per_page,$page,$type)
	{
		
		$kk=mysqli_real_escape_string($this->_conn, $key);
		$l="";
		$offset = ($page - 1) * $per_page;
		if($type==0)
			$l="LIMIT ".$per_page." OFFSET ".$offset;
		   $sql = "SELECT * from qq_genres WHERE concat(`Name`,`Title`) like '%$kk%' ".$l;
		   
		   $r3 = mysqli_query($this->_conn,$sql);		
			
		
		
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
	function UploadImageStory($idStory,$path)
	{
		    $query = "UPDATE qq_story SET `Path`='$path' WHERE Id='$idStory'";
			$result = mysqli_query($this->_conn, $query);
	}
	function UploadImageChap($path)
	{
		    $query = "UPDATE qq_users SET `Path`='$path' WHERE Email='$email'";
			$result = mysqli_query($this->_conn, $query);
	}
	function GetSliderStory()
	{
		$q = "SELECT * FROM qq_slider a, qq_story b WHERE a.IdStory=b.Id and a.hide_view=0 and b.hide_view=0  ORDER BY RAND() LIMIT 0,5";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function GetSliderByIdChap($Story)
	{
		
		$sql = "SELECT * FROM qq_chapter where IdStory='$Story' ORDER BY Id DESC LIMIT 1";
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
	
	function UpdateChapter($Name,$NameAnother,$Summary,$DateUpload,$IdStory)
	{
		$query = "select * from qq_chapter WHERE Name='$Name' and IdStory='$IdStory'";
		$result = mysqli_query($this->_conn, $query);
		$num_rows = mysqli_num_rows($result);
		if ($num_rows == 0)
		{
			$query = "INSERT INTO qq_chapter (`Name`, `NameAnother`,`Summary`,`DateUpload`,`IdStory`) VALUES ('$Name', '$NameAnother','$Summary','$DateUpload','$IdStory')";
			$result = mysqli_query($this->_conn, $query);	
		}
		
		
	}
	function GetCountChapter($IdStory)
	{
		
		$sql = "SELECT count(*) as Dem FROM qq_chapter where IdStory='$IdStory'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Dem"];
		}
        return $b;		
	}
	function GetCountComment($IdStory)
	{
		
		$sql = "SELECT count(*) as Dem FROM qq_comments where IdStory='$IdStory'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Dem"];
		}
        return $b;		
	}
	function GetNameStory2($Id)
	{
		
		$sql = "SELECT * FROM qq_story where Id='$Id' and hide_view=0";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Name"];
		}
        return $b;		
	}
	function GetNameChap2($Id)
	{
		
		$sql = "SELECT * FROM qq_chapter where Id='$Id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Name"];
		}
        return $b;			
	}
	function GetChapterFull($Id)
	{
		$q = "SELECT * FROM qq_chapter where IdStory='$Id'";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		$arr3=array();
		foreach($arr as $muc2)
		{	
			
			array_push($arr3,$muc2['Name']);
		}
		return $arr3;
	}
	
	function GetUrl1($Id)//truyenqq
	{
		
		$sql = "SELECT * FROM qq_story where Id='$Id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Url1"];
		}
        return $b;		
	}
	function GetUrl2($Id)//truyentranhtuan
	{
		
		$sql = "SELECT * FROM qq_story where Id='$Id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Url2"];
		}
        return $b;		
	}
	function UpdateChapters($IdStory,$Name,$Content)
	{		
		$query = "UPDATE qq_chapter SET `Path`='$Content' WHERE IdStory='$IdStory' and Name='$Name'";
		$result = mysqli_query($this->_conn, $query);
	}
	function UpdateContentChapters($IdStory,$Name,$Content)
	{
		$Content1=mysqli_real_escape_string($this->_conn,$Content);		
		$query = "UPDATE qq_chapter SET Content='$Content1' WHERE IdStory='$IdStory' and Name='$Name'";
		$result = mysqli_query($this->_conn, $query);
	}
	function GetLatest()
	{
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload ,a.DateUpload FROM qq_story a where a.hide_view=0  ORDER BY a.DateUpdate_Chap DESC LIMIT 42";
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}	
		return $arr;
	}
	function GetFemaleIndex()
	{
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload ,a.DateUpload FROM qq_story a where a.hide_view=0  ORDER BY a.Sum_Views DESC LIMIT 12";			
		mysqli_query($this->_conn, "SET SQL_BIG_SELECTS = 1");
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}	
		return $arr;
	}
	function GetMaleIndex()
	{		
		$sql="SELECT a.Male,a.NameUpdate_Chap,a.DateUpdate_Chap,a.Sum_Subscribe,a.Sum_Like,a.Sum_Views,a.Id,a.Name,a.ImgAvatar,a.Badge,a.Country,a.Genre,a.Content,a.story_Status,a.DateUpload ,a.DateUpload FROM qq_story a where a.hide_view=0 AND a.Male=1  ORDER BY a.DateUpdate_Chap DESC LIMIT 12";			
		mysqli_query($this->_conn, "SET SQL_BIG_SELECTS = 1");	
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}	
		return $arr;
	}
	function GetFemale($country,$status,$type,$item_per_page,$current_page)
	{
		$k="";
		
		$offset = ($current_page - 1) * $item_per_page;
		$sql = "SELECT * FROM qq_story where Female=1 ";
		
		if($country!=""){
		
				$k.=" or Country LIKE '%".$country."%'";
					
				
			}
		if($status!=""){
			$k.=" or story_Status LIKE '%".$status."%'";	
			
				
				
		}
		$sql6=$sql.$k;
		$sql=$sql.$k." ORDER BY DateUpdate_Chap LIMIT ".$item_per_page." OFFSET ".$offset;
	
		
		
		
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		$arr2=array();
		
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type=="total"){//trả vê tổng số dòng
		
			$r3 = mysqli_query($this->_conn,$sql6);		
			$arr3 = array();
		
		
			while($a3 = mysqli_fetch_array($r3,MYSQLI_ASSOC))
			{
				$arr3[] = $a3;
			}
		
		    return mysqli_num_rows($r3);
		}
			else
		return $arr;
	}
	function GetMale($country,$status,$type,$item_per_page,$current_page)
	{
		$k="";		
		$offset = ($current_page - 1) * $item_per_page;
		$sql = "SELECT * FROM qq_story where Male=1 ";
		
		if($country!=""){
		
				$k.=" and Country LIKE '%".$country."%'";
					
				
			}
		if($status!=""){
			$k.=" and story_Status LIKE '%".$status."%'";	
			
				
				
		}
		$sql6=$sql.$k;
		$sql=$sql.$k." ORDER BY DateUpdate_Chap LIMIT ".$item_per_page." OFFSET ".$offset;
	
		
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		$arr2=array();
		
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type=="total"){//trả vê tổng số dòng
		
			$r3 = mysqli_query($this->_conn,$sql6);		
			$arr3 = array();
		
		
			while($a3 = mysqli_fetch_array($r3,MYSQLI_ASSOC))
			{
				$arr3[] = $a3;
			}
		
		    return mysqli_num_rows($r3);
		}
			else
		return $arr;
	}
	function GetTitleGenre($id)//truyentranhtuan
	{
		
		$sql = "SELECT * FROM qq_genres where Id='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Title"];
		}
        return $b;		
		
	}
	function GetMetaSeoSort($nameEn)//truyentranhtuan
	{
		
		$sql = "SELECT * FROM qq_sort where NameEncode='$nameEn'";
		$result =mysqli_query($this->_conn, $sql);	
		
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Content_SEO"];
		}
        return $b;	
	}
	function GetMetaSeoFind()//truyentranhtuan
	{
		
		$sql = "SELECT * FROM qq_find where Id=1";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Content_CEO"];
		}
        return $b;		
	}
	function GetCountView($id)//truyentranhtuan
	{
		
		$sql = "SELECT COUNT(*) as countView FROM qq_viewsChap WHERE `IdStory` ='$id'";
		$result =mysqli_query($this->_conn, $sql);			
		$b="";
        $arr = array();
		
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["countView"];
		}
        return $b;	
	}
	// function GetCountSubscribe($id)//truyentranhtuan
	// {
		
		// $sql = "SELECT COUNT(*) as countSubscribe FROM `subscribe` WHERE `IdStory` ='$id'";
		// $result =mysqli_query($this->_conn, $sql);	
		
		// $a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        // $b= $a['countSubscribe'];	
        // return $b;	
	// }
	function GetCountChap($id)//truyentranhtuan
	{
		
		$sql = "SELECT COUNT(*) as countChap FROM qq_chapter WHERE `IdStory` ='$id'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["countChap"];
		}
        return $b;	
	}
	function GetSearchFull($keyword,$type,$item_per_page,$current_page)
	{
		$k=mysqli_real_escape_string($this->_conn,$keyword);
		$offset = ($current_page - 1) * $item_per_page;
		$sql = "SELECT * FROM qq_story where hide_view=0 and CONCAT(Name,NameOther,Author,story_Status,Country,DateUpload) like '%".$k."%'";
		
		
		//echo $sql;
		$sql6=$sql;
		$sql=$sql." LIMIT ".$item_per_page." OFFSET ".$offset;
	
		
		//echo $sql;
		
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		$arr2=array();
		
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		if($type=="total"){//trả vê tổng số dòng
		
			$r3 = mysqli_query($this->_conn,$sql6);		
			$arr3 = array();
		
		
			while($a3 = mysqli_fetch_array($r3,MYSQLI_ASSOC))
			{
				$arr3[] = $a3;
			}
		
		    return mysqli_num_rows($r3);
		}
			else
		return $arr;
	}
	function CheckNameChapter($idstory,$nameChap)
	{
		$sql = "select * from qq_chapter where Name='$nameChap' and IdStory='$idstory'";
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);		
		return $num;
	}
	function CheckNameGenre($name)
	{
		$sql = "select * from qq_genres where Name='$name'";
		$result =mysqli_query($this->_conn, $sql);	
		$num =0;
		$num = mysqli_num_rows($result);		
		return $num;
	}
	function GetImagePathChap($IdChapter,$IdStory)
	{
		$sql = "SELECT * from qq_chapter where Name='$IdChapter' and IdStory='$IdStory'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$a = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $b1= $a['Name'];//0	
		$b2= $a['Title'];//1	
		$b3= $a['Path'];//2	
		$b4= $a['Content'];//3	
		$b5= $a['Content_01'];//4
		$b6= $a['Content_02'];//5	
		$b7= $a['Content_03'];//6	
		$b8= $a['Content_04'];
		$b9= $a['Notify'];		
		$b10= $a['Summary'];		
		$b11= $a['DateUpload'];
		$b12= $a['IdStory'];						
		$c=array();
		
		array_push($c,$b1);//0
		array_push($c,$b2);//1
		array_push($c,$b3);//2
		array_push($c,$b4);//3
		array_push($c,$b5);//4
		array_push($c,$b6);//5
		array_push($c,$b7);//6
		array_push($c,$b8);//7
		array_push($c,$b9);//8
		array_push($c,$b10);//9
		array_push($c,$b11);//10
		array_push($c,$b12);//11
        return $c;	
	}
	function GetLevelUser($email){
		$sql = "SELECT * from qq_users where Email='$email'";
		$result =mysqli_query($this->_conn, $sql);	
		
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Level"];
		}
        return $b;			
	}	
	function UploadInfoUser($UID,$last_name,$first_name,$birthday,$phone,$Avatar,$gender,$password_old)
	{
			$p=mysqli_real_escape_string($this->_conn,$password_old);
		    $p2=SHA1($p);
		    $error="Cập nhật thât bại";
		    $sql="UPDATE qq_users SET LastName='$last_name',FirstName='$first_name',Birthday='$birthday',Phone='$phone',Gender='$gender',Path='$Avatar' WHERE Id='$UID' and Password='$p2'";
			mysqli_query($this->_conn, $sql);
            if(mysqli_affected_rows($this->_conn)==1)
			$error="Cập nhật thành công";
		
		return $error;
	}
	function UploadAvatarComment($email,$img)
	{
		    $sql="UPDATE qq_comments SET Avatar='$img' WHERE IdUser='$email' and Title='Thành Viên'";
			mysqli_query($this->_conn, $sql);
	}
	function UploadAvatarRelay($email,$img)
	{
			 $sql="UPDATE qq_replys SET Avatar='$img' WHERE IdUser='$email' and Title='Thành Viên'";
			mysqli_query($this->_conn, $sql);
	}
	function AddStory($Name,$NameOther,$Status,$Content,$Avatar,$Badge,$Waning,$Author,$Genre,$NameEncodeGenres,$Country,$DateUpload,$URL1,$URL2,$female,$male)
	{
		$Name1=mysqli_real_escape_string($this->_conn,$Name);
		$NameOther1=mysqli_real_escape_string($this->_conn,$NameOther);
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Author1=mysqli_real_escape_string($this->_conn,$Author);
		$error="Thêm thất bại";
			$sql="INSERT INTO qq_story (Name,NameOther,story_Status,Content,ImgAvatar,Badge,Waning,Author,Genre,NameEncodeGenres,Country,DateUpload,Url1,Url2,Female,Male) VALUES ('$Name1','$NameOther1','$Status','$Content1','$Avatar','$Badge','$Waning','$Author1','$Genre','$NameEncodeGenres','$Country','$DateUpload','$URL1','$URL2','$female','$male')";
			mysqli_query($this->_conn, $sql);	
		  if(mysqli_affected_rows($this->_conn)==1)
			$error="Thêm thành công";
		return $error;
	}
	function UpdateStory($Id,$Name,$NameOther,$Status,$Content,$Avatar,$Badge,$Waning,$Author,$Genre,$NameEncodeGenres,$Country,$URL1,$URL2,$female,$male)
	{
		$Name1=mysqli_real_escape_string($this->_conn,$Name);
		$NameOther1=mysqli_real_escape_string($this->_conn,$NameOther);
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Author1=mysqli_real_escape_string($this->_conn,$Author);
		     $error="Sửa thất bại";
$sql="UPDATE qq_story SET Name='$Name1',NameOther='$NameOther1',story_Status='$Status',Content='$Content1',ImgAvatar='$Avatar',Badge='$Badge',Waning='$Waning',Author='$Author1',Genre='$Genre',NameEncodeGenres='$NameEncodeGenres',Country='$Country',Url1='$URL1',Url2='$URL2',Female='$female',Male='$male' WHERE Id='$Id'";	
			mysqli_query($this->_conn, $sql);	          
			if(mysqli_affected_rows($this->_conn)==1)
			$error="Sửa thành công";
	
		
		return  $error;
	}
	function UpdateChapStory($Id,$Name)
	{
			$Name1=mysqli_real_escape_string($this->_conn,$Name);
		    $error="Sửa thất bại";
			$sql="UPDATE qq_story SET Name='$Name1' WHERE Id='$Id'";	
			mysqli_query($this->_conn, $sql);	          
			if(mysqli_affected_rows($this->_conn)==1)
			$error="Sửa thành công";
		return  $error;
	}
	function UpdateChapToStory($Id,$NameUpdate_Chap,$DateUpdate_Chap)
	{
			$sql="UPDATE qq_story SET NameUpdate_Chap='$NameUpdate_Chap',DateUpdate_Chap='$DateUpdate_Chap' WHERE Id='$Id'";	
			mysqli_query($this->_conn, $sql);	          		
	}
	function AddChap($Name,$Content,$Notify,$Summary,$DateUpload,$IdStory,$Path,$Content_01,$Content_02,$Content_03,$Content_04,$Title,$url1="")
	{
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Content_03_1=mysqli_real_escape_string($this->_conn,$Content_03);
		$Title1=mysqli_real_escape_string($this->_conn,$Title);
		$error="Thêm thất bại";
$sql="INSERT INTO qq_chapter (Name,Content,Notify,Summary,DateUpload,IdStory,Path,Content_01,Content_02,Content_03,Content_04,Title,url1) VALUES ('$Name','$Content1','$Notify','$Summary','$DateUpload','$IdStory','$Path','$Content_01','$Content_02','$Content_03_1','$Content_04','$Title1','$url1')";			
			mysqli_query($this->_conn, $sql);	
		   if(mysqli_affected_rows($this->_conn)==1)
			$error="Thêm thành công";
		return $error;
	}
	function UpdateChap($IdChap,$Name,$Content,$Content_03,$Summary,$IdStory,$Path,$Title,$DateUpload)
	{
		$Content1=mysqli_real_escape_string($this->_conn,$Content);
		$Content_03_1=mysqli_real_escape_string($this->_conn,$Content_03);
		$Title1=mysqli_real_escape_string($this->_conn,$Title);
		     $error="Sửa thất bại";
$sql="UPDATE qq_chapter SET Name='$Name',Content='$Content1',Content_03='$Content_03_1',Summary='$Summary',IdStory='$IdStory',Path='$Path',Title='$Title1',DateUpload='$DateUpload' WHERE Id='$IdChap'";
			mysqli_query($this->_conn, $sql);	
	        if(mysqli_affected_rows($this->_conn)==1)
			$error="Sửa thành công";
		 //$error=$sql;
		return  $error;
	}
	function UpdateChap3($IdChap,$IdStory,$url)
	{
		// $Content1=mysqli_real_escape_string($this->_conn,$Content);
		// $Content_03_1=mysqli_real_escape_string($this->_conn,$Content_03);
		// $Title1=mysqli_real_escape_string($this->_conn,$Title);
		     $error="Sửa thất bại";
$sql="UPDATE qq_chapter SET url1='$url' WHERE Name='$IdChap' and IdStory='$IdStory'";
			mysqli_query($this->_conn, $sql);	
	        if(mysqli_affected_rows($this->_conn)==1)
			$error="Sửa thành công";
		
		return  $error;
	}
	function GetSearchFind($keyword)
	{
		$k=mysqli_real_escape_string($this->_conn,$keyword);
		$sql = "select * from qq_story where hide_view=0 and CONCAT(Name,NameOther,Author,Country)  LIKE N'%$k%' LIMIT 20";
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}	
		return $arr;
	}
	function CheckLogin($email,$pass)
	{
		    $p=mysqli_real_escape_string($this->_conn,$pass);
		    $p2=SHA1($p);
		     $sql = "select * from qq_users where Email = '$email' and Password = '$p2' ";
			 $query = mysqli_query($this->_conn,$sql);		  
			 $num = mysqli_num_rows($query); 
			 $n="Mật khẩu sai";
				if($num>0){
					
					$n=1;
				}
				return $n;
	}
	function Register($email,$pass)
	{
		 $k=1;
		 $p=mysqli_real_escape_string($this->_conn,$pass);
		 $p2=SHA1($p);
		 $sql = "select * from qq_users where Email = '$email'";
			 $query = mysqli_query($this->_conn,$sql);		  
			 $num = mysqli_num_rows($query); 
			 $n=0;
				if($num<=0){
					$n=1;
					$_SESSION['email'] = $email;
					$query = "INSERT INTO qq_users (`Email`, `Password`,`Path`,`Gender`) VALUES ('$email', '$p2','upload/avatar/160x160/noavatar.png','$k')";
			        mysqli_query($this->_conn,$query);
					if(mysqli_affected_rows($this->_conn)==0)
					$n=-1;
				}
				return $n;
	}
	function AddComment($Content_main, $Avartar,$Name,$Title,$Likes,$DateComment,$IdChap,$IdStory,$IdUser)
	{
		
$sql="INSERT INTO qq_comments (Content,Avatar,Name,Title,Likes,DateComment,IdChap,IdStory,IdUser) VALUES ('$Content_main', '$Avartar','$Name','$Title','$Likes','$DateComment','$IdChap','$IdStory','$IdUser')";
				
			mysqli_query($this->_conn, $sql);
			$last_id = mysqli_insert_id($this->_conn);			
		return $last_id;
	}
	function GetComment($id){
		$sql = "SELECT * from qq_comments WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);


		$b=0;
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Likes"]+1;
		}
        return $b;	

	}
	function GetReplys($id){
		$sql = "SELECT * from qq_replys WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);			
		$b=0;
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Likes"]+1;
		}
        return $b;		
	}		
	function LikeComment($b,$id){
			$sql="UPDATE qq_comments SET Likes='$b' WHERE Id='$id'";
			mysqli_query($this->_conn, $sql);	
	}
	function LikeReplys($b,$id){
				    
			$sql="UPDATE qq_replys SET Likes='$b' WHERE Id='$id'";
			mysqli_query($this->_conn, $sql);	
	       
	}		
	function AddReplys($Content_main,$Avartar,$Name,$Title,$Likes,$DateRelay,$NameRelay1,$id2,$IdUser,$IdUserMain,$IdReply)
	{
		
			$sql="INSERT INTO qq_replys (Content,Avatar,Name,Title,Likes,DateReply,NameComment,IdComment,IdUser,IdUserMain,IdReply) VALUES ('$Content_main', '$Avartar','$Name','$Title','$Likes','$DateRelay','$NameRelay1','$id2','$IdUser','$IdUserMain','$IdReply')";	
			mysqli_query($this->_conn, $sql);
			$last_id = mysqli_insert_id($this->_conn);	
			return $last_id;
	}
	function AddNotify($Name,$IdStory,$IdUser,$IdUserMain,$DateRelay)
	{		
			$sql="INSERT INTO qq_notify (Name,IdStory,REmail,CEmail,DateUpload,Noti) VALUES ('$Name','$IdStory','$IdUser','$IdUserMain','$DateRelay',1)";
			mysqli_query($this->_conn, $sql);
	}
	function GetMaxComment(){
		$sql = "SELECT MAX(Id) as Id FROM qq_comments";
		$result =mysqli_query($this->_conn, $sql);			
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Id"];
		}
        return $b;		
	}
	function GetLimitComment($IdComment,$IdStory){
		$sql = "SELECT * FROM (SELECT * FROM qq_comments WHERE Id<'$IdComment' and IdStory='$IdStory' ORDER BY Id DESC LIMIT 5) a ORDER BY a.Id DESC";
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}	
		return $arr;
	}
	function GetReplysASC(){
		$sql = "SELECT * FROM qq_replys ORDER BY Id ASC";
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}	
		return $arr;
	}
	function GetListStoryForGenre($Genre){
		$sql = "SELECT * FROM qq_story where Genre like '%$Genre%'";
		//echo $sql;
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}	
		return $arr;
	}
	function DeleteComment($res2){
				    
			$sql="DELETE FROM qq_comments WHERE Id = '$res2'";
			mysqli_query($this->_conn, $sql);	
	       
	}
	function DeleteChapter($id){
				    
			$sql="DELETE FROM qq_chapter WHERE Id = '$id'";
			mysqli_query($this->_conn, $sql);	
	       
	}
	function DeleteReplyByIdComment($res2){
				    
			$sql="DELETE FROM qq_replys WHERE IdComment = '$res2'";
			mysqli_query($this->_conn, $sql);	
	       
	}
	function DeleteReplyByIdReply($tong){
				    
			$sql="DELETE FROM qq_replys WHERE IdReply = '$tong'";
			mysqli_query($this->_conn, $sql);	
	       
	}
	function DeleteReplyById($res2){
				    
			$sql="DELETE FROM qq_replys WHERE Id = '$res2'";
			mysqli_query($this->_conn, $sql);	
	       
	}
	function GetSumSubscribeStory($id)
	{
		    
		$sql = "SELECT * FROM qq_story WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);			
		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Sum_Subscribe"];
		}
        return $b;	      
	}
	function GetSumLikeStory($id)
	{
		$sql = "SELECT * FROM qq_story WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);	

		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Sum_Like"];
		}
        return $b;	

		
		
	}
	function GetSumViewsStory($id)
	{
		$sql = "SELECT * FROM qq_story WHERE Id='$id'";
		$result =mysqli_query($this->_conn, $sql);

		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Sum_Views"];
		}
        return $b;	
		
	}
	function UpdateViewChapStory($id,$i)
	{
		    $query = "UPDATE qq_story SET Sum_Views=Sum_Views+'$i' WHERE Id='$id'";
			$result = mysqli_query($this->_conn, $query);
	}
	function UpdateViewChapStory2($id)
	{
		    $query = "UPDATE qq_story SET Sum_Views=Sum_Views+1 WHERE Id='$id'";
			$result = mysqli_query($this->_conn, $query);
	}
	function UpdateSubscribeStory($id,$i)
	{
		    $query = "UPDATE qq_story SET Sum_Subscribe=Sum_Subscribe+'$i' WHERE Id='$id'";
			$result = mysqli_query($this->_conn, $query);
	}
	function UpdateLikeStory($id,$i)
	{
		    $query = "UPDATE qq_story SET Sum_Like=Sum_Like+'$i' WHERE Id='$id'";
			$result = mysqli_query($this->_conn, $query);
	}
	function GetSubscribe($email)
	{
		$b1="";
		$sql = "SELECT * FROM qq_subscribe WHERE Email='$email' ORDER BY Id DESC";
		$result =mysqli_query($this->_conn, $sql);
		if(mysqli_affected_rows($this->_conn)==0){
			$b1="@";
		}else{
			$arr = array();
			while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}		
			foreach($arr as $muc){
				$b1=$muc["Arr_IdStory"];
			}
       
		}
		return $b1;	
	}
	function GetLike($email)
	{
		$b1="";
		$sql = "SELECT * FROM qq_likes WHERE Email='$email'";
		$result =mysqli_query($this->_conn, $sql);
		if(mysqli_affected_rows($this->_conn)==0){
			$b1="@";
		}else{		
			$arr = array();
			while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$arr[] = $a;
			}		
			foreach($arr as $muc){
				$b1=$muc["Arr_IdStory"];
			}
		}
		return $b1;	
	}
	function GetHistory($email)
	{
		$sql = "SELECT * FROM qq_historys WHERE Email='$email' ORDER BY Id DESC";
		$result =mysqli_query($this->_conn, $sql);

		$b="";
        $arr = array();
		while($a = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}		
		foreach($arr as $muc){
			$b=$muc["Arr_IdStory"];
		}
        return $b;		
	}
	function AddSubscribe($email,$arr)
	{		
			$sql="INSERT INTO qq_subscribe (Email,Arr_IdStory) VALUES ('$email','$arr')";
			mysqli_query($this->_conn, $sql);
	}
	function UpdateSubscribe($email,$arr)
	{		
			$sql="UPDATE qq_subscribe SET Arr_IdStory='$arr' WHERE Email='$email'";
			mysqli_query($this->_conn, $sql);
	}
	function AddLike($email,$arr)
	{		
			$sql="INSERT INTO qq_likes (Email,Arr_IdStory) VALUES ('$email','$arr')";
			mysqli_query($this->_conn, $sql);
	}
	function UpdateLike($email,$arr)
	{		
			$sql="UPDATE qq_likes SET Arr_IdStory='$arr' WHERE Email='$email'";
			mysqli_query($this->_conn, $sql);
	}
	function AddHistory($email,$arr)
	{		
			$sql="INSERT INTO qq_historys (Email,Arr_IdStory) VALUES ('$email','$arr')";
			mysqli_query($this->_conn, $sql);
	}
	function UpdateHistory($email,$arr)
	{		
			$sql="UPDATE qq_historys SET Arr_IdStory='$arr' WHERE Email='$email'";
			mysqli_query($this->_conn, $sql);
	}
	function GetAdvertisement()
	{
		$sql = "SELECT * from qq_advertisement WHERE Id=1";
		$result = mysqli_query($this->_conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$Id=$row['Id'];
		$header1=$row['header1'];
		$link_header1=$row['link_header1'];		
		$header2=$row['header2'];
		$link_header2=$row['link_header2'];
		$content=$row['content'];
		$link_content=$row['link_content'];
		$left_ad=$row['left_ad'];
		$link_left=$row['link_left'];
		$footer1=$row['footer1'];//9
		$link_footer1=$row['link_footer1'];
		$footer2=$row['footer2'];
		$link_footer2=$row['link_footer2'];
		//
		$content_mobile=$row['content_mobile'];
		$link_content_mobile=$row['link_content_mobile'];
		//
		$left_mobile=$row['left_mobile'];
		$link_left_mobile=$row['link_left_mobile'];
		//
		$footer_mobile=$row['footer_mobile'];
		$link_footer_mobile=$row['link_footer_mobile'];
		$a=array();		
		array_push($a,$Id);//0
		array_push($a,$header1);//1
		array_push($a,$link_header1);//2
		array_push($a,$header2);//3
		array_push($a,$link_header2);//4
		array_push($a,$content);//5
		array_push($a,$link_content);//6
		array_push($a,$left_ad);//7
		array_push($a,$link_left);//8

		array_push($a,$footer1);//9
		array_push($a,$link_footer1);//10
		array_push($a,$footer2);//11
		array_push($a,$link_footer2);//12
		//	
		array_push($a,$content_mobile);//13
		array_push($a,$link_content_mobile);//14
		//		
		array_push($a,$left_mobile);//15
		array_push($a,$link_left_mobile);//16
		//
		array_push($a,$footer_mobile);//17
		array_push($a,$link_footer_mobile);//18			
        return $a;
	}
	
	function UpdateAdvertisement($header1,$link_header1,$header2,$link_header2,$content,$link_content,$left_ad,$link_left,$footer1,$link_footer1,$footer2,$link_footer2,$content_mobile,$link_content_mobile,$left_mobile,$link_left_mobile,$footer_mobile,$link_footer_mobile)
	{		
			$sql="UPDATE qq_advertisement SET header1='$header1',link_header1='$link_header1',header2='$header2',link_header2='$link_header2',content='$content',link_content='$link_content',left_ad='$left_ad',link_left='$link_left',footer1='$footer1',link_footer1='$link_footer1',footer2='$footer2',link_footer2='$link_footer2',content_mobile='$content_mobile',link_content_mobile='$link_content_mobile',left_mobile='$left_mobile',link_left_mobile='$link_left_mobile',footer_mobile='$footer_mobile',link_footer_mobile='$link_footer_mobile' WHERE Id=1";
			mysqli_query($this->_conn, $sql);
	}
	function UpdateLogo($logo,$logo_on,$favicon,$group)
	{		
			$sql="UPDATE qq_logo SET url_logo='$logo',url_logo_on='$logo_on',url_favicon='$favicon',url_group='$group' WHERE Id=1";
			mysqli_query($this->_conn, $sql);
	}
	function AddAuthors($name,$nameEncode)
	{
			$p=mysqli_real_escape_string($this->_conn,$name);
			$sql="INSERT INTO qq_authors (Name,NameEncode) VALUES ('$p','$nameEncode')";
			mysqli_query($this->_conn, $sql);
	}
	function ChangePassword($email,$password_new)
	{
			$p=mysqli_real_escape_string($this->_conn,$password_new);
		    $p2=SHA1($p);		
			$sql="UPDATE qq_users SET Password='$p2' WHERE Email='$email'";
			mysqli_query($this->_conn, $sql);
	}
	function AddSlider($IdStory,$Path)
	{		
			$sql="INSERT INTO qq_slider (IdStory,Path) VALUES ('$IdStory','$Path')";
			mysqli_query($this->_conn, $sql);
	}
	function AddGenre($Name_Genre,$NameEncode,$Title_Genre,$Type)
	{		
			$sql="INSERT INTO qq_genres (Name,NameEncode,Title,Type) VALUES ('$Name_Genre','$NameEncode','$Title_Genre','$Type')";
			mysqli_query($this->_conn, $sql);
	}
	function UpdateSlider($id,$IdStory,$Path)
	{		
			$sql="UPDATE qq_slider SET IdStory='$IdStory',Path='$Path' WHERE Id='$id'";
			mysqli_query($this->_conn, $sql);
	}
	function UpdateGenre($id,$Name,$NameEncode,$Title,$Type)
	{		
			$sql="UPDATE qq_genres SET Name='$Name',NameEncode='$NameEncode',Title='$Title',Type='$Type' WHERE Id='$id'";
			//echo $sql;
			mysqli_query($this->_conn, $sql);
	}
	function UpdateGenreForStory($id,$Genre,$NameEncodeGenres)
	{		
			$sql="UPDATE qq_story SET Genre='$Genre',NameEncodeGenres='$NameEncodeGenres' WHERE Id='$id'";
			//echo $sql;
			mysqli_query($this->_conn, $sql);
	}
	function DeleteSliderById($id){
				    
			$sql="DELETE FROM qq_slider WHERE Id = '$id'";
			mysqli_query($this->_conn, $sql);	
	       
	}
	function DeleteFeedbackById($id){
			$sql="UPDATE qq_feedback SET CheckFinish='Đã xử lý' WHERE Id='$id'";	    
			//$sql="DELETE FROM qq_feedback WHERE Id = '$id'";
			mysqli_query($this->_conn, $sql);	
	       
	}
	function DeleteGenreById($id){
			$sql="DELETE FROM qq_genres WHERE Id = '$id'";
			mysqli_query($this->_conn, $sql);		       
	}
	function GetTimeChap($id)
	{
		$sql = "SELECT * from qq_release where Id='$id'";
		$result = mysqli_query($this->_conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$NameChap=$row['NameChap'];
		$TimeRelease=$row['TimeRelease'];
		$Type=$row['Type'];
		$a=array();		
		array_push($a,$TimeRelease);
		array_push($a,$NameChap);
		array_push($a,$Type);		
        return $a;
	}
	function GetRelease()
	{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$date=date('Y-m-d');
		$sql = "SELECT * from qq_release a,qq_story b where a.IdStory=b.Id and a.DateRelease='$date'";
		$rr = mysqli_query($this->_conn,$sql);		
		$arr = array();
		while($a = mysqli_fetch_array($rr,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}	
		return $arr;
	}
	
	function AddRelease($IdStory,$time,$nameChap,$type)
	{

			  date_default_timezone_set("Asia/Ho_Chi_Minh");
			  $date=date('Y-m-d');
			 // $DateUpload1=date('H:i');
			$sql="INSERT INTO qq_release (IdStory,DateRelease,TimeRelease,NameChap,Type) VALUES ('$IdStory','$date','$time','$nameChap','$type')";
			mysqli_query($this->_conn, $sql);
	}
	function UpdateRelease($id,$IdStory,$time,$nameChap,$type)
	{
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$date=date('Y-m-d');
			$sql="UPDATE qq_release SET IdStory='$IdStory',DateRelease='$date',TimeRelease='$time',NameChap='$nameChap',Type='$type' WHERE Id='$id'";
			mysqli_query($this->_conn, $sql);
	}
	function GetNotify($email)
	{
		$q = "SELECT a.Id,b.Name,a.IdStory,a.Name AS NameNoti,a.DateUpload,a.Noti FROM qq_notify a,qq_story b WHERE a.IdStory=b.Id and a.REmail='$email' ORDER BY a.Id DESC";
		$r = mysqli_query($this->_conn,$q);		
		$arr = array();
		while($a = mysqli_fetch_array($r,MYSQLI_ASSOC))
		{
			$arr[] = $a;
		}
		return $arr;
	}
	function UpdateNotiRelay($id)
	{
			$sql="UPDATE qq_notify SET Noti=0 WHERE Id='$id'";
			mysqli_query($this->_conn, $sql);
	}
	function UpdatePass($email,$pass){
			$p=mysqli_real_escape_string($this->_conn,$pass);
		    $p2=SHA1($p);	
			$sql="UPDATE qq_users SET Password='$p2' WHERE Email='$email'";
			mysqli_query($this->_conn, $sql);	
	}
	function AddFeedback($content,$idStory,$idchap)
	{
		    date_default_timezone_set("Asia/Ho_Chi_Minh");
			$date=date('Y-m-d H:i:s');	
			$sql="INSERT INTO qq_feedback (Content,IdStory,IdChap,CheckFinish,DateInsert) VALUES ('$content','$idStory','$idchap','Chờ xử lý','$date')";				
			$k=mysqli_query($this->_conn, $sql);
			//$last_id = mysqli_insert_id($this->_conn);			
		return $k;
	}
	function UpdateHideViewStory($id,$className2)
	{
			$sql="UPDATE qq_story SET hide_view='$className2' WHERE Id='$id'";
			mysqli_query($this->_conn, $sql);
			$sql1="UPDATE qq_slider SET hide_view='$className2' WHERE IdStory='$id'";
			mysqli_query($this->_conn, $sql1);
			//echo $sql;
	}
	function CheckMailExist($email)
	{
		$sql = "select Id from qq_users where Email='$email'";
		$result =mysqli_query($this->_conn, $sql);	
		$num = mysqli_num_rows($result);	
		return $num;
	}
	// function LockTable($table1,$table2)
	// {
			// $sql="lock tables ".$table1."  read";		
			// mysqli_query($this->_conn, $sql);
			// $sql1="lock tables ".$table2."  read";		
			// mysqli_query($this->_conn, $sql1);

	// }
	// function UnLockTable($table1,$table2)
	// {
			// $sql="unlock tables ".$table1."  read";
			// mysqli_query($this->_conn, $sql);
			// $sql1="unlock tables ".$table2."  read";
			// mysqli_query($this->_conn, $sql1);

	// }
}
?>