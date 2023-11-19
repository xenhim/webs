
$(document).ready(function(){
	$("#editLogo").click(function(){
		var logo=$("#logo").val(); 
		var logo_on=$("#logo_on").val(); 
		var favicon=$("#favicon").val(); 
		var group=$("#group").val(); 

	
	  $.ajax({     
	   url:linkOption12+'ajax/logo/logo.php',
	   type:'POST',
	   cache:false,
	   data:{'logo':logo,'logo_on':logo_on,'favicon':favicon,'group':group},
	   success:function(kq){
		   //var o = JSON.parse(kq);
		   console.log(kq);
		       location.reload();
			 }
	   })
		 
	});
	
	
});

