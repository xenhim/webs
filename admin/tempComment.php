<?php
function search_arr($arr,$str){
  $flag=false;
  for($i=0;$i<count($arr);$i){
    if($arr[$i]==$str){
      $flag=true;
      break;
    }    
  }
  return $flag;
}
	$key=$_POST['key'];
	$tempChap="../page/upload/comment/data.txt";
	$myfile = fopen($tempChap, "r") or die("Unable to open file!");
	$name2="";
    if (filesize($tempChap) != 0){
       $name2= fread($myfile,filesize($tempChap));
    }
    $error="Thêm từ khóa thành công";
   
    	if($name2 !=""){
    	    
    	  $myfile2 = fopen($tempChap, "w") or die("Unable to open file!");
          fwrite($myfile2, $key.",".$name2);  
    	}else{
    	    $myfile2 = fopen($tempChap, "w") or die("Unable to open file!");
           fwrite($myfile2, $key); 
    	}
        fclose($myfile2);
       
    fclose($myfile);	
   	
	
	$array=array("Error"=>"$error");
	echo json_encode($array);

?>