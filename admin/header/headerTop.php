<section class="top-bar on" id="home">
    <div class="container">
        <div class="level">
            <div class="level-left pc">
                <span class="logo">
                    <a href="../">xemtruyen</a>
                </span>
                <!-- /.logo -->
                <div class="top-search">
                    <input type="text" class="text-search" placeholder="Bạn cứ nhập từ khoá, còn lại để xemtruyen lo">
                    <button class="submit-btn btn_search"></button>
                    <div class="list-results">
                        <!-- Add class 'open' to open list results -->
                        <div class="title-search">Tìm kiếm gần đây</div>
                        <div class="list-container">

                        </div>
                    </div>
                    <!-- /.list-results -->
                </div>
                <!-- /.top-search -->
            </div>
            <div class="level-right">
                <ul class="top-links pc">
                    <li>
                        <a href="http://truyenqq.com/lich-su.html">Lịch sử</a>
                    </li>
                    <li>
                        <a href="http://truyenqq.com/truyen-dang-theo-doi.html">Theo dõi</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="download-app-link">
                            <span class="download-app-icon"></span> Tải App
                        </a>
                    </li>
                </ul>
                <!-- /.top-links -->

                <!--<div class="top-buttons has-login">
                                           
                        <button class="login-btn">Đăng nhập</button>
                        <button class="register-btn">Đăng ký</button>
               </div>-->
                <div class="top-buttons has-login">
                    <?php $user="admin" ; if($user=="" ){ ?>
                    <button class="login-btn">Đăng nhập</button>
                    <button class="register-btn">Đăng ký</button>
                    <?php }else{ ?>
                    <!--<div class="notify center open" data-id="notification">   unread-->
                    <div class="notify center unread" data-id="notification">
                        <i class="fas fa-bell"></i>
                        <div class="list-messages">
                            <div class="title-message">Thông báo</div>
                            <ul>
                                <!--<li class="message">-->
                                <li class="message unread">
                                    <a href="http://truyenqq.com/truyen-tranh/fairy-tail-100-year-quest-5212-chap-54.html">
                                        <div class="title-message-item">Thông Báo</div>
                                        <div class="content-message-item">kinglewwww vừa trả lời bình luận của bạn.</div>
                                        <p class="time"><i class="far fa-clock"></i>19:50 22/06/2020</p>
                                    </a>
                                </li>
                                <li class="message unread">
                                    <a href="http://truyenqq.com/truyen-tranh/fairy-tail-100-year-quest-5212-chap-54.html">
                                        <div class="title-message-item">Thông Báo</div>
                                        <div class="content-message-item">kingleppp vừa trả lời bình luận của bạn.</div>
                                        <p class="time"><i class="far fa-clock"></i>19:49 22/06/2020</p>
                                    </a>
                                </li>
                                <li class="message ">
                                    <a href="http://truyenqq.com/truyen-tranh/tien-vuong-trung-sinh-7879.html">
                                        <div class="title-message-item">Thông Báo</div>
                                        <div class="content-message-item">kingle vừa trả lời bình luận của bạn.</div>
                                        <p class="time"><i class="far fa-clock"></i>7:21 22/06/2020</p>
                                    </a>
                                </li>
                                <li class="message ">
                                    <a href="http://truyenqq.com/truyen-tranh/dap-toai-tien-ha-7719-chap-99.html">
                                        <div class="title-message-item">Thông Báo</div>
                                        <div class="content-message-item">qqqq vừa trả lời bình luận của bạn.</div>
                                        <p class="time"><i class="far fa-clock"></i>22:42 18/06/2020</p>
                                    </a>
                                </li>
                                <input id="id_notification" type="hidden" value="72652,72651" data-totalnotification="2">
                            </ul>

                        </div>
                    </div>
                    <div class="notify center">
                        <i class="fas fa-envelope"></i>
                        <div class="list-messages">
                            <div class="title-message">Tin nhắn</div>
                            <ul>
                                <li class="no-result" style="padding: 10px">Không Có Tin Nhắn Nào!</li>
								
								<li class="message unread">
                                    <a href="http://truyenqq.com/truyen-tranh/fairy-tail-100-year-quest-5212-chap-54.html">
                                        <div class="title-message-item">Thông Báo</div>
                                        <div class="content-message-item">kinglewwww vừa trả lời bình luận của bạn.</div>
                                        <p class="time"><i class="far fa-clock"></i>19:50 22/06/2020</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="notify center btn-search smp" for="focus-input"><i class="fas fa-search"></i>
                    </div>
                    <div class="notify user center">
                        <span class="avatar-menu"><img src="frontend/images/noavatar.png"></span>
                        <div class="notify btn-user smp"><i class="fas fa-user-circle"></i>
                        </div>
                        <ul class="user-links">
                            <li>
                                <a href=""><i class="fas fa-user-circle"></i> Quản lý tài khoản</a>
                            </li>
                            <li>
                                <a href=""><i class="fas fa-heart"></i> Truyện đang theo dõi</a>
                            </li>
                            <li>
                                <a href=""><i class="fas fa-history"></i> Lịch sử đọc truyện</a>
                            </li>

                            <li>
                                <a href=""><i class="fas fa-envelope"></i> Tin nhắn</a>
                            </li>
                            <li>
                                <a href=""><i class="fas fa-lock"></i> Đổi mật khẩu</a>
                            </li>
                            <li>
                                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                    <div class="head_menu smp"><span>&nbsp;</span>
                    </div>
                    <?php } ?>
                </div>
                <!-- /.top-buttons -->
            </div>
        </div>
    </div>
</section>
<div class="modal login-modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <span class="top-caption">
            Dù ai di ngược về xuôi,<br>
            đến giờ đọc truyện cứ vào QQ
        </span>
        <div>
            <!-- /.top-caption -->
            <div class="tabs-buttons">
                <button data-type="login">Đăng nhập</button>
                <button data-type="register">Đăng ký</button>
            </div>
            <!-- /.tabs-button -->
            <div class="tabs-contents">
                <div class="login-section">
                    <div class="form-login">
                        <input type="email" placeholder="Email" id="email_login">
                        <input type="password" placeholder="Mật khẩu" id="password_login">
                        <button type="submit" class="button_login btn btn-lg">Đăng nhập</button>
                        <a href="javascript:void(0);" class="forget-password-link">Quên mật khẩu</a>

                    </div>
                    <!--<div class="social-login">
                        <span>Hoặc đăng nhập bằng:</span>
                        <a href="" class="facebook-link"><span class="facebook-icon"></span></a>
                        <a href="" class="google-link"><span class="google-icon"></span></a>
                    </div>-->
                </div>
                <!-- /.login-section -->
                <div class="register-section">
                    <div class="form-login">
                        <input type="email" placeholder="Email" id="email_register">
                        <input type="password" placeholder="Mật khẩu" id="password_register">
                        <!--<div class="login-captcha">
                            <input type="text" class="form-control" id="captcha_register" name="captcha_register" placeholder="Mã xác nhận">
                            <img src="./chap_files/logo.png" alt="Mã Xác Nhận">
                            <span class="refresh-captcha" data-type="register"><i class="fas fa-sync-alt"></i></span>
                            <input type="hidden" name="captcha-register" id="captcha-register" value="">
                        </div>-->

                        <button type="submit" id="button_register">Đăng ký</button>
                    </div>
                </div>
            </div>
            <!-- /.register-section -->
        </div>
        <!-- /.tabs-contents -->
    </div>
</div>
<!-- /.login-modal -->
<div class="modal notify-modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <span class="top-caption">
            Quên mật khẩu hử !<br>
            Đã có QQ lo
        </span>
        <!-- /.top-caption -->
        <div class="forget-password-section">
            <span class="caption">Mật khẩu khôi phục sẽ được gởi qua email mà bạn đăng ký</span>
            <div class="form-forgot">
                <input type="email" placeholder="Email" id="email-forgot">
               
                <button type="submit" id="button-forgot">Gửi mật khẩu</button>
            </div>
        </div>
        <!-- /.forget-password-section -->
        <div class="sent-password-section">
            <span class="check-icon"></span>
            <span class="caption">Mật khẩu khôi phục đã được gởi bạn hãy kiểm tra trong hộp thư</span>
        </div>
        <!-- /.sent-password-section -->
        <a href="javascript:void(0);" class="back-to-login">Tôi muốn quay lại đăng nhập</a>
        <!-- /.back-to-login -->
    </div>
</div>
<?php require_once( 'function/function.php'); require_once( 'menu/menu.php'); ?>