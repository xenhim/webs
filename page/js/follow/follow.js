var IdUser=m;
$(document).ready(function(){
	$(".remove-subscribe").click(function(){
		  var idStory = $(this).data("id");
		  //console.log(IdUser);
	  $.ajax({     
	   url:linkOption1+'ajax/follow/follow.php',
	   type:'POST',
	   cache:false,
	   data:{'idStory':idStory,'IdUser':IdUser},
	   success:function(kq){
		   var o = JSON.parse(kq);
		//console.log("a"+o.success+"b");
		       location.reload();
			 }
	   })
		 
	});
});

