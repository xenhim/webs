<div class="alert-note-fix"></div>
<section class="footer">
    <div class="container">
        <div class="level">
            <div class="level-left">
	    <div class="col-sm-4 text-center" itemscope="" itemtype="http://schema.org/Organization">
                    <a itemprop="url" href="index.html">
                        <img itemprop="logo" src="<?=$linkOption?>page/frontend/images/logo-xemtr4.png" alt="XemTruyen.Xyz - Truyện tranh Online">
                    </a>
                </div>
                <div class="text-footer">Copyright © 2023 - XemTruyen.Xyz</div>
            </div>
           <!-- <div class="level-right">
                <ul class="social-links">
                    <li><a href="#"><span class="app-store-icon"></span></a></li>
                    <li><a href="#"><span class="google-play-icon"></span></a></li>
                </ul>
               
            </div>-->
        </div>
    </div>
</section>
<!-- /.footer -->            
<div class="modal qr-modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="qr-section">
					<select id="paper_color" class="form-control">
						<option value="">Chọn Màu Nền</option>
						<option value="#F4F4F4">Xám nhạt</option>
						<option value="#DFDFE3">Xám Đậm</option>
						<option value="#E9EBEE">Xanh nhạt</option>
						<option value="#F4F4E4">Vàng nhạt</option>
						<option value="#EAE4D3">Màu sepia</option>
						<option value="#D5D8DC">Xanh đậm</option>
						<option value="#FAFAC8">Vàng đậm</option>
						<option value="#EFEFAB">Vàng ố</option>
						<option value="#FFF">Màu trắng</option>
						<option value="#eaeaea">Hạt sạn</option>
						<option value="#bfb197">Sách cũ</option>
						<option value="#232323">Màu tối</option>
					</select>
					<select id="text_color" class="form-control">
						<option value="">Chọn Màu Chữ</option>
						<option value="#2b2b2b">Đen</option>
						<option value="#DFDFE3">Xám Nhạt</option>
						<option value="#C4C4C8">Xám Đậm</option>
						<option value="#EEE">Trắng</option>
					</select>
					<select class="form-control no-zoom" id="text_font">
						<option value="">Chọn Font Chữ</option>						
						<option value='Palatino Linotype,"Arial","Times New Roman",sans-serif'>Palatino Linotype full</option>
						<option value="'Palatino Linotype', serif">Palatino Linotype</option>
						<option value="Bookerly, serif">Bookerly</option>
						<option value="Minion, serif">Minion</option>
						<option value="'Segoe UI', sans-serif">Segoe UI</option>
						<option value="Roboto, sans-serif">Roboto</option>
						<option value="'Roboto Condensed', sans-serif">Roboto Condensed</option>
						<option value="'Patrick Hand', sans-serif">Patrick Hand</option>
						<option value="'Noticia Text', sans-serif">Noticia Text</option>
						<option value="'Times New Roman', serif">Times New Roman</option>
						<option value="Verdana, sans-serif">Verdana</option>
						<option value="Tahoma, sans-serif">Tahoma</option>
						<option value="Arial, sans-serif">Arial</option>
					</select>
					<select class="form-control" id="text_size">
						<option value="14px">Chọn Cỡ Chữ</option>
						<option value="14px">14</option>
						<option value="16px">16</option>
						<option value="18px">18</option>
						<option value="20px">20</option>
						<option value="22px">22</option>
						<option value="24px">24</option>
						<option value="26px">26</option>
						<option value="28px">28</option>
						<option value="30px">30</option>
						<option value="32px">32</option>
						<option value="34px">34</option>
						<option value="36px">36</option>
						<option value="38px">38</option>
					</select>
				
                </div>
                <button class="close-button close-icon"></button>
         </div>
</div>
<?php
if(!isset($paper_color))
$paper_color="#F4F4F4";
if(!isset($text_color))
$text_color="#2b2b2b";
if(!isset($text_font))
$text_font='Palatino Linotype,"Arial","Times New Roman",sans-serif';
if(!isset($text_size))
$text_size="26px";

?>
<script>
$(document).ready(function(){
	var paper_color=<?php echo json_encode($paper_color);?> ;
	var text_color=<?php echo json_encode($text_color);?> ;
	var text_font=<?php echo json_encode($text_font);?> ;
	var text_size=<?php echo json_encode($text_size);?> ;
	if(paper_color !=""){
	if(paper_color=="#eaeaea" || paper_color=="#bfb197"){
	 $("#box_font").css({"background-image":'url(' + linkOption1 + 'frontend/images/bg_book_op.png)'});
	 $("#path_1 ol").css({"background-image":'url(' + linkOption1 + 'frontend/images/bg_book_op.png)'});
	}
     else{
	 $("#box_font").css({"background-color": paper_color,"background-image":"none"});
	 $("#path_1 ol").css({"background-color": paper_color,"background-image":"none"});
	 
	 }
	}		
	if(text_color !=""){
		$("#box_font *").css({"color": text_color});
	}		
	if(text_font !=""){
		$("#box_font").css({"font-family": text_font});
	}	
	if(text_size !=""){
		$("#box_font").css({"font-size": text_size});
	}
  $("#paper_color").change(function () {  
	    var optionSelected = $(this).find("option:selected");  
        var valueSelected  = optionSelected.val();
	 //console.log(valueSelected);
	 //style="background-image: url('.$linkOption1.'frontend/images/bg_book_op.png);"
	 if(valueSelected=="#eaeaea" || valueSelected=="#bfb197"){
	  $("#box_font").css({"background-image":'url(' + linkOption1 + 'frontend/images/bg_book_op.png)'});
	   $("#path_1 ol").css({"background-image":'url(' + linkOption1 + 'frontend/images/bg_book_op.png)'});
	 }
     else{
	  $("#box_font").css({"background-color": valueSelected,"background-image":"none"});
	  $("#path_1 ol").css({"background-color": valueSelected,"background-image":"none"});
	 }
  
	    $.ajax({     
	       url:linkOption1+'ajax/font/changeFont.php',
	       type:'POST',
	       cache:false,
	       data:{'paper_color':valueSelected},
	       success:function(kq){}
	      })
	 
  });
  $("#text_color").change(function () {  
     var optionSelected = $(this).find("option:selected");    
     var valueSelected  = optionSelected.val();
	 $("#box_font").css({"color": valueSelected});
	  $.ajax({     
	       url:linkOption1+'ajax/font/changeFont.php',
	       type:'POST',
	       cache:false,
	       data:{'text_color':valueSelected},
	       success:function(kq){}
	      })
  });
  $("#text_font").change(function () {  
	 var optionSelected = $(this).find("option:selected");    
     var valueSelected  = optionSelected.val();
	 //console.log(valueSelected);
	  $("#box_font").css({"font-family": valueSelected});
	  $.ajax({     
	       url:linkOption1+'ajax/font/changeFont.php',
	       type:'POST',
	       cache:false,
	       data:{'text_font':valueSelected},
	       success:function(kq){}
	      })
  });
  $("#text_size").change(function () {    
      var optionSelected = $(this).find("option:selected");    
      var valueSelected  = optionSelected.val();	 
	  $("#box_font").css({"font-size": valueSelected});
	  $.ajax({     
	       url:linkOption1+'ajax/font/changeFont.php',
	       type:'POST',
	       cache:false,
	       data:{'text_size':valueSelected},
	       success:function(kq){}
	      })
  });
});
</script>