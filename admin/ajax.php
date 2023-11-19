<?php
$Gender=$_POST['nameStory11'];
$targetPath="http://st.nettruyengo.com/data/comics/55/chiec-vay-cua-nguoi-ca.jpg";
$array=array("path"=>"$targetPath","path2"=>$targetPath,"temp"=>$Gender);
 echo json_encode($array);
?>