<?php
function base64url_encode( $data ){
  return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
}
$idStory=$_POST['idStory'];
$name=$_POST['name'];
$content=base64url_encode($_POST['content']);
$site=$_POST['site'];
$Content_04=$_POST['Content_04'];
$link=base64url_encode($_POST['link']);
$Title=$_POST['Title'];

$array=array("idStory"=>"$idStory","name"=>"$name","content"=>"$content","site"=>"$site","Content_04"=>"$Content_04","link"=>"$link","Title"=>"$Title");

echo json_encode($array);

?>