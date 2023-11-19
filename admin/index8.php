  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="container">
<a href=".">Tiếp tục thu thập </a></br>
<div class="form-group">
<label for="usr">Tên miền cũ:</label><br>
<input type="text" id="domain_old"><br>
</div> 
<br>
<div class="form-group">
<label for="usr">Tên miền mới:</label><br>
<input type="text" id="domain_new"><br>
 
</div> 
 <button type="button" class="btn btn-success" id="getlink">Chuyển đổi tên miền</button>
</div>
 <script>
$(document).ready(function(){	
  $("#getlink").click(function(){
   var domain_old=$("#domain_old").val();
   var domain_new=$("#domain_new").val();
	    $("#getlink").prop("disabled", true); 
	    $("#getlink").text("Đang Chuyển đổi tên miền...");
	$.ajax({     
	   url:"index8-ajax.php",
	   type:'POST',
	   cache:false,
	   data:{'domain_old':domain_old,'domain_new':domain_new},
	   success:function(kq){		   
		   var o = JSON.parse(kq);
		    alert("Đã chuyển tên miền");
		    $('#getlink').prop("disabled", false); 
			$("#getlink").text("Chuyển đổi tên miền");
		 },error: function (e) {
			alert(e);
		}
	   })
   
   
  
  });
 
});
</script>

