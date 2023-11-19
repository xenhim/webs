<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$bc_full_temp="";
if(isset($bc_full))
$bc_full_temp=$bc_full;	
$bc_mobile_1="bottom";
if(isset($bc_mobile))
$bc_mobile_1="top";


?>
<span id="bannerHeader"></span>
<script>
//popup quản cáo giữa trang
var bc_full_temp=<?php echo json_encode($bc_full_temp)?>;
var bc_mobile_1=<?php echo json_encode($bc_mobile_1)?>;
var banner4=<?php echo json_encode($banner[4])?>;
var banner3=<?php echo json_encode($banner[3])?>;
var banner2=<?php echo json_encode($banner[2])?>;
var banner1=<?php echo json_encode($banner[1])?>;
var banner15=<?php echo json_encode($banner[15])?>;
var banner16=<?php echo json_encode($banner[16])?>;
$(document).ready(function(){
	var html_Header="";
	
	if(banner1 !="" || banner3 !="" || banner15 !=""){
if (window.matchMedia("(min-width: 1025px)").matches) {
	/*
	html_Header+='<div class="pc-banner'+bc_full_temp+'">';
		html_Header+='<a href="'+banner2+'" rel="nofollow" target="_blank" title="Nhà cái cá cược bóng đá one88" alt="Nhà cái cá cược thể thao one88">';
			html_Header+='<img src="'+banner1+'" style="width: 49%;">';
		html_Header+='</a>';	
		html_Header+='<a rel="nofollow" target="_blank" href="<?=$banner[4]?>">';
			html_Header+='<img src="'+banner3+'" style="width: 49%;">';
		html_Header+='</a>';
	html_Header+='</div>';	*/
}else{
	/*
	html_Header+='<div id="ads_mobile" class="catfish-'+bc_mobile_1+'-mobile">';
		html_Header+='<span class="out-ads">';
		html_Header+='<span class="ads_close_mobile"><i class="fas fa-times"></i></span>';
		html_Header+='<a title="game bài V8" alt="game bài đổi thưởng V8" rel="nofollow" href="'+banner16+' target="_blank">';
			html_Header+='<img src="'+banner15+'">';
		html_Header+='</a>';
		html_Header+='</span>';
	html_Header+='</div>';
	html_Header+='<div class="mobile-banner">';
		html_Header+='<div class="mobile-banner-item">';
			html_Header+='<a title="game bài V8" alt="game bài đổi thưởng V8" rel="nofollow" href="'+banner2+'" target="_blank">';
				html_Header+='<img src="'+banner1+'">';
			html_Header+='</a>';
		html_Header+='</div>';
		html_Header+='<div class="mobile-banner-item" style="margin-top: 10px;">';
			html_Header+='<a href="'+banner4+'" rel="nofollow" target="_blank" title="Nhà cái cá cược bóng đá one88" alt="Nhà cái cá cược thể thao one88">';
				html_Header+='<img src="'+banner3+'">';
			html_Header+='</a>';
		html_Header+='</div>';
	html_Header+='</div>';*/
	 
}
	$(html_Header).insertAfter("#bannerHeader"); 
}	

});
</script>



