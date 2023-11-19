<span id="bannerFooterTopChap"></span>
<script>
//popup quản cáo giữa trang
var banner17=<?php echo json_encode($banner[17])?>;
var banner18=<?php echo json_encode($banner[18])?>;
var html_FooterTopChap="";
$(document).ready(function(){
	if(banner17==""){
		if (window.matchMedia("(max-width: 1023px)").matches) {
			html_FooterTopChap+='<div style="margin-top: 30px; text-align: center; margin-bottom: 5px;">';
				html_FooterTopChap+='<a rel="nofollow" href="'+banner18+'" target="_blank">';
					html_FooterTopChap+='<img src="'+banner17+'" alt="Quảng Cáo">';
				html_FooterTopChap+='</a>';
			html_FooterTopChap+='</div>';
		}
		$(html_FooterTopChap).insertAfter("#bannerFooterTopChap"); 
   }

});
</script>
