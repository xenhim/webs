
$(document).ready(function(){
	$("#editBanner").click(function(){
		var header1=$("#header1").val(); 
		var link_header1=$("#link_header1").val(); 
		var header2=$("#header2").val(); 
		var link_header2=$("#link_header2").val(); 
		var content=$("#content").val(); 
		var link_content=$("#link_content").val(); 
		var left=$("#left").val(); 
		var link_left=$("#link_left").val(); 
		var footer1=$("#footer1").val(); 
		var link_footer1=$("#link_footer1").val(); 
		var footer2=$("#footer2").val(); 
		var link_footer2=$("#link_footer2").val();

		var content_mobile=$("#content_mobile").val(); 
		var link_content_mobile=$("#link_content_mobile").val(); 

		var left_mobile=$("#left_mobile").val(); 
		var link_left_mobile=$("#link_left_mobile").val();

		var footer_mobile=$("#footer_mobile").val(); 
		var link_footer_mobile=$("#link_footer_mobile").val();	
			
	  $.ajax({     
	   url:linkOption12+'ajax/qc/qc.php',
	   type:'POST',
	   cache:false,
	   data:{'header1':header1,'link_header1':link_header1,'header2':header2,'link_header2':link_header2,'content':content,'link_content':link_content,'left':left,'link_left':link_left,'footer1':footer1,'link_footer1':link_footer1,'footer2':footer2,'link_footer2':link_footer2,'content_mobile':content_mobile,'link_content_mobile':link_content_mobile,'left_mobile':left_mobile,'link_left_mobile':link_left_mobile,'footer_mobile':footer_mobile,'link_footer_mobile':link_footer_mobile},
	   success:function(kq){
		   var o = JSON.parse(kq);
		   console.log(o);
		       location.reload();
			 }
	   })
		 
	});
	$(".ads_close").click(function(){
		
		
	  $.ajax({     
	   url:linkOption12+'ajax/qc/qc.php',
	   type:'POST',
	   cache:false,
	   data:{'header1':header1,'link_header1':link_header1,'header2':header2,'link_header2':link_header2,'content':content,'link_content':link_content,'left':left,'link_left':link_left},
	   success:function(kq){
		   //var o = JSON.parse(kq);
		   //console.log(o);
		       location.reload();
			 }
	   })
		 
	});
	$(".popup_close").click(function(){
		
		
	  $.ajax({     
	   url:linkOption12+'ajax/qc/bn.php',
	   type:'POST',
	   cache:false,
	   data:{'header1':header1,'link_header1':link_header1,'header2':header2,'link_header2':link_header2,'content':content,'link_content':link_content,'left':left,'link_left':link_left},
	   success:function(kq){
		   //var o = JSON.parse(kq);
		   //console.log(o);
		       location.reload();
			 }
	   })
		 
	});
});

