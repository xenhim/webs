  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">
<a href="index8.php">Thay đổi link tên miền</a></br>
<div class="form-group">
  <label for="usr">Link: Trang truyện hỗ trợ getlink [truyenqq,nettruyen]</label></br>
   <label for="usr" style="color:red;">Chú ý nếu muốn getlink lại truyện, dán đúng link lúc ban đầu đã getlink để không bị lỗi dữ liệu</label>

  <input type="text" class="form-control" id="link" style="width:50%" placeholder="ví dụ: http://truyenqqvip.com/truyen-tranh/vo-luyen-dinh-phong-3926">
</div>


<div class="form-group">

  <input type="radio" class="form-check-input" id="nettruyen" name="optradio" value="nettruyen" checked>
  <label class="form-check-label" for="radio1">nettruyen</label>
</div>
<div class="form-group">
  <label for="usr">Nhãn:</label>
   <select class="form-control" id="Badge" style="width:20%">
    <option>Chọn</option>
    <option>Hot</option>
    <option>New</option>
  </select>
</div>
<div class="form-group">
  <label for="usr">Nội dung 18+</label>
   <select class="form-control" id="waning" style="width:20%">   
    <option>Thường</option>
    <option>Nhạy Cảm</option>
  </select>
</div>
<div class="form-group">
  <label for="usr">Quốc gia:</label>
   <select class="form-control" id="country" style="width:20%">
    <option>Trung Quốc</option>
    <option>Nhật Bản</option>
    <option>Việt Nam</option>
	<option>Hàn Quốc</option>
    <option>Mỹ</option>    
  </select>
</div>
<div class="form-group" id="tom" style="display: none;">
      <label for="summarize">Tóm tắc:</label>
      <textarea class="form-control" rows="3" id="summarize"></textarea>
</div>
 <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="checkbox" name="darkmode" value="no">
      <label class="form-check-label" for="mySwitch">Cập nhật lại tất cả</label>
 </div>

<button type="button" class="btn btn-success" id="getlink">Thu thập</button>
</div> 
<script>
$(document).ready(function(){

 $('input[type=radio][name=optradio]').change(function() {
    if (this.value == 'nettruyen') {
      $('#tom').slideUp();
    }
    else if (this.value == 'truyenqq') {
       $('#tom').slideDown();
    }
});
  $("#getlink").click(function(){
   var link=$("#link").val();
   
    var waning=$("#waning").val();
   var x=$("#checkbox").is(":checked");
   if(x==true)
	   x=1;
   else x=0;
   var country=$("#country").val();
   var badge=$("#Badge").val();
	  $("#getlink").text("Đang thu thập...");		
	  $('#getlink').prop("disabled", true); 
		if( $("#nettruyen").is(":checked") ){ // check if the radio is checked            
		$.ajax({     
		   url:"nettruyen.php",
		   type:'POST',
		   cache:false,
		   data:{'link':link,'country':country,'badge':badge,'checkall':x,'waning':waning},
		   success:function(kq){
				console.log(kq);		   
			   var o = JSON.parse(kq);
			 
			   if(o.Error==1){
				alert("Thu thập thành công");
			   }
				else { 
					alert("Lỗi thu thập");
				}
				$("#getlink").text("Thu thập");	
				$('#getlink').prop("disabled", false); 

			 },error: function(errorThrown){
				    $('#getlink').prop("disabled", false); 
				 	$("#getlink").text("Thu thập");	
				  alert("errorThrown_Đã kết thúc tiến trình");		 
						
			 }
		   })
        }
  
  });
 
});
</script>