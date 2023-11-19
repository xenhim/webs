<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "truyenqq";

$c=$_POST['c'];
$id=$_POST['id'];
$like=$_POST['like'];
$temp=0;
if(isset($_SESSION['user'])==""){
	$_SESSION['user'] =array();
	array_push($_SESSION['user'],$like);
}else if(isset($_SESSION['user'])!=""){
	for($i=0;$i<count($_SESSION['user']);$i++){
		if($_SESSION['user'][$i]==$like){
			$temp=1;
			break;
		}
	}
	if($temp==0){
		array_push($_SESSION['user'],$like);
	}
}
$conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, 'UTF8');
	$b=0;
	if($temp==0){
		if($c=="c"){
			$sql1 = "SELECT * from comments WHERE Id='$id'";
			$result1 =mysqli_query($conn, $sql1);	
			
			$a = mysqli_fetch_array($result1,MYSQLI_ASSOC);
			$b= $a['Likes']+1;	
			
			  $sql = "UPDATE comments SET Likes='$b' WHERE Id='$id'";
			  $result = mysqli_query($conn, $sql);
		}else if($c=="r"){
				$sql1 = "SELECT * from replys WHERE Id='$id'";
			$result1 =mysqli_query($conn, $sql1);	
			
			$a = mysqli_fetch_array($result1,MYSQLI_ASSOC);
			$b= $a['Likes']+1;
				
			  $sql = "UPDATE replys SET Likes='$b' WHERE Id='$id'";
			  $result = mysqli_query($conn, $sql);
		}
	}
	   
	   	   	  
		
	//$sql = "UPDATE comments SET Likes='Doe' WHERE Id=2";
	//

$array=array("like"=>"$like","temp"=>"$temp","increase"=>"$b");
   	
echo json_encode($array);

?>