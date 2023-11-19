
function setCookie(cname,cvalue,exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  // var user=getCookie("username");
  // if (user != "") {
    // alert("Welcome again " + user);
  // } else {
     // user = prompt("Please enter your name:","");
     // if (user != "" && user != null) {
       // setCookie("username", user, 30);
     // }
  // }
}
var IdStory=m2;
var IdUser=m;
$(document).ready(function(){	
	    load_comments1();  		
	 	$("#submit_comment-id").click(function(){	
	 	
	 	var d = new Date();
	 	var Content=$("#content_comment").val();
	 	var Avartar="frontend/images/noavatar.png";
		var Name=$("#name_comment").val();
		//var qq=0;
		//o.Title=="Ẩn Danh"?"<span class='title-user-comment title-hidden'>"+o.Title+"</span>":"<span class='title-user-comment title-member'>"+o.title+"</span>";
		//alert(qq);
		//var Title="Ẩn Danh";
		var Title="Ẩn Danh";
		var Likes=0;
		//var DateComment=d.getFullYear();
		var IdChap=2;
		
		
		if(m!=0){
			
			Title="Thành Viên";
		}
		  // var n = $(this).parent().find("textarea").data("id");
          //var i = $(this).parent().find("textarea").data("parent");
		  var flac_coment=0;
		  if(Content==""){
			  flac_coment=1;
			  alert("Vui lòng nhập nội dung bình luận.");
		  }else if(Name==""){
			  flac_coment=1;
			  alert("Vui lòng nhập tên của bạn.");
		  }
	 	 if(flac_coment==0){
	 	     
	 	     //let names = ['yusuf', 'yukh', 'bayrakdar'];
             //let searchValue = 'yu';
             //result = names.filter(name => name.includes(searchValue.toLowerCase()));
	 	 $.ajax({     
	       url:linkOption1+'ajax/comment/binhluan.php',
	       type:'POST',
	       cache:false,
	       data:{'Content':Content,'Avartar':Avartar,'Name':Name,'Title':Title,'Likes':Likes,'IdChap':IdChap,'IdStory':IdStory,'IdUser':IdUser},
	       success:function(kq){
			   $("#content_comment").val("");
			  
	       	var o = JSON.parse(kq);
			var Title1="";
		   if(o.Title=="Ẩn Danh"){
			   Title1="<span class='title-user-comment title-hidden'>"+o.Title+"</span>";
			    $("#tam-thoi").after("<div id='comment-form-levels"+o.Id+"' class='comment-main-replys'><article class='info-comment child_"+o.Id+" parent_0 comment-main-level' id='c"+o.Id+"'><div class='outsite-comment comment-main-level'><figure class='avartar-comment'><img src='"+o.Avartar+"' alt='"+o.Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+o.Name+"</strong>"+Title1+"<span class='time'>"+o.DateComment+"</span></div><div class='content-comment'><strong></strong>"+o.Content+"</div></div><div class='action-comment'><span  class='like-comment' data-id='lc"+o.Id+"'><i class='fas fa-thumbs-up'></i><span id='lc"+o.Id+"' class='total-like-comment' data-like='c"+o.Id+"'>"+o.Likes+"</span></span><span class='reply-comment' data-parent='0' aa00='0' aa0='c"+o.Id+"' aa4='"+o.Id+"' aa5='"+o.Name+"' aa6='"+o.Id+"' email='"+o.IdUser+"'><i class='far fa-comment'></i> Trả lời</span></div></div></div></article></div>");
	        
		   }else if(o.Title=="Thành Viên"){
			   Title1="<span class='title-user-comment title-member'>"+o.Title+"</span>";
			    $("#tam-thoi").after("<div id='comment-form-levels"+o.Id+"' class='comment-main-replys'><article class='info-comment child_"+o.Id+" parent_0 comment-main-level' id='c"+o.Id+"'><div class='outsite-comment comment-main-level'><figure class='avartar-comment'><img src='"+o.Avartar+"' alt='"+o.Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+o.Name+"</strong>"+Title1+"<span class='time'>"+o.DateComment+"</span></div><div class='content-comment'><strong></strong>"+o.Content+"</div></div><div class='action-comment'><span  class='like-comment' data-id='lc"+o.Id+"'><i class='fas fa-thumbs-up'></i><span id='lc"+o.Id+"' class='total-like-comment' data-like='c"+o.Id+"'>"+o.Likes+"</span></span><span class='reply-comment' data-parent='0' aa00='0' aa0='c"+o.Id+"' aa4='"+o.Id+"' aa5='"+o.Name+"' aa6='"+o.Id+"' email='"+o.IdUser+"'><i class='far fa-comment'></i> Trả lời</span><span class='remove_comnent'  data-bookid='c"+o.Id+"' title='Xoá'><i class='fa fa-trash' aria-hidden='true'></i> Xoá</span></div></div></div></article></div>");
	        
		   }else{
		       
		       $("#content_comment").val("");
		   }
           //$("#tam-thoi").after("<div id='comment-form-levels"+o.Id+"'><article class='info-comment child_"+o.Id+" parent_0 comment-main-level' id='c"+o.Id+"'><div class='outsite-comment comment-main-level'><figure class='avartar-comment'><img src='"+o.Avartar+"' alt='"+o.Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+o.Name+"</strong>"+Title1+"<span class='time'>"+o.DateComment+"</span></div><div class='content-comment'><strong></strong>"+o.Content+"</div></div><div class='action-comment'><span class='like-comment' data-id='"+o.Id+"'><i class='fas fa-thumbs-up'></i> <span class='total-like-comment'>"+o.Likes+"</span></span><span class='reply-comment' data-parent='0' aa00='0' aa0='c"+o.Id+"' aa4='"+o.Id+"' aa5='"+o.Name+"' aa6='"+o.Id+"'><i class='far fa-comment'></i> Trả lời</span></div></div></div></article></div>");
              
				}
	       }).done(function(e) {
                 $(".content-comment").readmore({
                    maxHeight: 105,
                    speed: 100,
                    moreLink: '<p class="readmore"><a href="#">Xem Thêm</a></p>',
                    lessLink: '<p class="readmore"><a href="#">Rút Gọn</a></p>',
                    embedCSS: !0,
                    sectionCSS: "display: block; width: 100%;",
                    startOpen: !1,
                    expandedClass: "readmore-js-expanded",
                    collapsedClass: "readmore-js-collapsed"
                })
            });
		 }
	 
	});
	var emoji_1_2="#id_textarea";	 
	$("#emoji_1").click(function(){
		
		 emoji_1_2="#id_textarea";
			//alert(1);		 
	});
	$(".list-comment").on('click', '#emoji_2', function() {
	//$("#emoji_2").click(function(){
		 emoji_1_2="#id_textarea_s";
			//alert(2);
	});
	$(".list-comment").on('click', '.reply-comment', function() {
		
		 
		 $(".reply-ccc").remove();	
		 var NameRelay1=$(this).attr("aa5");//
		 var id2=$(this).attr("aa6");//
		 var Id=$(this).attr("aa0");//
		 var id3=$(this).attr("email");
	
	   	 $("#"+Id).after("<div class='form-comment reply_comment reply_"+Id+" reply-ccc' ><div class='message-content'><div class='input-comment'><span class='col-md-6 col-sm-6 col-xs-12 text-center'><input  class='input' id='name_comments' type='text' placeholder='Họ tên' value='"+name_comment+"'></span><span class='col-md-6 col-sm-6 col-xs-12 text-center'><input  class='input' id='email_comments' type='email' placeholder='Email' value='"+m+"'></span></div><div class='mess-input'><textarea class='textarea' placeholder='Nội dung bình luận' id='content_comment_s'></textarea><button id='emoji_2' type='submit' class='click_emoji'></button><button type='submit' class='submit_comment' aa00='0' aa0='"+Id+"' aa4='"+Id+"' aa5='"+NameRelay1+"' aa6='"+id2+"' email='"+id3+"'></button></div></div></div>");
		 //$("#content_comment_s").focus();
		 $("#content_comment_s").focus();
		 //$("#content_comment_s").select();
		 // document.getElementById("#content_comment_s").focus();
		 // document.getElementById("#content_comment_s").select();

	 	
	
	});
	
	
	$(".list-comment").on('click', '.submit_comment', function() {
	
		var d = new Date();
		var Title="Ẩn Danh";
		if(m!=0){
			
			Title="Thành Viên";
		}		
		var Likes=0;
		var DateRelay=d.getFullYear();
		var Avartar="frontend/images/noavatar.png";
		var Name=$("#name_comments").val();
		var Content=$("#content_comment_s").val();
		var Email=$("#email_comments").val();
		//var idChap=1;
		var NameRelay1=$(this).attr("aa5");	
		var IdComment=$(this).attr("aa4");
		var id2=$(this).attr("aa6");
		var id3=$(this).attr("email");
		var IdReply=$(this).attr("aa0");
		//var IdStory=$(this).attr("IdStory");
		//console.log(id3);	
	    var flac_coment=0;
		  if(Content==""){
			  flac_coment=1;
			  alert("Vui lòng nhập nội dung bình luận.");
		  }else if(Name==""){
			  flac_coment=1;
			  alert("Vui lòng nhập tên của bạn.");
		  }
   if(flac_coment==0){
	$.ajax({     
	       url:linkOption1+'ajax/comment/traloi.php',
	       type:'POST',
	       cache:false,
	       data:{'Content':Content,'Avartar':Avartar,'Name':Name,'Title':Title,'Likes':Likes,'DateRelay':DateRelay,'IdComment':IdComment,'NameRelay1':NameRelay1,'id2':id2,'IdUser':id3,'IdReply':IdReply,'IdStory':IdStory,'IdUserMain':IdUser},
	       success:function(kq){
			 //console.log(kq);
			   var o = JSON.parse(kq);
				var Title1="";
				var xoa="<span class='remove_comnent'  data-bookid='r"+o.Id+"' title='Xoá'><i class='fa fa-trash' aria-hidden='true'></i> Xoá</span>";
		   if(o.Title=="Ẩn Danh"){
			   Title1="<span class='title-user-comment title-hidden'>"+o.Title+"</span>";
			   	$("#comment-form-levels"+o.id2).append("<article class='info-comment child_"+o.Id+" parent_"+o.IdComment+" reply-list' id='r"+o.Id+"'><div class='outsite-comment reply-list'><figure class='avartar-comment'><img src='"+o.Avartar+"' alt='"+o.Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+o.Name+"</strong>"+Title1+"<span class='time'>"+o.DateRelay+"</span></div><div class='content-comment'><strong>"+o.NameRelay1+"</strong> "+o.Content+"</div></div><div class='action-comment'><span class='like-comment' data-id='lr"+o.Id+"'><i class='fas fa-thumbs-up'></i> <span id='lr"+o.Id+"' class='total-like-comment' data-like='r"+o.Id+"'>"+o.Likes+"</span></span><span class='reply-comment' aa00='1' aa0='r"+o.Id+"' aa4='"+o.IdComment+"' aa5='"+o.Name+"' aa6='"+o.id2+"' email='"+IdUser+"'><i class='far fa-comment'></i> Trả lời</span></div></div></div></article>");
			
		   }else if(o.Title=="Thành Viên"){
			   
			   Title1="<span class='title-user-comment title-member'>"+o.Title+"</span>";
			   	$("#comment-form-levels"+o.id2).append("<article class='info-comment child_"+o.Id+" parent_"+o.IdComment+" reply-list' id='r"+o.Id+"'><div class='outsite-comment reply-list'><figure class='avartar-comment'><img src='"+o.Avartar+"' alt='"+o.Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+o.Name+"</strong>"+Title1+"<span class='time'>"+o.DateRelay+"</span></div><div class='content-comment'><strong>"+o.NameRelay1+"</strong> "+o.Content+"</div></div><div class='action-comment'><span class='like-comment' data-id='lr"+o.Id+"'><i class='fas fa-thumbs-up'></i> <span id='lr"+o.Id+"' class='total-like-comment' data-like='r"+o.Id+"'>"+o.Likes+"</span></span><span class='reply-comment' aa00='1' aa0='r"+o.Id+"' aa4='"+o.IdComment+"' aa5='"+o.Name+"' aa6='"+o.id2+"' email='"+IdUser+"'><i class='far fa-comment'></i> Trả lời</span>"+xoa+"</div></div></div></article>");
			
		   }else{
		       
		       $("#content_comment_s").val("");
		   }
				
 				   
			//$("#comment-form-levels"+o.id2).append("<article class='info-comment child_"+o.Id+" parent_"+o.IdComment+" reply-list' id='r"+o.Id+"'><div class='outsite-comment reply-list'><figure class='avartar-comment'><img src='"+o.Avartar+"' alt='"+o.Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+o.Name+"</strong>"+Title1+"<span class='time'>"+o.DateRelay+"</span></div><div class='content-comment'><strong>"+o.NameRelay1+"</strong>  "+o.Content+"</div></div><div class='action-comment'><span class='like-comment'><i class='fas fa-thumbs-up'></i> <span class='total-like-comment'>"+o.Id+"</span></span><span class='reply-comment' aa00='1' aa0='r"+o.Id+"'  aa4='"+o.IdComment+"' aa5='"+o.Name+"' aa6='"+o.id2+"'><i class='far fa-comment'></i> Trả lời</span></div></div></div></article>");
		    
		
			$(".reply-ccc").remove();
			}
	       }).done(function() {
                 $(".content-comment").readmore({
                    maxHeight: 105,
                    speed: 100,
                    moreLink: '<p class="readmore"><a href="#">Xem Thêm</a></p>',
                    lessLink: '<p class="readmore"><a href="#">Rút Gọn</a></p>',
                    embedCSS: !0,
                    sectionCSS: "display: block; width: 100%;",
                    startOpen: !1,
                    expandedClass: "readmore-js-expanded",
                    collapsedClass: "readmore-js-collapsed"
                })
            });
      }
	});
	
	$("#list_emoji").on('click', '.emoji_comment', function(e) {
		
		 var t = $(this).data("code");
		 
            ! function(e, t) {
                var n = document.getElementById(e);
				
                if (n) {
                    var i = n.scrollTop,
                        o = 0,
                        s = n.selectionStart || "0" == n.selectionStart ? "ff" : !!document.selection && "ie";
                    if ("ie" == s) {
                        n.focus();
                        var r = document.selection.createRange();
                        r.moveStart("character", -n.value.length), o = r.text.length
                    } else "ff" == s && (o = n.selectionStart);
                    var a = n.value.substring(0, o),
                        l = n.value.substring(o, n.value.length);
                    if (n.value = a + t + l, o += t.length, "ie" == s) {
                        n.focus();
                        var c = document.selection.createRange();
                        c.moveStart("character", -n.value.length), c.moveStart("character", o), c.moveEnd("character", 0), c.select()
                    } else "ff" == s && (n.selectionStart = o, n.selectionEnd = o, n.focus());
                    n.scrollTop = i
                }
            }($(emoji_1_2).val(), t)
			$("#list_emoji").removeClass("is-active");
	});
	$("#list_emoji").on('click', '.close-emoji', function() {
		$("#list_emoji").removeClass("is-active");
	});
	$(".main_comment").on('click', '.click_emoji', function() {	
		$("#list_emoji").addClass("is-active");
	});
	$(".list-comment").on('click', '.click_emoji', function() {	
		$("#list_emoji").addClass("is-active");
	});
	$(".list-comment").on('click', '.remove_comnent', function() {
		
		 if (confirm("Bạn muốn xóa bình luận này?")) {
			var p1=$(this).attr("data-bookid");
			var res = p1.substr(0,1);
			var res2 =p1.substr(1);
			if(res=="r"){
				$("#r"+res2).remove();
				
			}else if(res=="c"){
				$("#comment-form-levels"+res2).remove();
			}
			  $.ajax({     
			   url:linkOption1+'ajax/comment/xoabinhluan.php',
			   type:'POST',
			   cache:false,
			   data:{'res':res,'res2':res2},
			   success:function(kq){
				var o = JSON.parse(kq);
					 //console.log(o.tong);
					 }
			   })
		}
	});
	// $(".button_login").click(function(){	
	
		// var email=$("#email_login").val();
		// var pass=$("#password_login").val();
		// if (email =="" || pass==""){
			// alert("DE trong");
		// }else{
			 // $.ajax({     
	       // url:'login.php',
	       // type:'POST',
	       // cache:false,
	       // data:{'email':email,'pass':pass},
	       // success:function(kq){
	       	// var o = JSON.parse(kq);
				// if(o.n==1){
					// location.reload();
				// }else{
					// alert("Email or pass sai!!!");
				// }
					
	           // }
	       // })
		// }
	   
	// });
	
function load_comments1(){
	  $(".load_more_comment a").text("Đang tải thêm bình luận....");

		   
		  var count_class=document.getElementsByClassName("comment-main-replys");
		  var IdDiv = 0;
		  var IdComment = 0;
		  if(count_class.length !=0){
			
		  var IdDiv = document.getElementsByClassName("comment-main-replys")[count_class.length-1].id;
		  var IdComment = IdDiv.substr(19);
		  
		  }
	   $.ajax({     
	       url:linkOption1+'ajax/comment/xemthem.php',
	       type:'POST',
	       cache:false,
	       data:{'IdDiv':IdDiv,'IdComment':IdComment,'IdStory':IdStory},
	       success:function(kq){
			  
			   $(".load_more_comment a").text("Xem thêm nhiều bình luận....");
			function myFunction3(str,arr1,arr2) {
			 var k=str;
			
			  for(var i=0;i<arr1.length;i++){
			  var find = arr1[i];
              var re = new RegExp(find, 'g');
				if(k.indexOf(arr1[i])>=0){
					k = k.replace(re, "<img src='"+arr2[i]+"' class='emoji_comment'>");
					
				}
			  }
			   return k;
			}
			
			var o = JSON.parse(kq);
			var c=o.Comment_s;
			var r=o.reply_s;
			var ej_c=o.ej_code;
			var ej_p=o.ej_path; 
			var ej_c1=JSON.parse(ej_c);
			var ej_p1=JSON.parse(ej_p);
			//console.log(ej_c1);
			//console.log(ej_p1);
			var ccc1=o.cc1;
			var rrr1=o.rr1;

				var f_c=JSON.parse(c);
				
				var f_r=JSON.parse(r);
			    var cccc1=JSON.parse(ccc1);	
				var rrrr1=JSON.parse(rrr1);
				
					   for(var i=0;i<f_c.length;i++){
							var myElement = document.getElementById("comment-form-levels"+f_c[i].Id);
							if(!myElement){
								var xoa2="";
															
								if(m==f_c[i].IdUser)	
								xoa2="<span class='remove_comnent'  data-bookid='c"+f_c[i].Id+"' title='Xoá'><i class='fa fa-trash' aria-hidden='true'></i> Xoá</span>";
						  

						  var Title1="";
						   if(f_c[i].Title=="Ẩn Danh"){
							   Title1="<span class='title-user-comment title-hidden'>"+f_c[i].Title+"</span>";
							   $(".list-comment").append("<div id='comment-form-levels"+f_c[i].Id+"' class='comment-main-replys'><article class='info-comment child_"+f_c[i].Id+" parent_0 comment-main-level' id='c"+f_c[i].Id+"'><div class='outsite-comment comment-main-level'><figure class='avartar-comment'><img src='"+linkOption1+f_c[i].Avatar+"' alt='"+f_c[i].Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+f_c[i].Name+"</strong>"+Title1+"<span class='time'>"+cccc1[i]+"</span></div><div class='content-comment'><strong></strong>"+myFunction3(f_c[i].Content,ej_c1,ej_p1)+"</div></div><div class='action-comment'> <span class='like-comment' data-id='lc"+f_c[i].Id+"'><i class='fas fa-thumbs-up'></i>&nbsp;<span id='lc"+f_c[i].Id+"' class='total-like-comment' data-like='c"+f_c[i].Id+"'> "+f_c[i].Likes+"</span></span><span class='reply-comment' data-parent='0' aa00='0' aa0='c"+f_c[i].Id+"' aa4='"+f_c[i].Id+"' aa5='"+f_c[i].Name+"' aa6='"+f_c[i].Id+"' email='"+f_c[i].IdUser+"'><i class='far fa-comment'></i> Trả lời</span></div></div></div></article></div>");

						   }else if(f_c[i].Title=="Thành Viên"){
							   Title1="<span class='title-user-comment title-member'>"+f_c[i].Title+"</span>";
							   if(m==""){
								   $(".list-comment").append("<div id='comment-form-levels"+f_c[i].Id+"' class='comment-main-replys'><article class='info-comment child_"+f_c[i].Id+" parent_0 comment-main-level' id='c"+f_c[i].Id+"'><div class='outsite-comment comment-main-level'><figure class='avartar-comment'><img src='"+linkOption1+f_c[i].Avatar+"' alt='"+f_c[i].Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+f_c[i].Name+"</strong>"+Title1+"<span class='time'>"+cccc1[i]+"</span></div><div class='content-comment'><strong></strong>"+myFunction3(f_c[i].Content,ej_c1,ej_p1)+"</div></div><div class='action-comment'> <span class='like-comment' data-id='lc"+f_c[i].Id+"'><i class='fas fa-thumbs-up'></i>&nbsp;<span id='lc"+f_c[i].Id+"' class='total-like-comment' data-like='c"+f_c[i].Id+"'> "+f_c[i].Likes+"</span></span><span class='reply-comment' data-parent='0' aa00='0' aa0='c"+f_c[i].Id+"' aa4='"+f_c[i].Id+"' aa5='"+f_c[i].Name+"' aa6='"+f_c[i].Id+"' email='"+f_c[i].IdUser+"'><i class='far fa-comment'></i> Trả lời</span></div></div></div></article></div>");
 
							   }else{
								    $(".list-comment").append("<div id='comment-form-levels"+f_c[i].Id+"' class='comment-main-replys'><article class='info-comment child_"+f_c[i].Id+" parent_0 comment-main-level' id='c"+f_c[i].Id+"'><div class='outsite-comment comment-main-level'><figure class='avartar-comment'><img src='"+linkOption1+f_c[i].Avatar+"' alt='"+f_c[i].Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+f_c[i].Name+"</strong>"+Title1+"<span class='time'>"+cccc1[i]+"</span></div><div class='content-comment'><strong></strong>"+myFunction3(f_c[i].Content,ej_c1,ej_p1)+"</div></div><div class='action-comment'> <span class='like-comment' data-id='lc"+f_c[i].Id+"'><i class='fas fa-thumbs-up'></i>&nbsp;<span id='lc"+f_c[i].Id+"' class='total-like-comment' data-like='c"+f_c[i].Id+"'> "+f_c[i].Likes+"</span></span><span class='reply-comment' data-parent='0' aa00='0' aa0='c"+f_c[i].Id+"' aa4='"+f_c[i].Id+"' aa5='"+f_c[i].Name+"' aa6='"+f_c[i].Id+"' email='"+f_c[i].IdUser+"'><i class='far fa-comment'></i> Trả lời</span>"+xoa2+"</div></div></div></article></div>");

							   }
							  
						   }
							
							for(var j=0;j<f_r.length;j++){
								if(f_c[i].Id==f_r[j].IdComment){
								 var Title2="";								 
								 var xoa="";
								if(m==f_r[j].IdUserMain)
								 xoa="<span class='remove_comnent'  data-bookid='r"+f_r[j].Id+"' title='Xoá'><i class='fa fa-trash' aria-hidden='true'></i> Xoá</span>";
							   if(f_r[j].Title=="Ẩn Danh"){
								   Title2="<span class='title-user-comment title-hidden'>"+f_r[j].Title+"</span>";
								   $("#comment-form-levels"+f_c[i].Id).append("<article class='info-comment child_"+f_r[j].Id+" parent_"+f_r[j].IdReply+" reply-list' id='r"+f_r[j].Id+"'><div class='outsite-comment reply-list'><figure class='avartar-comment'><img src='"+linkOption1+f_r[j].Avatar+"' alt='"+f_r[j].Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+f_r[j].Name+"</strong>"+Title2+"<span class='time'>"+rrrr1[j]+"</span></div><div class='content-comment'><strong>"+f_r[j].NameComment+"</strong> "+myFunction3(f_r[j].Content,ej_c1,ej_p1)+"</div></div><div class='action-comment'><span class='like-comment' data-id='lr"+f_r[j].Id+"'><i class='fas fa-thumbs-up'></i> <span id='lr"+f_r[j].Id+"' class='total-like-comment' data-like='r"+f_r[j].Id+"'>"+f_r[j].Likes+"</span></span><span class='reply-comment' aa00='1' aa0='r"+f_r[j].Id+"' aa4='"+f_r[j].IdReply+"' aa5='"+f_r[j].Name+"' aa6='"+f_r[j].IdComment+"' email='"+f_r[j].IdUserMain+"'><i class='far fa-comment'></i> Trả lời</span></div></div></div></article>");

							   }else if(f_r[j].Title=="Thành Viên"){
								   Title2="<span class='title-user-comment title-member'>"+f_r[j].Title+"</span>";
								   if(m==""){
									    $("#comment-form-levels"+f_c[i].Id).append("<article class='info-comment child_"+f_r[j].Id+" parent_"+f_r[j].IdReply+" reply-list' id='r"+f_r[j].Id+"'><div class='outsite-comment reply-list'><figure class='avartar-comment'><img src='"+linkOption1+f_r[j].Avatar+"' alt='"+f_r[j].Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+f_r[j].Name+"</strong>"+Title2+"<span class='time'>"+rrrr1[j]+"</span></div><div class='content-comment'><strong>"+f_r[j].NameComment+"</strong> "+myFunction3(f_r[j].Content,ej_c1,ej_p1)+"</div></div><div class='action-comment'><span class='like-comment' data-id='lr"+f_r[j].Id+"'><i class='fas fa-thumbs-up'></i> <span id='lr"+f_r[j].Id+"' class='total-like-comment' data-like='r"+f_r[j].Id+"'>"+f_r[j].Likes+"</span></span><span class='reply-comment' aa00='1' aa0='r"+f_r[j].Id+"' aa4='"+f_r[j].IdReply+"' aa5='"+f_r[j].Name+"' aa6='"+f_r[j].IdComment+"' email='"+f_r[j].IdUserMain+"'><i class='far fa-comment'></i> Trả lời</span></div></div></div></article>");

								   }else{
									    $("#comment-form-levels"+f_c[i].Id).append("<article class='info-comment child_"+f_r[j].Id+" parent_"+f_r[j].IdReply+" reply-list' id='r"+f_r[j].Id+"'><div class='outsite-comment reply-list'><figure class='avartar-comment'><img src='"+linkOption1+f_r[j].Avatar+"' alt='"+f_r[j].Name+"'></figure><div class='item-comment'><div class='outline-content-comment'><div><strong>"+f_r[j].Name+"</strong>"+Title2+"<span class='time'>"+rrrr1[j]+"</span></div><div class='content-comment'><strong>"+f_r[j].NameComment+"</strong> "+myFunction3(f_r[j].Content,ej_c1,ej_p1)+"</div></div><div class='action-comment'><span class='like-comment' data-id='lr"+f_r[j].Id+"'><i class='fas fa-thumbs-up'></i> <span id='lr"+f_r[j].Id+"' class='total-like-comment' data-like='r"+f_r[j].Id+"'>"+f_r[j].Likes+"</span></span><span class='reply-comment' aa00='1' aa0='r"+f_r[j].Id+"' aa4='"+f_r[j].IdReply+"' aa5='"+f_r[j].Name+"' aa6='"+f_r[j].IdComment+"' email='"+f_r[j].IdUserMain+"'><i class='far fa-comment'></i> Trả lời</span>"+xoa+"</div></div></div></article>");

								   }
								  
							   }
								 
								}
							}
						 }
					   } 
            			
					
	             }
	       }).done(function() {
                 $(".content-comment").readmore({
                    maxHeight: 105,
                    speed: 100,
                    moreLink: '<p class="readmore"><a href="#">Xem Thêm</a></p>',
                    lessLink: '<p class="readmore"><a href="#">Rút Gọn</a></p>',
                    embedCSS: !0,
                    sectionCSS: "display: block; width: 100%;",
                    startOpen: !1,
                    expandedClass: "readmore-js-expanded",
                    collapsedClass: "readmore-js-collapsed"
                })
            });
	
}
	$("#load_comments").click(function(){
			
	 load_comments1();
	   
	});
	 $(document).on("change", ".selectEpisode", function() {
                window.location.href = $(this).val();
     });
	  
	$(".list-comment").on('click', '.like-comment', function() {
		 var like=$(this).attr("data-id");
		 var c=like.substr(1,1);
		 var id=like.substr(2);
		
		  $.ajax({     
	   url:linkOption1+'ajax/comment/likecomment.php',
	   type:'POST',
	   cache:false,
	   data:{'like':like,'c':c,'id':id},
	   success:function(kq){
		var o = JSON.parse(kq);
			// console.log(o.tong);
				if(o.temp==1){
					
					alert("Bạn đã thích bình luận này rồi!");
				}else{
					
					$("#"+o.like).text(o.increase);
				
				}
			 }
	   })
		 
	});
	 $(".subscribeBook").click(function(){
		  var t = $(this);
		  var idStory_s=$(this).attr("data-id");
	 $.ajax({     
	   url:linkOption1+'ajax/comment/subscribestory.php',
	   type:'POST',
	   cache:false,
	   data:{'idStory':idStory_s,'idUser':IdUser},
	   success:function(kq){
		var o = JSON.parse(kq);
		//console.log("a"+o.success+"b");
				
				if(Type_Chapter==1){
					if(o.success==0){
						t.html('<span class="fa fa-heart"></span>Theo dõi')
					}else{
						t.html('<span class="far fa-heart"></span>Huỷ theo dõi')
					}
				}else{
					if(o.success==0){
						t.html('<span class="far fa-heart"> Theo dõi</span>')
					}else{
						t.html('<span class="fa fa-heart"> Huỷ theo dõi</span>')
					}
				}
			 }
	   })
		 
	});
	$(".btn-like").click(function(){
		 var idStory_s = $(this).data("id");
	  $.ajax({     
	   url:linkOption1+'ajax/comment/likestory.php',
	   type:'POST',
	   cache:false,
	   data:{'idStory':idStory_s,'idUser':IdUser},
	   success:function(kq){
		var o = JSON.parse(kq);
			 //console.log(o.success);
				if(o.success==0){
					 $(".number-like").text(parseInt($(".number-like").text()) + 1)
				}else{
					 alert("Bạn đã nhấn Thích truyện này rồi!");
				}
			 }
	   })
		 
	});
	$("#submit_error").click(function(){
	var Content="";
	var idStory=$("#submit_error").attr("idStory");
	var idChap=$("#submit_error").attr("idChap");
	
	if(document.getElementById("typeError").value!=-1){
		 Content=$('#typeError :selected').text();
	}else{
		 Content=$("#contentError").val();
	}
	console.log(Content);
	  $.ajax({     
	   url:linkOption1+'ajax/comment/feedback.php',
	   type:'POST',
	   cache:false,
	   data:{'Content':Content,'IdStory':idStory,'IdChap':idChap},
	   success:function(kq){
		   //var o = JSON.parse(kq);
		   //console.log(o.success);
				alert("Báo lỗi thành công. Cảm ơn bạn.");
			 }
	   })
		 
	});
});
