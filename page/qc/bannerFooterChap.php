<span id="bannerFooterChap"></span>
<script>
//popup quản cáo giữa trang
var banner12=<?php echo json_encode($banner[12])?>;
var banner11=<?php echo json_encode($banner[11])?>;
var banner10=<?php echo json_encode($banner[10])?>;
var banner9=<?php echo json_encode($banner[9])?>;
var html_FooterChap="";

  


$(document).ready(function(){
  
    if(banner11 =="" ) {  
	/* if (window.matchMedia("(min-width: 1025px)").matches) {
		html_FooterChap+='<div style="text-align: center; margin: 10px auto; height: 260px; position: relative; width: 680px;">';
			html_FooterChap+='<div style="border: 1px solid #FFF; text-align: center; background-color: #E9E8E8; width: 300px; height: 252px; display: inline-block;">';
				html_FooterChap+='<a rel="nofollow" href="'+banner10+'" target="_blank">';
					html_FooterChap+='<img src="'+banner9+'" alt="Quảng Cáo" style="width: 300px; height: 250px;">';
				html_FooterChap+='</a>';
			html_FooterChap+='</div>';
			html_FooterChap+='<div style="border: 1px solid #FFF; text-align: center; background-color: #E9E8E8; width: 300px; height: 252px; display: inline-block;">';
				html_FooterChap+='<a rel="nofollow" href="'+banner10+'" target="_blank">';
					html_FooterChap+='<img src="'+banner9+'" alt="Quảng Cáo" style="width: 300px; height: 250px;">';
				html_FooterChap+='</a>';
			html_FooterChap+='</div>';
		html_FooterChap+='</div>';
 	 }*/
    }/*else if(banner9 ==""){
      if (window.matchMedia("(min-width: 1025px)").matches) {
		html_FooterChap+='<div style="text-align: center; margin: 10px auto; height: 260px; position: relative; width: 680px;">';
			html_FooterChap+='<div style="border: 1px solid #FFF; text-align: center; background-color: #E9E8E8; width: 300px; height: 252px; display: inline-block;">';
				html_FooterChap+='<a rel="nofollow" href="'+banner12+'" target="_blank">';
					html_FooterChap+='<img src="'+banner11+'" alt="Quảng Cáo" style="width: 300px; height: 250px;">';
				html_FooterChap+='</a>';
			html_FooterChap+='</div>';
			html_FooterChap+='<div style="border: 1px solid #FFF; text-align: center; background-color: #E9E8E8; width: 300px; height: 252px; display: inline-block;">';
				html_FooterChap+='<a rel="nofollow" href="'+banner12+'" target="_blank">';
					html_FooterChap+='<img src="'+banner11+'" alt="Quảng Cáo" style="width: 300px; height: 250px;">';
				html_FooterChap+='</a>';
			html_FooterChap+='</div>';
		html_FooterChap+='</div>';
 	 }  
    }*//*else{
      if (window.matchMedia("(min-width: 1025px)").matches) {
		html_FooterChap+='<div style="text-align: center; margin: 10px auto; height: 260px; position: relative; width: 680px;">';
			html_FooterChap+='<div style="border: 1px solid #FFF; text-align: center; background-color: #E9E8E8; width: 300px; height: 252px; display: inline-block;">';
				html_FooterChap+='<a rel="nofollow" href="'+banner10+'" target="_blank">';
					html_FooterChap+='<img src="'+banner9+'" alt="Quảng Cáo" style="width: 300px; height: 250px;">';
				html_FooterChap+='</a>';
			html_FooterChap+='</div>';
			html_FooterChap+='<div style="border: 1px solid #FFF; text-align: center; background-color: #E9E8E8; width: 300px; height: 252px; display: inline-block;">';
				html_FooterChap+='<a rel="nofollow" href="'+banner12+'" target="_blank">';
					html_FooterChap+='<img src="'+banner11+'" alt="Quảng Cáo" style="width: 300px; height: 250px;">';
				html_FooterChap+='</a>';
			html_FooterChap+='</div>';
		html_FooterChap+='</div>';
 	 }  
    }*/
	$(html_FooterChap).insertAfter("#bannerFooterChap");
		
});
</script>
