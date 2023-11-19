<?php

$addAuthor="";$addChap="";$editChap="";$listChap="";$addStory="";$editStory="";$listStory="";
$addNews="";$listNews="";$editNews="";
$editAuthor="";$addGenre="";$editGenre="";$listGenre="";$addSlider="";$editSlider="";$listSlider="";
$listAuthor="";$advertisement="";$analytics="";$logo="";

$addAuthor1="";$addChap1="";$editChap1="";$listChap1="";$addStory1="";$editStory1="";$listStory1="";
$editAuthor1="";$addGenre1="";$editGenre1="";$listGenre1="";$addSlider1="";$editSlider1="";$listSlider1="";
$addNews1="";$listNews1="";$editNews1="";
$listAuthor1="";$advertisement1="";$analytics1="";$logo1="";
$dashboard1="";  
$dashboard="";
$listComment="";$listComment1=""; $listFeedback="";   $listFeedback1=""; 
$listUser="";$listUser1 ="";
$roleUser="";$roleUser1="";
$grapChapError="";$grapChapError1="";
$grap="";$grap1="";

$changeDomain1="";$changeDomain="";
switch ($typeMenu) {
  case "addAuthor":
      $addAuthor1="-open";
      $addAuthor="active";
    break;
  case "editAuthor":
     $editAuthor1="-open";
     $editAuthor="active";
    break;
  case "listAuthor":
     $listAuthor1="-open";
     $listAuthor="active";
    break;
  case "addChap":
     $addChap1="-open";
     $addChap="active";
    break;
  case "editChap":
    $editChap1="-open";
    $editChap="active";
    break;
  case "listChap":
    $listChap1="-open";
    $listChap="active";
    break; 
  case "addStory":
    $addStory1="-open";
    $addStory="active";
     break; 
  case "editStory":
    $editStory1="-open"; 
    $editStory="active"; 
    break;
  case "listStory":
    $listStory1="-open"; 
    $listStory="active"; 
    break;  
  case "addGenre":
    $addGenre1="-open";  
    $addGenre="active";
    break;  
  case "editGenre":
    $editGenre1="-open"; 
    $editGenre="active"; 
    break;
  case "listGenre":
    $listGenre1="-open"; 
    $listGenre="active"; 
    break;
  case "addSlider":
    $addSlider1="-open";  
    $addSlider="active";  
    break;  
  case "editSlider":
    $editSlider1="-open"; 
    $editSlider="active";
    break;
  case "listSlider":
    $listSlider1="-open"; 
    $listSlider="active"; 
    break; 
  case "advertisement":
    $advertisement1="-open"; 
    $advertisement="active";  
    break; 
  case "analytics":
    $analytics1="-open"; 
    $analytics="active";   
    break;  
  case "logo":
    $logo1="-open"; 
    $logo="active";  
    break; 
  case "listUser":
    $listUser1="-open"; 
    $listUser="active";  
    break;    
  case "listComment":
    $listComment1="-open"; 
    $listComment="active";  
    break;    
  case "roleUser":
    $roleUser1="-open"; 
    $roleUser="active";  
    break; 
  case "listFeedback":
    $listFeedback1="-open"; 
    $listFeedback="active";  
    break;   
  case "grap":
    $grap1="-open"; 
    $grap="active";  
    break;
  case "grapChapError":
    $grapChapError1="-open"; 
    $grapChapError="active";  
    break; 
  case "changeDomain":
    $changeDomain1="-open"; 
    $changeDomain="active";  
    break;   
  case "addNews":
      $addNews1="-open";
      $addNews="active";
    break;
  case "editNews":
     $editNews1="-open";
     $editNews="active";
    break;
  case "listNews":
     $listNews1="-open";
     $listNews="active";
    break;  
  default:
    $dashboard1="menu-open";  
    $dashboard="active";
}
?>
     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item <?=$dashboard1?>">
            <a href="index.php" class="nav-link <?=$dashboard?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Bàng điều khiển
                <i class="right fas fa-angle"></i>
              </p>
            </a>
           
          </li>
         
          <li class="nav-item menu<?=$addStory1.$editStory1.$listStory1?>">
            <a href="#" class="nav-link <?=$addStory.$editStory.$listStory?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý truyện
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
               <li class="nav-item">
                <a href="addStory.php" class="nav-link <?=$addStory?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm truyện</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listStory.php" class="nav-link <?=$listStory?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách truyện</p>
                </a>
              </li>
             
            </ul>
          </li>
          <?php
          if($addChap1 !="" || $editChap1 !="" || $listChap1 !=""){
          
          ?>
          <li class="nav-item menu<?=$addChap1.$editChap1.$listChap1?>">
            <a href="#" class="nav-link <?=$addChap.$editChap.$listChap?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý chương
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
               <li class="nav-item">
                <a href="addChap.php?idStory=<?php echo $idStory;?>" class="nav-link <?=$addChap?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm chương</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listChap.php?idStory=<?php echo $idStory;?>" class="nav-link <?=$listChap?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách chương</p>
                </a>
              </li>
             </ul>
            </li> 
            <?php
           }
            ?>
           <li class="nav-item menu<?=$addGenre1.$editGenre1.$listGenre1?>">
            <a href="#" class="nav-link <?=$addGenre.$editGenre.$listGenre?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý thể loại
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
               <li class="nav-item">
                <a href="addGenre.php" class="nav-link <?=$addGenre?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm thể loại</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listGenre.php" class="nav-link <?=$listGenre?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách thể loại</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item menu<?=$addAuthor1.$editAuthor1.$listAuthor1?>">
            <a href="#" class="nav-link <?=$addAuthor.$editAuthor.$listAuthor?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý tác giả
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="addAuthor.php" class="nav-link <?=$addAuthor?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm tác giả</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listAuthor.php" class="nav-link <?=$listAuthor?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách tác giả</p>
                </a>
              </li>
             
            </ul>
          </li>
           <li class="nav-item menu<?=$addSlider1.$editSlider1.$listSlider1?>">
            <a href="#" class="nav-link <?=$addSlider.$editSlider.$listSlider?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý slider
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="addSlider.php" class="nav-link <?=$addSlider?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listSlider.php" class="nav-link <?=$listSlider?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách slider</p>
                </a>
              </li>
             
            </ul>
          </li>
           <li class="nav-item menu<?=$listUser1.$roleUser1?>">
            <a href="#" class="nav-link <?=$listUser.$roleUser?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý user
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="listUser.php" class="nav-link <?=$listUser?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách user</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item menu<?=$listComment1?>">
            <a href="#" class="nav-link <?=$listComment?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý bình luận
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="listComment.php" class="nav-link <?=$listComment?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách bình luận</p>
                </a>
              </li>
             
            </ul>
          </li>
          
           <li class="nav-item menu<?=$addNews1.$editNews1.$listNews1?>">
            <a href="#" class="nav-link <?=$addNews.$editNews.$listNews?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý bài viết
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="addNews.php" class="nav-link <?=$addNews?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm bài viết</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listNews.php" class="nav-link <?=$listNews?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách bài viết</p>
                </a>
              </li>
             
            </ul>
          </li>
          
          </li>
          <li class="nav-item <?=$grap1?>">
            <a href="grap.php" class="nav-link <?=$grap?>">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Grap truyện</p>
            </a>
          </li>
           <li class="nav-item <?=$grapChapError1?>">
            <a href="grapChapError.php" class="nav-link <?=$grapChapError?>">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Grap truyện lỗi</p>
            </a>
          </li>
           <li class="nav-item <?=$advertisement1?>">
            <a href="advertisement.php" class="nav-link <?=$advertisement?>">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p class="text">Đăng quảng cáo</p>
            </a>
           </li>
          <li class="nav-item <?=$listFeedback1?>">
            <a href="listFeedback.php" class="nav-link <?=$listFeedback?>">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p class="text">Danh sách phản hồi</p>
            </a>
           </li>
          <li class="nav-item <?=$logo1?>">
            <a href="logo.php" class="nav-link <?=$logo?>">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p>Logo</p>
            </a>
           </li>
           
          </li>
           <li class="nav-item <?=$analytics1?>">
            <a href="analytics.php" class="nav-link <?=$analytics?>">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Google analytics</p>
            </a>
          </li>
          <li class="nav-item <?=$changeDomain1?>">
            <a href="changeDomain.php" class="nav-link <?=$changeDomain?>">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Đổi tên miền</p>
            </a>
          </li>
        </ul>
      </nav>
      
      