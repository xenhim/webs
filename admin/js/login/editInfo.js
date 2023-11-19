$(document).ready(function(){ 
	  $("#editInfo").click(function(){
		  var UID=$("#UID").val();
		  var last_name=$("#last_name").val();
		  var first_name=$("#first_name").val();
		  var birthday=$("#birthday").val();
		  var phone=$("#phone").val();
		  var gender=1;	
		  var Avatar=$(this).attr("src-image");		  
			if (document.getElementById('gender2').checked) {
			  gender = 0;
			}			
		  var password_old=$("#password_old").val();
		   if(password_old !=""){
		   $.ajax({     
	       url:'page/ajax/login/editInfo.php',
	       type:'POST',
	       cache:false,
	       data:{'Email':Email,'UID':UID,'last_name':last_name,'first_name':first_name,'birthday':birthday,'phone':phone,'gender':gender,'Avatar':Avatar,'password_old':password_old},
	       success:function(kq){
	       	var o = JSON.parse(kq);
	             alert(o.Error);
					
						location.reload();
					
						
				  
	           }
	      })
		 }else{
			  alert("Chưa nhập mật khẩu");
		 }
		  
	 });
});