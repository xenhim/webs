<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$var_popup_close="";
if(isset($_SESSION['popup_close']))
	$var_popup_close=$_SESSION['popup_close'];
?>
<span id="bannerContent"></span>
<script>
//popup quản cáo giữa trang
var popup_close=<?php echo json_encode($var_popup_close)?>;
var banner6=<?php echo json_encode($banner[6])?>;
var banner5=<?php echo json_encode($banner[5])?>;

$(document).ready(function(){
	var html_Content="";
	
if(banner5 !=""){	
if (window.matchMedia("(min-width: 1024px)").matches) {
	
	if (popup_close == "") {
    html_Content+='<div id="image_popup_background" class="popup_background" style="opacity: 0.7; visibility: visible; background-color: black; position: fixed; inset: 0px; z-index: 100000;"></div>';
	 html_Content+='<div id="image_popup_wrapper" class="popup_wrapper popup_wrapper_visible" style="opacity: 1; visibility: visible; position: fixed; overflow: auto; z-index: 100001; width: 100%; height: 100%; top: 0px; left: 0px; text-align: center; display: block;">';
	 html_Content+='<div id="image_popup" style="display: inline-block; opacity: 1; visibility: visible; text-align: left; position: relative; vertical-align: middle;" data-popup-initialized="true" class="popup_content" aria-hidden="false" role="dialog" tabindex="-1">';
	   html_Content+='<a rel="nofollow" target="_blank" class="image_close" href="'+banner6+'">';
		 html_Content+='<img alt="Quảng Cáo" src="'+banner5+'" style="width: 600px;">';
	   html_Content+='</a>'
	   html_Content+='<a rel="nofollow" href="#" class="popup_close"></a>';
	 html_Content+='</div>'
	 html_Content+='<div class="popup_align" style="display: inline-block; vertical-align: middle; height: 100%;"></div>';
	 html_Content+='</div>';
	}
}else{
	if (popup_close == "") {
	 html_Content+='<div id="image_popup_mobile_background" class="popup_background" style="opacity: 0.7; visibility: visible; background-color: black; position: fixed; inset: 0px; z-index: 100000;"></div>';
	 html_Content+='<div id="image_popup_mobile_wrapper" class="popup_wrapper popup_wrapper_visible" style="opacity: 1; visibility: visible; position: fixed; cursor: pointer; overflow: auto; z-index: 100001; width: 100%; height: 100%; top: 0px; left: 0px; text-align: center; display: block;">';
		 html_Content+='<div id="image_popup_mobile" style="display: inline-block; opacity: 1; visibility: visible; text-align: left; position: relative; vertical-align: middle;" data-popup-initialized="true" class="popup_content" aria-hidden="false" role="dialog" tabindex="-1">'
			 html_Content+='<a rel="nofollow" target="_blank" class="image_close_mobile" href="'+banner6+'">';
				 html_Content+='<img src="'+banner5+'" style="width: 300px;">';
			 html_Content+='</a>';
			 html_Content+='<a rel="nofollow" href="#" class="popup_close_mobile">Tắt</a>';
		 html_Content+='</div>';
		 html_Content+='<div class="popup_align" style="display: inline-block; vertical-align: middle; height: 100%;"></div>';
	 html_Content+='</div>';
	}
}
   $(html_Content).insertAfter("#bannerContent"); 
    $(".popup_close").click(function(){	  
		   $("#image_popup_background").remove();
		   $("#image_popup_wrapper").remove();
		   $("#image_popup").remove(); 
	});
    $(".popup_close_mobile").click(function(){
	  
		   $("#image_popup_mobile_background").remove();
		   $("#image_popup_mobile_wrapper").remove();
		   $("#image_popup_mobile").remove();
	});
   }
});
</script>

