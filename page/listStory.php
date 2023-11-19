<?php
    require_once('model/connection.php');
	require_once('function/function.php');
	$db=new config();
	$db->config();	
	$linkOption=siteURL();	
	$linkOption1=$linkOption."page/";
	if(isset($_SESSION['email'])){
		if($db->GetLevelUser($_SESSION['email'])<1){
			header("location:".$linkOption);
		}
	}else{
		header("location:".$linkOption);
	}
	$arr_story=$db->GetStory();
	
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Danh sách truyện</title>               
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<link rel="shortcut icon" href="frontend/images/favicon.ico?v=1.1" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
    <script src="js/main.js"></script>
	<script src="ckeditor/ckeditor.js" type="text/javascript" ></script>
</head>
<body>
<input type="hidden" id="keyword-default" value="nanatsu">
<div class="outsite ">
<?php
require_once('header/headerDetail.php');
?>   
    <title>Danh sách truyện</title>	
	<section class="main-content">
    <div class="container">
        <div class="messages columns">
			 <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="listStory";
			require_once('header/headerLeft.php');
			?>  
			<div class="column columns">				
                <div class="user-main column" style="overflow: scroll;">				  
                    <div class="level title">
                       <p class="level-left has-text-weight-bold">Danh sách truyện</p>	
					   
                    </div>                
					<div class="field">						
						<select id="Badge" class="control">
							<option>Tất cả</option>
							<option>Riêng tư</option>
							<option>Công khai</option>						
					   </select>					 
						<p class="control">
							<input  class="input" type="text" id="SearchStory" name="last_name"/>
						</p>
					</div>
					<div class="field" >
						<div id="listStory" ></div>
					</div>					
					<div id="listPagination"></div>
                </div>
               </div>
            </div>
        </div>
    </div>
</section>
</div>
<script>
function paginationEvent(per_page=5,page=1){
		
	  var key=document.getElementById("SearchStory").value;
	
	   $.ajax({     
	       url:'ajax/story/list.php',
	       type:'POST',
	       cache:false,
	       data:{'key':key,'per_page':per_page,'page':page},
	       success:function(kq){
			    
			  var o = JSON.parse(kq);
			
			  var html1="";
			    html1+='<table class="table">';
					html1+='<thead>';
					  html1+='<tr>';
						html1+='<th>Avatar</th>';
						html1+='<th>Name</th>'
						html1+='<th>Status</th>';
						html1+='<th>DateUpload</th>';
						//html1+='<th>Action</th>';
						
					  html1+='</tr>';
					html1+='</thead>';
					html1+='<tbody>';
					var k=o.arr;
					
				   for(var i=0;i<k[0].length;i++)
					{
											 
							   html1+='<tr>';
								 html1+='<td><img src="./'+k[0][i].ImgAvatar+'" style="width:70px;height:50px;"/></td>';
								 html1+='<td>'+k[0][i].Name+'</td>';
							
								 html1+='<td>'+k[0][i].story_Status+'</td>';
								 html1+='<td>'+k[0][i].DateUpload+'</td>';
								 html1+='<td><a href="editStory.php?idStory='+k[0][i].Id+'"><i class="fas fa-edit"></i></a></td>';
								 //html1+='<td><a href="'+k[0][i].Id+'">Delete</a></td>';
								 if(k[0][i].hide_view==1)
								 html1+='<td class="hide_view" data-id="'+k[0][i].Id+'"><a href="javascript:void(0)"><i id="'+k[0][i].Id+'" class="fa fa-eye-slash" aria-hidden="true"></i></a></td>';
							     else
								 html1+='<td class="hide_view" data-id="'+k[0][i].Id+'"><a href="javascript:void(0)"><i id="'+k[0][i].Id+'" class="fa fa-eye" aria-hidden="true"></i></a></td>';
								 html1+='<td><a href="listChap.php?idStory='+k[0][i].Id+'" target="_blank"><i class="fas fa-tasks"></i></a></td>';
								 html1+='<td><a href="getlinktruyen.php?idStory='+k[0][i].Id+'" target="_blank"><i class="fas fa-link"></i></a></td>';
								
							   html1+='</tr>';
						 
					}
				   html1+='</tbody>';
				  html1+='</table>';
				$("#listStory").html(html1);					
			   var html="";
			   
					 html+='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';
					 html+='<ul class="pagination-list">';
				
						var item_per_page = parseInt(o.per_page);
						var current_page =  parseInt(o.page); 
						
						//console.log(current_page);

						var totalRecords =parseInt(o.totalRecords);
						
						
						var totalPages = Math.ceil(totalRecords / item_per_page);
						
						
												 
				    if (current_page > 3) {
						var first_page = 1;
						
						html+='<li onclick="paginationEvent('+item_per_page+','+first_page+')"><a  class="pagination-previous"><span aria-hidden="true">«</span></a></li>'
						
					}
					if (current_page > 1) {
						var prev_page = current_page - 1;
						
						html+='<li onclick="paginationEvent('+item_per_page+','+prev_page+')"><a  class="pagination-link"><span aria-hidden="true">‹</span></a></li>';
					 }
					
					 for (var num = 1; num <= totalPages; num++) { 
						 if (num != current_page) { 
							if (num > current_page - 3 && num < current_page + 3) { 
								html+='<li onclick="paginationEvent('+item_per_page+','+num+')"><a  class="pagination-link">'+num+'</a></li>';
							} 
						 } else {     
							html+='<li><a class="pagination-link is-current" href="javascript:void(0)">'+num+'</a></li>';
						 } 
					 } 
					
					if (current_page < totalPages - 1) {
						var next_page = current_page + 1;
						
						html+='<li onclick="paginationEvent('+item_per_page+','+next_page+')"><a  class="pagination-link" ><span aria-hidden="true">›</span></a></li>';
					
					}
					if (current_page < totalPages - 3) {
						var end_page = totalPages;
						
						html+='<li onclick="paginationEvent('+item_per_page+','+end_page+')"><a  class="pagination-next"><span aria-hidden="true">»</span></a></li>';
						
					}
					
					 html+='</ul>';
					html+='</nav>';
					
					 html+='</ul>';
					html+='</nav>';
					$("#listPagination").html(html);
		      }
	       });
		    //});
	  
  }
 var linkOption1=<?php echo json_encode($linkOption1)?>;	  
$(document).ready(function(){
 
  $("#listStory").on('click', '.hide_view', function() {
	   var id=$(this).attr("data-id");
	   var className = $('#'+id).attr('class');
	   var className2=0;
	   if(className=="fa fa-eye"){
		 $("#"+id).attr('class', 'fa fa-eye-slash');
		 className2=1;
	   }		
	   else{
		  
	    $("#"+id).attr('class', 'fa fa-eye');   
	   }
	      $.ajax({     
	       url:linkOption1+'ajax/story/view.php',
	       type:'POST',
	       cache:false,
	       data:{'id':id,'className2':className2},
	       success:function(kq){
			   
			   console.log(kq);
		   }
	       })
  });
  $("#SearchStory").keyup(function(){
	  paginationEvent();
  
  });
});

</script>
	
	
</body>
</html>