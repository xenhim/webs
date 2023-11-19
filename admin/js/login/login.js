$(document).ready(function(){ 
	
		
	
	  $("#button_login2").click(function(){
		  var email_login=$("#email_login").val();
		  var password_login=$("#password_login").val();
		 
		   $.ajax({     
	       url:type_new+'page/ajax/login/login.php',
	       type:'POST',
	       cache:false,
	       data:{'email_login':email_login,'password_login':password_login},
	       success:function(kq){
	       	var o = JSON.parse(kq);
	             //console.log(kq);
					if(o.success==1){
						location.reload();
					}else
						alert("Email hoặc mật khẩu sai!!!");
				  
	           }
	      })
		  
	 }); 
	 $(".message").click(function(){
		$(".notify").removeClass("unread");
		 var id=$(this).attr("noti-data-id");
		 
		   $.ajax({     
	       url:type_new+'page/ajax/comment/updateNoti.php',
	       type:'POST',
	       cache:false,
	       data:{'id':id},
	       success:function(kq){
	       
					//console.log(kq);
				  
	           }
	      })
		  
	 }); 
	 $("#button_register").click(function(){
		
		  var email_register=$("#email_register").val();
		  var password_register=$("#password_register").val();
		  var captcha_register=$("#captcha_register").val();
		  var refresh_captcha3=refresh_captcha1;
		  if(refresh_captcha3==captcha_register){
		  captcha_register=$("#captcha_register").val();
		   $.ajax({     
	       url:type_new+'page/ajax/login/register.php',
	       type:'POST',
	       cache:false,
	       data:{'email_register':email_register,'password_register':password_register},
	       success:function(kq){
	       	var o = JSON.parse(kq);
	             
					if(o.success==1){
						location.reload();
					}else if(o.success==0){
						  refresh_captcha1=Math.floor(Math.random()*90000) + 10000;
						  //refresh_captcha2=Math.floor(Math.random() * 10);
						  $("#refresh_captcha").text(refresh_captcha1);
						 alert("Email đã được sử dụng!!!");
					}else{
						 refresh_captcha1=Math.floor(Math.random()*90000) + 10000;
						 //refresh_captcha2=Math.floor(Math.random() * 10);
						 $("#refresh_captcha").text(refresh_captcha1);
						 alert("Lỗi đăng ký!!!");
					}
				  
	           }
	      })
		  }else{
			 alert("Sai captcha!!!"); 
			 refresh_captcha1=Math.floor(Math.random()*90000) + 10000;
			// refresh_captcha2=Math.floor(Math.random()*90000) + 10000;
			 $("#refresh_captcha").text(refresh_captcha1);
		  }
		  
	 });
	 $("#button-forgot").click(function(){
		   $("#button-forgot").text("Đang gửi mật khẩu...");		
	       $('#button-forgot').prop("disabled", true); 
		   var email_forgot=$("#email-forgot").val();
		   
		   if(email_forgot !=""){
		   $.ajax({     
	       url:type_new+'page/ajax/login/forgotPass.php',
	       type:'POST',
	       cache:false,
	       data:{'email_forgot':email_forgot},
	       success:function(kq){
			   
	       	    var o = JSON.parse(kq);
	              if(o.success<1){
					alert("Email không tồn tại!!!");  
				  }else if(o.success==1.5)
				  {
				      alert("Lỗi gửi mail vui lòng thử lại");  
				  }
				  else{
					$(".forget-password-section").addClass("hidden");
					$(".sent-password-section").removeClass("hidden");
				  }
				   $("#button-forgot").text("Gửi mật khẩu");		
	               $('#button-forgot').prop("disabled", false); 
	           }
	      })
		   }else{
		       
		       alert("Vui lòng nhập mail!!!");
		        $("#button-forgot").text("Gửi mật khẩu");		
	            $('#button-forgot').prop("disabled", false); 
		   }
		  
	 }); 	
	// $("#email_register").keypress(function(event) {
        // if (event.keyCode == 13) {
			// alert("sfsd");
          // document.getElementById("button_login2").click();
        // }
    // });
	// $("#password_register").keypress(function(event) {
        // if (event.keyCode == 13) {
          // document.getElementById("button_register").click();
        // }
    // });
	$("#button_logout").click(function(){
		
		
		   $.ajax({     
	       url:type_new+'page/ajax/login/logout.php',
	       type:'POST',
	       cache:false,
	       //data:{'email_register':email_register,'password_register':password_register},
	       success:function(kq){	       
				location.reload();
				
				window.location.assign(type_new);
	           }
	      })
		  
	 }); 
	 var s = null;
	 
	 $(".text-search").keyup(function(){
		   var txtsearch  = $(this).val();
		   var t2=$(".text-search").attr("input-Link");//
			$.ajax({     
			   url:type_new+'page/ajax/page/timkiem.php',
			   type:'POST',
			   cache:false,
			   data:{'txtsearch':txtsearch},
			   success:function(kq){
							var o = JSON.parse(kq);							
							var a1=o.Id;
							var a2=o.Name;
							var a3=o.NameOther;
							var a4=o.ImgAvatar;
							var a5=o.NameChap;
							var a6=o.NameEncode;
							
							var b1=JSON.parse(a1);
							var b2=JSON.parse(a2);
							var b3=JSON.parse(a3);
							var b4=JSON.parse(a4);
							var b5=JSON.parse(a5);
						    var b6=JSON.parse(a6);
							$(".list-results").addClass("open");
							 var html="";
							
							   if(b1.length==0){
								   html+="<div class='no-result' style='padding: 10px'>Không Tìm Thấy Kết Quả Nào!</div>";
							   }else{
											 for(var i=0;i<b1.length;i++){
												 html+="<div class='list-container'>";
													 html+="<div class='result-item'>";
														 html+="<a href='"+t2+"truyen-tranh/"+b6[i]+"-"+b1[i]+"'>";
															 html+="<div class='media'>";
																 html+="<figure class='media-left'>";
																	 html+="<p class='image'>";
																		 html+="<img src='"+t2+"page/"+b4[i]+"' alt='"+b2[i]+"'>";
																	 html+="</p>";
																 html+="</figure>";
																 html+="<div class='media-content'>";
																	 html+="<h4>"+b2[i]+"</h4>";
																	 html+="<h5>"+b3[i]+"</h5> <h6>"+b5[i]+"</h6>";
																 html+="</div>";
															 html+="</div>";
														 html+="</a>";
													 html+="</div>";
												 html+="</div>";
											 }
							   }
							$(".list-results").html(html);
		   
							
				   }
			   })
	});
	  
	$(".text-search").focus(function(){
		$(".list-results").addClass("open");
	});
	$(".text-search").focusout(function(){
		$(".list-results").removeClass("open");
		
	});
	$(".btn_search").click(function(){
		var t1=$(".btn_search").attr("button-Link");//
		 var txtsearch  = $(".text-search").val();
		 if(txtsearch !="")
		 window.location.href=t1+"tim-kiem.html?q="+txtsearch;
	});
	$(".text-search").keypress(function(e){
		 
		 if(e.which == 13) {
			var t2=$(".text-search").attr("input-Link");//
			var txtsearch  = $(".text-search").val();
			if(txtsearch !="")
			window.location.href=t2+"tim-kiem.html?q="+txtsearch;
		}
	});

});