<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
require_once('model/connection.php');
require_once('function/function.php');
?>
<!DOCTYPE html>
<html lang="en">
    
<?php
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
	$id=$_GET['idStory'];
	
	$arr_Story=$db->GetIdStory($id);
	
	
	if(!isset($arr_Story[1]))
	$arr_Story[1]="";
	if(!isset($arr_Story[2]))
	$arr_Story[2]="";
	if(!isset($arr_Story[4]))
	$arr_Story[4]="";
	if(!isset($arr_Story[12]))
	$arr_Story[12]="";
	
	if(!isset($arr_Story[7]))
	$arr_Story[7]="";
	if(!isset($arr_Story[8]))
	$arr_Story[8]="";
	
	
	$arr_genres= $db->GetGenre();
	$arr_authors= $db->GetAuthor();
	$arr_countrys=$db->GetCountry();
	
	$arr_authors1=array();
	foreach($arr_authors as $muc)
	{
		array_push($arr_authors1,$muc['Name']);
		 
	}	
	
?>    
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | sua truyen</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
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
       $typeMenu="editStory";
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
            <h1>Thêm truyện mới</h1>
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
              <h3 class="card-title">Thông tin truyện</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            
              <div class="form-group">
                <label for="inputName">Tên truyện</label>
                <input type="text" id="Name" class="form-control" value="<?php echo $arr_Story[1] ?>">
              </div>
             
              <div class="form-group">
                <label for="inputDescription">Tên khác</label>
                 <input type="text" id="NameOther" class="form-control" value="<?php echo $arr_Story[2] ?>">
               
              </div>
              <div class="form-group">
                <label for="inputStatus">Trạng thái</label>
                <select id="Status" class="form-control custom-select">
                 	<?php if($arr_Story[3]=="Đang tiến hành"){
							echo "<option selected>Đang tiến hành</option>";
							echo "<option>Hoàn Thành</option>";
						}else{
							echo "<option>Đang tiến hành</option>";
							echo "<option selected>Hoàn Thành</option>";
						}
					?>
                </select>
              </div>
               <div class="form-group">
                <label for="inputDescription">Nội dung</label>
                <textarea id="Content" class="form-control" rows="4"><?php echo $arr_Story[4] ?></textarea>
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Hot/new</label>
                <select id="Badge" class="form-control custom-select">
                  <?php 
					if($arr_Story[5]=="Chọn"){
						echo "<option selected>Chọn</option>";
						echo "<option>Hot</option>";
						echo "<option>New</option>";
						echo "<option>Videos</option>";
					}else if($arr_Story[5]=="Hot"){
						echo "<option>Chọn</option>";
						echo "<option selected>Hot</option>";
						echo "<option>New</option>";
					}else if($arr_Story[5]=="New"){
						echo "<option>Chọn</option>";
						echo "<option>Hot</option>";
						echo "<option selected>New</option>";
					}else if($arr_Story[5]=="New"){
						echo "<option>Chọn</option>";
						echo "<option>Hot</option>";
						echo "<option>New</option>";
						echo "<option selected>Videos</option>";
					}
				  ?>			
                </select>
              </div>
               <div class="form-group">
                <label for="inputClientCompany">Cảnh báo</label>
                <select id="Waning" class="form-control custom-select">
                 <?php 
					if($arr_Story[6]=="Thường"){
						echo "<option selected>Thường</option>";
						echo "<option>Nhạy Cảm</option>";
					}else if($arr_Story[6]=="Nhạy Cảm"){
						echo "<option>Thường</option>";
						echo "<option selected>Nhạy Cảm</option>";
					}
				 ?>
                </select>
              </div>
               <div class="form-group">
                <label for="inputClientCompany">Thể loại</label>
                    <?php
						$Genres=array();
				
					 
						   foreach($arr_genres as $muc)
							{
								array_push($Genres,$muc['Name']);
								 
							}	
						?>
				<textarea rows="2" id="Genre" style="width:100%"></textarea>
              </div>
               <div class="form-group">
                <label for="inputClientCompany">Tác giả</label>
                   
					<textarea rows="2" id="Author" style="width:100%"></textarea>		
              </div>
               <div class="form-group">
                <label for="inputClientCompany">Quốc gia</label>
                <select id="inputStatus" class="form-control custom-select">
               	<?php
				   foreach($arr_countrys as $muc3)
					{
					
						if($arr_Story[9]==$muc3['Name']){
						   echo '<option selected>'.$muc3['Name'].'</option>'; 
						}else{
							 echo '<option>'.$muc3['Name'].'</option>'; 
						}
						 
					}	
				?>		
                </select>
              </div>
               <div class="form-group">
                <label for="inputClientCompany">Loại</label>
                <select id="Gender" class="form-control custom-select">
                 	<?php									
					if($arr_Story[13]==0 && $arr_Story[14]==1){										
						echo '<option>Truyện tranh</option>';
					    echo '<option selected>Truyện Chữ</option>';
					}else if($arr_Story[13]==1 && $arr_Story[14]==0){										
						echo '<option selected>Truyện Tranh</option>';
					    echo '<option>Truyện Chữ</option>';
					} 
					 
					?>
                </select>
              </div>
               <div class="form-group">
                <label for="inputName">Link thu thập</label>
                <input type="text" id="URL" class="form-control" value="<?php echo $arr_Story[12]?>">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
         <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Ảnh đại diện</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
               <div class="form-group">
                   	<?php
						$path=$db->GetAvatarStory($id);
					?>
               	<div class="img"><img id="idAvatar" class="image-avatar" src="<?php echo $linkOption1.$path;?>" alt=""  /></div>
                    <input type="file" multiple="false" name="file" id="uploadavatar" style="display: none;">
                    <button class="btn btn-success btn-avatar" id="chon_hinh">Chọn hình</button>
              </div>
               
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <div class="row">
        <div class="col-12">
          <button type="button" class="btn btn-success" id="editStory" data-id="<?php echo $id?>" src-image="<?php echo $path?>">Lưu</button>
          <button type="button" class="btn btn-warning" id="previewStory">Xem thử</button>
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
	$Genres=array();
	   foreach($arr_genres as $muc)
		{
			array_push($Genres,$muc['Name']);
			 
		}	
		//$Genres2=array();

	  $Genres4=$arr_Story[8];
	  $Author4=$arr_Story[7];
   
$db->dis_connect();//ngat ket noi mysql	
?>
<!-- ./wrapper -->

<!-- jQuery -->
<script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script type="text/javascript" src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="frontend/file/jquery.caret.min.js"></script>
<script type="text/javascript" src="frontend/file/jquery.tag-editor.js"></script>	
<script type="text/javascript" src="frontend/file/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="frontend/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../page/frontend/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="../page/frontend/js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="js/page/addStory.js"></script>
<script src="toastr/toastr.min.js"></script>	
<script>
var id=<?php echo json_encode($id)?>;
$(document).ready(function(){
     nameStory=document.getElementById("Name").value;
	 fileupload(nameStory);
   	$("#Name").keyup(function(){
   	   
   	    var nameStory="";
   	     $('#chon_hinh').prop("disabled", false); 
   	     nameStory=document.getElementById("Name").value;
	   fileupload(nameStory);
	});    	
   $("#checkbox").change(function() {
        if(this.checked) {
          
        }
    });

     $('.btn-avatar').click(function(){ $('#uploadavatar').trigger('click');});
    
		function fileupload(nameStory){
    		 $("#uploadavatar").fileupload({
    			url: "fileupload/uploadStory.php?idStory="+id+"&nameStory="+nameStory,
    			//dataType: 'json',
    			done: function (e, data) {	
    				
    			var k= JSON.parse(data.result);	
    			console.log(k.name);
    				if(k.path==""){
    					
    					alert("Upload fail!!!");
    				}else{
    					if($('#inputDelImage').val() == ''){
    							$('#inputDelImage').val($('#avatar').val());
    						}else{
    							$('#inputDelImage').val($('#inputDelImage').val() + ',' + $('#avatar').val());
    						}
    						//alert(data.result.path);
    						$("#editStory").attr("src-image",k.path2);
    						
    						$(".image-avatar").attr("src",k.path);
    						//$("#avatar").val(data.result.path);
    				}				
    				
    				
    				$(".btn-avatar").text('Chọn Hình...');
    			},
    			progressall: function (e, data) {
    				//alert(data.loaded);
    				var progress = parseInt(data.loaded / data.total * 100, 10);
    				$(".btn-avatar").text(progress +"%");
    			},
    	
    		});
		}
 
});   
    
</script>


<script>
	  

 $(function() {
		 var m=<?php echo json_encode($Genres)?>;
		 var m2=<?php echo json_encode($Genres4)?>;
		 
		 var u2= <?php echo json_encode($Author4)?>;
		
		 var js_array = [<?php echo '"'.implode('","', $Genres).'"' ?>];
		 var js_array_au = [<?php echo '"'.implode('","', $arr_authors1).'"' ?>];
		
		 var m3 = m2.split(",");
		 var u3 = u2.split(",");
		$('#Genre').tagEditor({
			autocomplete: { delay: 0, position: { collision: 'flip' }, source:js_array  },
			forceLowercase: false,
			initialTags: m3,
			placeholder: 'Genre ...'
		});
		$('#Author').tagEditor({
                autocomplete: { delay: 0, position: { collision: 'flip' }, source:js_array_au  },
                forceLowercase: false,
				initialTags: u3,
                placeholder: 'Author ...'
        });

	});
	
	
$(document).ready(function(){ 
	  $("#previewStory").click(function(){
	
		  var Avatar=$("#editStory").attr("src-image");
		 
		  var Name=$("#Name").val();
		  
		  var Gender= $('#Gender :selected').text();
		  var URL=$("#URL").val();
		 
		  var Status= $('#Status :selected').text();
		  var Badge=$('#Badge :selected').text();
		  var Genre="";
		  var g_1=",";
		  var tags = $("#Genre").tagEditor('getTags')[0].tags;
				for (i = 0; i < tags.length; i++) { 
				    if(i==0)
				    Genre+=tags[i];
				    else
					Genre+=g_1+tags[i];
				}
	      var Author="";
		 
		  var tags2 = $("#Author").tagEditor('getTags')[0].tags;
			for (i = 0; i < tags2.length; i++) { 
			    
			    if(i==0)
				    Author+=tags2[i];
				    else
					Author+=g_1+tags2[i];
			
			}		 
		  var Country=$('#Country :selected').text();
		  var Waning=$('#Waning :selected').text();
		 
		  var NameOther=$("#NameOther").val();
		  var Content=$("#Content").val();
		  
		  if(NameOther==""){
			  NameOther="Đang Cập Nhật";
		  }
		  if(Content==""){
			  Content="Đang Cập Nhật";
		  }
		
window.open("previewStory.php?idStory=0&_name="+Name+"&_nameOther="+NameOther+"&_status="+Status+"&_content="+Content+"&_hot="+Badge+"&_waning="+Waning+"&_genre="+Genre+"&_author="+Author+"&_country="+Country+"&_link="+Avatar+"", '_blank');
	  });
});	
</script>
</body>
</html>
