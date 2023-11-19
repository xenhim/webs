
<!DOCTYPE html>
<html lang="en">
    
<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
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
   
?>    
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Author Add</title>

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
      $typeMenu="grap";
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
            <h1>Grap truyện</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Grap truyện</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Grap truyện</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            
     <div class="form-group">
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="nettruyen" name="customRadio" value="nettruyen" checked="">
                <label for="nettruyen" class="custom-control-label">nettruyen</label>
                
               
            </div>
            
            <div class="custom-control custom-radio">
                 <input class="custom-control-input" type="radio" id="truyenqq" name="customRadio" value="truyenqq">
                <label for="truyenqq" class="custom-control-label">truyenqq</label>
            </div>
            
             <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="truyenfull" name="customRadio" value="truyenfull">
            <label for="truyenfull" class="custom-control-label">truyenfull</label>
            </div>

    </div>         

<div class="form-group">
<label for="grap">Link grap</label>
<input type="text" class="form-control" id="grap" placeholder="Dán link cần grap truyện">
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

 
<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
<input type="checkbox" class="custom-control-input" id="customSwitch3" value="no">
<label class="custom-control-label" for="customSwitch3">Cập nhật lại tất cả</label>
</div>
</div>

<div class="form-group">
<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input" id="customSwitch1">
<label class="custom-control-label" for="customSwitch1">Dowload img</label>
</div>
</div>


<button type="button" class="btn btn-success" id="getlink">Thu thập</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
<!-- Bootstrap 4 -->
<script type="text/javascript" src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="frontend/file/jquery.caret.min.js"></script>
<script type="text/javascript" src="frontend/file/jquery.tag-editor.js"></script>	
<script type="text/javascript" src="frontend/file/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="frontend/js/jquery.ui.widget.js"></script>
<script src="toastr/toastr.min.js"></script>	
<script>
$(document).ready(function(){

 /*$('input[type=radio][name=customRadio]').change(function() {
     console.log(this.value);
    if (this.value == 'nettruyen') {
      $('#tom').slideUp();
    }
    else if (this.value == 'truyenqq') {
       $('#tom').slideDown();
    }else{
        $('#tom').slideUp();
    }
});*/
  $("#getlink").click(function(){
    var link=$("#grap").val();
   
    var waning=$("#waning").val();
    var x=$("#checkbox").is(":checked");
   if(x==true)
	   x=1;
   else x=0;
   
    var y=$("#customSwitch1").is(":checked");
   if(y==true)
	   y=1;
   else y=0;
   
   var country=$("#country").val();
   var badge=$("#Badge").val();
	  $("#getlink").text("Đang gửi...");		
	  $('#getlink').prop("disabled", true); 
		if( $("#nettruyen").is(":checked") ){ // check if the radio is checked            
		$.ajax({     
		   url:"nettruyen.php",
		   type:'POST',
		   cache:false,
		   data:{'link':link,'country':country,'badge':badge,'checkall':x,'checkimg':y,'waning':waning},
		   success:function(kq){
				console.log(kq);		   
			   var o = JSON.parse(kq);
			 
			   if(o.Error==1){
			       toastr.success('Thu thập thành công');
				
			   }
				else { 
					toastr.error('Lỗi thu thập');
				}
				$("#getlink").text("Thu thập");	
				$('#getlink').prop("disabled", false); 

			 },error: function(errorThrown){
				    $('#getlink').prop("disabled", false); 
				 	$("#getlink").text("Thu thập");	
				  toastr.warning('Đã kết thúc tiến trình');
						
			 }
		   })
        }else if( $("#truyenfull").is(":checked") ){ // check if the radio is checked            
		$.ajax({     
		   url:"truyenfull.php",
		   type:'POST',
		   cache:false,
		   data:{'link':link,'country':country,'badge':badge,'checkall':x,'checkimg':y,'waning':waning},
		   success:function(kq){
				console.log(kq);		   
			   var o = JSON.parse(kq);
			 
			   if(o.Error==1){
				 toastr.success('Thu thập thành công');
			   }
				else { 
					toastr.error('Lỗi thu thập');
				}
				$("#getlink").text("Thu thập");	
				$('#getlink').prop("disabled", false); 

			 },error: function(errorThrown){
				    $('#getlink').prop("disabled", false); 
				 	$("#getlink").text("Thu thập");	
				  toastr.warning('Đã kết thúc tiến trình');
						
			 }
		   })
        }
        
        else{
			/*var waning=$("#waning").val();
		   var link=$("#grap").val();
		   var x=$("#checkbox").is(":checked");
		   if(x==true)
			   x=1;
		   else x=0;
		   var country=$("#country").val();
		   var badge=$("#Badge").val();	*/
		var summarize=$("#summarize").val();
		
		
		if(link !="" && summarize !=""){		
		$.ajax({     
		   url:"truyenqq.php",
		   type:'POST',
		   cache:false,
		   data:{'link':link,'country':country,'badge':badge,'checkall':x,'summarize':summarize,'waning':waning,'checkimg':y},
		   success:function(kq){
				//console.log(kq);		   
			   var o = JSON.parse(kq);
			 
			   if(o.Error==1){
			    	toastr.success('Thu thập thành công');
			   }
				else { 
					toastr.error('Lỗi thu thập');
				}
				$("#getlink").text("Thu thập");	
				$('#getlink').prop("disabled", false); 

			 },error: function(errorThrown){
				 $('#getlink').prop("disabled", false); 
				 $("#getlink").text("Thu thập");	
				 toastr.warning('Đã kết thúc tiến trình');
				 //$("#getlink").trigger("click");			 
						
			 }
		   })
		 }else{
			 $('#getlink').prop("disabled", false); 
			 $("#getlink").text("Thu thập");	
		
			 toastr.warning('Chưa nhập đủ trường');
		 }
		}
  
  });
 
});
</script>
</body>
</html>
