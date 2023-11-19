
$(document).ready(function(){
	$(".ads_close").click(function(){
	var ads_close="ads_close";
	  $.ajax({     
	   url:linkOption1+'ajax/qc/bn.php',
	   type:'POST',
	   cache:false,
	   data:{'type':ads_close},
	   success:function(kq){
		   //var o = JSON.parse(kq);
		   //console.log(o);
		       //location.reload();
			 }
	   })
		 
	});
	$(".popup_close").click(function(){
		var popup_close="popup_close";
	  $.ajax({     
	   url:linkOption1+'ajax/qc/bn.php',
	   type:'POST',
	   cache:false,
	   data:{'type':popup_close},
	   success:function(kq){
		   //var o = JSON.parse(kq);
		   //console.log(o);
		       //location.reload();
			 }
	   })
		 
	});
});

