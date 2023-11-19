<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$var_popup_close="";
if(isset($_SESSION['ads_close']))
$var_popup_close=$_SESSION['ads_close'];
	
?>
<span id="bannerLeft"></span>
<script>
var banner8=<?php echo json_encode($banner[8])?>;
var banner7=<?php echo json_encode($banner[7])?>;
var popup_close_left=<?php echo json_encode($var_popup_close)?>;
var html_left="";
if(banner7 !=""){
if (window.matchMedia("(min-width: 1023px)").matches) {
	if(popup_close_left==""){
		html_left+='<div id="left-banner">';
		  html_left+='<div class="left-banner">';
			html_left+='<span class="ads_close">';
			  html_left+='<i class="fas fa-times"></i>';
			html_left+='</span>';
			html_left+='<a rel="nofollow" href="'+banner8+'" target="_blank">';
			  html_left+='<img src="'+banner7+'">';
			html_left+='</a>';
		  html_left+='</div>';
		html_left+='</div>';
	}
}
$(html_left).insertAfter("#bannerLeft"); 
}
</script>