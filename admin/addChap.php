<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
require_once('model/connection.php');
require_once('function/function.php');

	require_once('model/connection.php');
	require_once('function/function.php');
	$db=new config();
	$db->config();	
    $user="";
    $linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	if(isset($_SESSION['email'])){
		if($db->GetLevelUser($_SESSION['email'])<1){
			header("location:".$linkOption);
		}else{
		   $user= $_SESSION['email'];
		}
	}else{
		header("location:".$linkOption);
	}

	$avatarAdmin=$db->GetAvatarUser($user);
	$idStory=$_GET['idStory'];
	$nameStory=$db->GetNameStory2($idStory);	
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chapter | Thêm</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="frontend/file/jquery.tag-editor.css">	
  <link href="toastr/toastr.css" rel="stylesheet" />	
   
</head>
<body class="hold-transition sidebar-mini" onbeforeunload="return Reload()">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Chapter</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   <a href="index.php" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     <?php
      require_once('headerImg.php');
     ?>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
       <?php
      $typeMenu="addChap";
      require_once('menuLeft.php');
     ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm chapter mới</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Thêm truyện mới</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><?php echo $nameStory;?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputClientCompany">Tên chương</label>
               	<input type="text" class="form-control"  id="Name" name="Name" >
              </div>
               <div class="form-group">
                <label for="inputClientCompany">Tiêu đề chương</label>
               		<input type="text" class="form-control"  id="Title" name="Title" >
              </div>
             <div class="form-group">
                <label for="inputDescription">Site</label>
               <input type="text" class="form-control"  id="site" name="site" placeholder="Ví dụ: nettruyengo.com">
              </div> 
             
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
         <div class="col-md-6">
          <div class="card card-secondary">
             <div class="card-header">
              <label for="inputStatus">Link ảnh</label>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
             <div class="card-body">
                <div class="form-group">
                
				 <textarea name="Content_04" rows="9" cols="106" id="Content_04" placeholder="Mỗi link cách nhau dấu phẩy" class="form-control"></textarea>
              </div>
              

            </div>
          </div>
        </div>
         <div class="col-md-12">
           <div class="card card-secondary">
                 <div class="card-header">
            <label for="inputClientCompany">Nội dung</label>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
             <div class="card-body">
               <div class="form-group">
               
                   
				<textarea name="Content" class="form-control" rows="10" cols="106" id="Content" ></textarea>  
              </div>

            </div>
          </div>   
         </div>         
        
        
      </div>
       <div class="row">
            <div class="col-12">
            <div class="card card-primary">
            
            <div class="card-body">
         
            
               <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="hidenImg">
                  <label class="form-check-label">Hiện ảnh</label>
               </div>
               <div class="form-group" id="link_img">
                  <label for="pwd">Linh ảnh đã upload</label>
                  <textarea rows="7" id="Author" style="width:100%" class="form-control" ></textarea>	
               </div>
               <div class="form-group">
                           
   	           
				<input type="file"  name="files[]" id="uploadavatar" style="display: none;" multiple>
				<button class="btn btn-success btn-avatar" id="chon_hinh">Chọn hình</button>
				<button class="btn btn-warning" id="clear_hinh">Clear hình</button>
              </div>

           
                  <div class="btn-group w-100 mb-2">
                    <a class="btn btn-info active" href="javascript:void(0)" data-filter="all">Tất cả ảnh</a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="1"></a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="2"></a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="3"></a>
                    <a class="btn btn-info" href="javascript:void(0)" data-filter="4"></a>
                  </div>
                  <div class="mb-2">
         
                    <div class="float-right">
                      <select class="custom-select" style="width: auto;" data-sortOrder>
                        <option value="index"> Sort by Position </option>
                        <option value="sortData"> Sort by Custom Data </option>
                      </select>
                      <div class="btn-group">
                        <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                        <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                      </div>
                    </div>
                  </div>
                  <div class="filter-container p-0 row"></div>
                 <div class="form-group">
			    	<button class="btn btn-success" id-story="<?php echo $idStory; ?>" id="addChap" src-image="" disabled>Lưu</button>
			    	 <button type="button" class="btn btn-warning" id="previewChap">Xem thử</button>
                 </div> 
             
                </div>
           
          </div>
      </div>
      
       <div class="row">
        <div class="col-12">
         
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">mangavip</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<?php
$db->dis_connect();//ngat ket noi mysql	
?>
<!-- ./wrapper -->

<!-- jQuery -->
<script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<!-- Bootstrap 4 -->
<script type="text/javascript" src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script type="text/javascript" src="dist/js/adminlte.min.js"></script>
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<script type="text/javascript" src="frontend/file/jquery.caret.min.js"></script>
<script type="text/javascript" src="frontend/file/jquery.tag-editor.js"></script>	
<script type="text/javascript" src="frontend/file/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="frontend/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../page/frontend/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="../page/frontend/js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="js/page/addChap.js"></script>
<script src="toastr/toastr.min.js"></script>	
<script>
	CKEDITOR.replace('Content');
	var idStory=<?php echo json_encode($idStory)?>;
	var linkOption1=<?php echo json_encode($linkOption1)?>;
	
$(document).ready(function(){
    
    
    $('#chon_hinh').prop("disabled", true); 	
    $("#link_img").hide();	
    	
   	$("#Name").keyup(function(){
   	   
   	    var nameChap="";
   	     $('#chon_hinh').prop("disabled", false); 
   	     $('#addChap').prop("disabled", false); 
   	     nameChap=document.getElementById("Name").value;
	   fileupload(nameChap);
	});    	
   $("#hidenImg").change(function() {
        if(this.checked) {
          $("#link_img").show();
        }else
         $("#link_img").hide();
    });
    $("#clear_hinh").click(function(){
		$(".filter-container").html("");
	});	
     $('.btn-avatar').click(function(){ $('#uploadavatar').trigger('click');});
    
		function fileupload(nameChap){
           	$("#uploadavatar").fileupload({
        			url: "fileupload/uploadChap.php?idStory="+idStory+"&nameChap="+nameChap,
        			//dataType: 'json',
        			done: function (e, data) {
        			var k=JSON.parse(data.result);	
        			temp1=[];
        				var html="";
        			for(var index = 0; index < k.length; index++) {
        					var src = linkOption1+k[index];
        				    var src2 = k[index];
        					html+='<div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">';
                              html+='<a href="'+src+'" data-toggle="lightbox" data-title="sample 1 - white">';
                                html+='<img style="width:300px;height:300px" src="'+src+'" class="img-fluid mb-2 image-avatar" alt="white sample" custom_attribute="'+src2+'"/>';
                              html+='</a>';
                            html+='</div>';
                            	$('.filter-container').append(html);
        					
        			}
        						
        				$(".btn-avatar").text('Chọn Hình...');
        				
        			},
        			progressall: function (e, data) {
        				var progress = parseInt(data.loaded / data.total * 100, 10);
        				$(".btn-avatar").text(progress +"%");
        			},
        	
        	});
		}
 
});   
$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  }) 
  
  
 
  $(document).ready(function(){ 
	  $("#previewChap").click(function(){
		 var name=$("#Name").val();
		
		 var content=CKEDITOR.instances.Content.getData();
		
		 var site=$("#site").val();
		 var Content_04=$("#Content_04").val();
		 var Title=$("#Title").val();
		 var IdStory=$('#addChap').attr("id-story");
		 var tab_attribs = [];
		 var temp2=[];
		 var temp3=[];
		  //var check_link= $('#check_link :selected').text();
			$('img.image-avatar').each(function () {
				var temp1=$(this).attr("custom_attribute");
				var str1=temp1.substring(temp1.lastIndexOf("/")+1);
				var str2=str1.lastIndexOf(".");
				var str3=str1.substring(0,str2);
				const img = new images(temp1, str3);
				temp2.push(img);
			});
	    temp2.sort(function(a, b){return a.temp - b.temp});
		for(var i=0;i<temp2.length;i++){
			temp3.push(temp2[i].path);
		}
		if(Content_04 !="" && temp2!=""){
			  temp3=Content_04.split(',');
		}
	 $.ajax({     
	       url:'ajax/chap/tempAjax.php',
	       type:'POST',
	       cache:false,
	       data:{'idStory':idStory,'name':name,'content':content,'site':site,'Content_04':Content_04,'Title':Title,'link':temp3.toString()},
	       success:function(kq){
	       	var o = JSON.parse(kq);
	                 //console.log(kq);
	                 //alert(o.content);
				window.open("previewChap.php?idStory="+o.idStory+"&name="+o.name+"&content="+o.content+"&site="+o.site+"&Content_04="+o.Content_04+"&Title="+o.Title+"&link="+o.link, '_blank');
				  
	           }
	      })	  

	  });
});
</script>

</body>
</html>
