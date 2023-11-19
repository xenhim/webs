<?php

if(isset($_POST['tempChap']))
 unlink($_POST['tempChap']);
else 
unlink($_POST['tempStory']);
	
?>