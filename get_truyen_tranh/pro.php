<?php

function TurnOnProgress(){
    
    $myfile1 = fopen("temp.txt", "w") or die("Unable to open file!");
    fwrite($myfile1, 1);
    fclose($myfile1);
}
function TurnOffProgress(){
    
    $myfile1 = fopen("temp.txt", "w") or die("Unable to open file!");
    fwrite($myfile1, 0);
    fclose($myfile1);
}
function CheckProgress(){
  $temp="temp.txt";
  $myfile = fopen($temp, "r") or die("Unable to open file!");
  if (filesize($temp) != 0){
   $name= fread($myfile,filesize($tempChap));
   fclose($myfile);
   return $name;
  }
}
?>