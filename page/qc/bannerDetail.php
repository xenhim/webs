<span id="bannerDetail"></span>
<script>
var banner13=<?php echo json_encode($banner[13])?>;
var banner14=<?php echo json_encode($banner[14])?>;
var html="";
if(banner13!=""){
if (window.matchMedia("(max-width: 1023px)").matches) {
	html+='<div style="text-align: center; margin-bottom: 10px;">';
		html+='<a rel="nofollow" href="'+banner14+'" target="_blank">';
			html+='<img src="'+banner13+'">';
		html+='</a>';
	html+='</div>';
	}
}

$(document).ready(function(){
	$(html).insertAfter("#bannerDetail");
});		
</script>		
