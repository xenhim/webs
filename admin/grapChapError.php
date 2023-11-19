
<!DOCTYPE html>
<html lang="en">
    
<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
    require_once('model/conn.php');
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
   $key="";
if(isset($_GET["key"]))
$key=$_GET["key"]
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
              <img src="#" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
              <img src="#" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="#" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
      $typeMenu="grapChapError";
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
            <h1>Cập nhật lại chap lỗi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cập nhật lại chap lỗi</li>
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
              <h3 class="card-title">Cập nhật lại chap lỗi</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
           
            <div class="card-body">
             <input type="text" name="key" size="50" id="key" value="<?=$key?>">
             <?php


$item_per_page = 17;
$current_page = !empty($_GET['page'])?tofloat($_GET['page']):1; //Trang hiện tại
$totalRecords=0;  
$story1=null;
if(!isset($_GET["key"])){
	$totalRecords=$db->GetStoryAdmin($item_per_page,$current_page,1,"");  
    $story1=$db->GetStoryAdmin($item_per_page,$current_page,0,""); 
echo '<table >';
  echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Update</th>';
	echo '<th>    </th>';
	echo '<th>Số chap</th>';
  
  
  echo '</tr>';
  foreach($story1 as $temp2){
	  $countChap=$db->GetCountChap($temp2["Id"]);
	  $countChapImg=$db->GetCountChapImg($temp2["Id"]);
	  
	  echo '<tr>';
		echo '<td>'.$temp2["Name"].'</td>';
		echo '<td><button class="s1" id="'.$temp2["Id"].'" type="button" data-id="'.$temp2["Id"].'" data-name="'.$temp2["Name"].'">Cập nhật</button></td>';
		echo '<td></td>';
		echo '<td>'.$countChap.'</td>';
	
		echo '<td>
		     <button class="lay1" dt-id="'.$temp2["Id"].'">lấy chương</button>
			  
		      <select class="cc1" id="from'.$temp2["Id"].'" df="to'.$temp2["Id"].'">
					
			  </select>
			 
		    
			 
		
		</td>';
			echo '<td class="col-md-5"><textarea  class="form-control" type="text" id="link'.$temp2["Id"].'" name="link_chap"></textarea></td>';
	  echo '</tr>';
  }
echo '</table>';
}else{
	
	$totalRecords=$db->GetStoryAdmin($item_per_page,$current_page,1,$key);  
    $story1=$db->GetStoryAdmin($item_per_page,$current_page,0,$key); 
	echo '<table >';
  echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Update</th>';
	echo '<th>    </th>';
	echo '<th>Số chap</th>';
	echo '<th>Chap</th>';
  echo '</tr>';
  foreach($story1 as $temp2){
	  $countChap=$db->GetCountChap($temp2["Id"]);
	  $countChapImg=$db->GetCountChapImg($temp2["Id"]);
	  
	  echo '<tr>';
		echo '<td>'.$temp2["Name"].'</td>';
		echo '<td><button class="s1" id="'.$temp2["Id"].'" type="button" data-id="'.$temp2["Id"].'" data-name="'.$temp2["Name"].'">Cập nhật</button></td>';
		echo '<td></td>';
		echo '<td>'.$countChap.'</td>';
	
		
		echo '<td>
		     <button class="lay1" dt-id="'.$temp2["Id"].'">lấy chương</button>
			  
		      <select class="cc1" id="from'.$temp2["Id"].'"  df="to'.$temp2["Id"].'">
		</td>';
		echo '<td class="col-md-5"><textarea  class="form-control" type="text" id="link'.$temp2["Id"].'" name="link_chap"></textarea></td>';
		
	  echo '</tr>';
  }
echo '</table>';
}


?>


	<?php
	$totalPages = ceil($totalRecords / $item_per_page);
	if ($current_page > 3) {
    $first_page = 1;
    ?>
	<a class="pagination-previous" href="grapChapError.php?page=<?= $first_page ?>&key=<?=$key?>"><span aria-hidden="true">«  </span></a>
    <?php
	}
if ($current_page > 1) {
    $prev_page = $current_page - 1;
    ?>
	<a class="pagination-link" href="grapChapError.php?page=<?= $prev_page ?>&key=<?=$key?>"><span aria-hidden="true">‹</span></a>
<?php }
?>
<?php for ($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if ($num != $current_page) { ?>
        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
			<a class="pagination-link" href="grapChapError.php?page=<?= $num ?>&key=<?=$key?>"><?= $num ?></a>
        <?php } ?>
    <?php } else { ?>      
		<a class="pagination-link is-current" href="javascript:void(0)"><?= $num ?></a>
    <?php } ?>
<?php } ?>
<?php
if ($current_page < $totalPages - 1) {
    $next_page = $current_page + 1;
    ?>
	<a class="pagination-link" href="grapChapError.php?page=<?= $next_page ?>&key=<?=$key?>"><span aria-hidden="true">›</span></a>
<?php
}
if ($current_page < $totalPages) {
    $end_page = $totalPages;
    ?>
	<a class="pagination-next" href="grapChapError.php?page=<?= $end_page ?>&key=<?=$key?>"><span aria-hidden="true">»</span></a>
    <?php
}
?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
       

      </div>
      <div class="row">
        <div class="col-12">
          <button type="button" class="btn btn-success" id="addAuthor" src-image="" src-path="">Lưu</button>
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
<script type="text/javascript">


$(document).ready(function(){
	var numchap=[];
   // $('#chon').change(function() {
        // if(!this.checked) {
           // $('span#khoang').hide();
        // }else{
			// $('span#khoang').show();
		// }
           
    // });
 
  $("#getlink").click(function(){
	  //alert(111);
	   var v=document.getElementById("key").value;
	   window.location.href = 'grapChapError.php?key='+v;
	
  });
  $("#key").keyup(function (e) {
	if (e.keyCode === 13) {
      var v=document.getElementById("key").value;
	   window.location.href = 'grapChapError.php?key='+v;
    }
      
  })
  $(".s1").click(function(){
       var id=$(this).attr("data-id");
	   var name=$(this).attr("data-name");
	   //var className = $('#'+id).attr('class');
	   var link_chap=$("#link"+id).val();
	   var from=$("#from"+id+" option:selected").text();
	   //var to=$("#to"+id+" option:selected").text();
 
		$('#'+id).prop("disabled", true); 
	    $("#"+id).text("Đang cập nhật...");	
	    if(link_chap !="" && from !=""){
		$.ajax({     
		   url:"ajax/chap/index3-ajax.php",
		   type:'POST',
		   cache:false,		  
		   data:{'id':id,'name':name,'from':from,'link_chap':link_chap},
		   success:function(kq){
				//console.log(kq);
				 toastr.success('Cập nhật thành công')
			   $('#'+id).prop("disabled", false); 
			   $("#"+id).text("Cập nhật");
			   $("#img"+id).text("Đã cập nhật");
				$('#img'+id).css("color", "green");
				var kk=parseInt(id)+1;
				var myEle = document.getElementById(kk);
				if(myEle){
					$('#'+kk).trigger('click');
				}
			 }
		   })
	    }else{
	        toastr.error('Link or chap đang rỗng');
	         $('#'+id).prop("disabled", false); 
			 $("#"+id).text("Cập nhật");
	    }
	   
  });
  
  $('.cc1').on('change', function() {  
      
	 var id=$(this).attr("df");
	 var v=this.value;
	 $('#'+id).prop("disabled", false);  
	 //$('#to'+id).find('option').remove();
	// console.log(id);
	 $('#'+id).html("");
	
	 for(var i=numchap.length-1;i>-1;i--){
		 
		if(parseFloat(numchap[i])>=parseFloat(v))
		$('#'+id).append($('<option/>').text(numchap[i]));
	 }
	 // for(var i=numchap.length-1;i>-1;i--){
				  // $("option[value='ttt"+id+i+"']").remove();
			// }
	
	  //$('#to'+id).html("");
			// for(var i=tt.length-1;i>-1;i--){
				// $('#to'+id).append($('<option/>').text(tt[i]));
			// }
			
  });

   $(".lay1").click(function(){
       //alert(1);
       var id=$(this).attr("dt-id");
	  
	
	$.ajax({     
	   url:"ajax/chap/index3-ajax-chap.php",
	   type:'POST',
	   cache:false,
	 
	   data:{'id':id},
	   success:function(kq){
		    var o = JSON.parse(kq);
			var kkk=o.Error;
			var tt=kkk.split(",");
			numchap=tt;
				$('#from'+id).html("");
			for(var i=tt.length-1;i>-1;i--){
				$('#from'+id).append($('<option/>').text(tt[i]));
			}

		 },error: function (e) {
		     toastr.error(e);
		
		}
	   })
  });
});
</script>

<?php
$db->dis_connect();//ngat ket noi mysql	
?>
</body>
</html>
