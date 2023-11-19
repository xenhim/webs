
$(document).ready(function(){
	$("#changePassword").click(function(){
		var password_old=$("#password_old").val(); 
		var password_new=$("#password_new").val(); 
		var confirm_password_new=$("#confirm_password_new").val(); 		
	  $.ajax({     
	   url:'page/ajax/password/changePassword.php',
	   type:'POST',
	   cache:false,
	   data:{'password_old':password_old,'password_new':password_new,'confirm_password_new':confirm_password_new},
	   success:function(kq){
		   var o = JSON.parse(kq);
		       alert(o.Error);
		       location.reload();
			 }
	   })
		 
	});
});

