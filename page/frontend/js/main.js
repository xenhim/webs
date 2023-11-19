$(document).ready(function () {
    'use strict'
    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i)
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i)
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i)
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i)
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i)
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows())
        }
    }

    if(device == 0){
        $(".qtip").hover(function () {
            var e = $($(this).data("qtip"));
            if (!e.length) return !1;
            $('<div id="info_tip"></div>').html(e.html()).appendTo("body").fadeIn("300")
        }, function () {
            $("#info_tip").remove()
        }).mousemove(function (e) {
            var t = e.pageX + 20, i = e.pageY + 10;
            var width = $(document).width()/2;
            var height = $(window).height()/2;

            if(e.pageX > width && width < $(document).width()){
                t = t - $("#info_tip").width() - 50;
            }
            if(e.clientY > height && height < $(window).height()){
                i = i - $("#info_tip").height() - 40;
            }
            $("#info_tip").css({top: i, left: t});
        })
    }

    var div_width = $('#div_suggest .scroll').width();
    if($('#list_suggest li').length * 190 >= div_width){
        setInterval(function(){ scroll_div('right') }, 5000);
        $('#div_suggest .scroll').show();
    }

    $('.mega_menu').click(function(e){
        e.preventDefault();
        $(this).toggleClass('open');
        $(this).parent().find('.book_tags').toggleClass('expanded');
    });

    var autocomplete = null;
    $("#search_input").bind( "keyup", function( event ) {
        var that = $(this);
        var keyWord = $(this).val();
        var key = event.keyCode;
        if (key != 38 && key != 40 && key != 37 && key != 39 && key != 13) {
            if(keyWord.trim().length > 0){
                clearTimeout(autocomplete);
                autocomplete = setTimeout(function(){
                    $.ajax({
                        type: "POST",
                        url: urlSearch,
                        data: { search: keyWord, type: 0}
                    }).done(function( msg ) {
                        $('.search_result').addClass('open');
                        $('.search_result ul').html(msg);
                    });
                }, 500);
            }else{
                $('.list-results').removeClass('open');
            }
        }else if(keyWord.trim().length > 0 && that.is(":focus") == true && key == 13 && $('.list-results .active').length == 0) {
            var text = $(that).val();
            window.location.href = document.location.origin + "/tim-kiem.html?q=" + text;
        }
    });
    $(document).on("keypress", ".popup .module_login input",function (e) {
        if(e.which == 13) {
            var textError = "";
            if ($('#email_login').val().trim() == "") {
                textError += "Email không được để trống.\n";
            } else if (validateEmail($('#email_login').val().trim()) == false) {
                textError += "Định dạng email không chính xác.\n";
            }
            if ($('#password_login').val().trim() == "") {
                textError += "Mật khẩu không được để trống.\n";
            } else if ($('#password_login').val().trim().length <= 6) {
                textError += "Mật khẩu phải lớn hơn 6 ký tự.\n";
            }
            if (textError != "") {
                alert(textError);
            } else {
                $.ajax({
                    type: 'POST',
                    cache: false,
                    url: urlLogin,
                    dataType: "json",
                    data: {email: $('#email_login').val(), password: $('#password_login').val(), expire: 1},
                    success: function (dataResult) {
                        if (dataResult['status'] == '0') {
                            var textError = "";
                            for (var key in dataResult['error']) {
                                textError += dataResult['error'][key] + "\n";
                            }
                            alert(textError);
                            event.preventDefault();
                        } else {
                            location.reload(true);
                        }
                    }
                });
            }
        }
    });
    $('#search_input').click(function(){
        var keyWord = $(this).val();
        if($(this).val() != '' && $('.search_result').hasClass('open') == false){
            $.ajax({
                type: "POST",
                url: urlSearch,
                data: { search: keyWord, type: 0}
            }).done(function( msg ) {
                $('.search_result').addClass('open');
                $('.search_result ul').html(msg);
            });
        }else if($('.search_result ul').html().trim() != ''){
            $('.list-results').addClass('open');
        }
    });

    $('body').click(function(event) {
        if (!$(event.target).closest('.search_result').length && !$(event.target).closest('#search_input').length) {
            $('.search_result').removeClass('open');
        }
        if (parseInt($(event.target).closest('.profile').length) == 0) {
            $('#member_control').hide();
        }
        if (!$(event.target).closest('.list-messages').length && !$(event.target).closest('.icon-notification').length) {
            $('.list-messages').addClass('hidden')
        }
    })
    $(document).on("click", ".popup .button-forgot",function (e) {
        var textError = "";
        if($('#email-forgot').val().trim() == ""){
            textError += "Email không được để trống.\n";
        }else if(validateEmail($('#email-forgot').val().trim()) == false){
            textError += "Định dạng email không chính xác.\n";
        }

        if($('#captcha_forgot').val().trim() == ""){
            textError += "Mã xác nhận không được để trống.\n";
        }

        if(textError != ""){
            captcha('forgot');
            alert(textError);
        }else{
            event.preventDefault();
            $.ajax({
                type: 'POST',
                cache: false,
                url: urlForgot,
                dataType: "json",
                data: {
                    email: $('#email-forgot').val(),
                    captcha: $('#captcha_forgot').val(),
                    id_captcha: $('#captcha-forgot').val()
                },
                success: function(dataResult){
                    if(dataResult['status'] == '0'){
                        var textError = "";
                        for (var key in dataResult['error']) {
                            textError += dataResult['error'][key] + "\n";
                        }
                        alert(textError);
                    }else{
                        $('.module_success').show();
                        $('.module_forgot').hide();
                    }
                }
            });
        }
    });

    $(document).on("click", '.icon-notification', function (event) {
        if($('.list-messages').hasClass('hidden')){
            $('.list-messages').removeClass('hidden');
            if($('#id_notification').val() != ''){
                $.ajax({
                    type: 'POST',
                    cache: false,
                    url: urlNotification,
                    data: {id: $('#id_notification').val()},
                    success: function(data){
                        $('.icon-notification .num').text(0);
                        $('#id_notification').val('');
                    }
                });
            }
        }else{
            $('.list-messages').addClass('hidden');
        }
    })

    $(document).on("click", '.button_login', function (event) {
        var textError = "";
        if($('#email_login').val().trim() == ""){
            textError += "Email không được để trống.\n";
        }else if(validateEmail($('#email_login').val().trim()) == false){
            textError += "Định dạng email không chính xác.\n";
        }
        if($('#password_login').val().trim() == ""){
            textError += "Mật khẩu không được để trống.\n";
        }else if($('#password_login').val().trim().length <= 6){
            textError += "Mật khẩu phải lớn hơn 6 ký tự.\n";
        }
        if(textError != ""){
            alert(textError);
        }else{
            $.ajax({
                type: 'POST',
                cache: false,
                url: urlLogin,
                dataType: "json",
                data: {email: $('#email_login').val(),  password: $('#password_login').val(), expire: 1},
                success: function(dataResult){
                    if(dataResult['status'] == '0'){
                        var textError = "";
                        for (var key in dataResult['error']) {
                            textError += dataResult['error'][key] + "\n";
                        }
                        alert(textError);
                        event.preventDefault();
                    }else{
                        location.reload(true);
                    }
                }
            });
        }
    });


    $(".genre-item").click(function() {
        var e = $(this).find("span");
        e.hasClass("icon-checkbox") ? e.removeClass("icon-checkbox").addClass("icon-tick") : e.hasClass("icon-tick") ? e.removeClass("icon-tick").addClass("icon-cross") : e.removeClass("icon-cross").addClass("icon-checkbox")
    })
    $(".btn-search").click(function() {
        var e = $(".btn-reset").attr("href"),
            t = "",
            a = "",
            n = "",
            i = "";
        $.each($(".genre-item span"), function(e, o) {
            $(o).hasClass("icon-tick") ? (t += n + $(o).attr("data-id"), n = ",") : $(o).hasClass("icon-cross") && (a += i + $(o).attr("data-id"), i = ",")
        })
        location.href = e + "?category=" + t + "&notcategory=" + a + "&country=" + $("#country").val() + "&status=" + $("#status").val() + "&minchapter=" + $("#minchapter").val() + "&sort=" + $("#sort").val()
    })


    $(document).on('click', ".subscribeBook", function() {
        var selector = $(this);
        var id = selector.data('id');
        var page = selector.data('page');
        $.ajax({
            url: urlSubcribe,
            type: "POST",
            data: {id: id},
            success: function (data) {
                if (data != '') {
                    if(page == 'index'){
                        if (data == 0) {
                            selector.html('<span class="fa fa-heart"></span> Theo dõi');
                        } else {
                            selector.html('<span class="fa fa-times"></span> Hủy theo dõi');
                        }
                    }else{
                        if (data == 0) {
                            selector.html('<i class="fa fa-heart"></i> <span>Theo dõi</span>');
                            selector.removeClass('btn-unsubscribe').addClass('btn-subscribe');
                        } else {
                            selector.html('<i class="fa fa-times"></i> <span>Hủy theo dõi</span>');
                            selector.removeClass('btn-subscribe').addClass('btn-unsubscribe');
                        }
                    }
                }
            }
        });
    });
    $('.story-detail-info').readmore({
        maxHeight: 60,
        speed: 100,
        moreLink: '<p class="readmore"><a href="#">Xem Thêm</a></p>',
        lessLink: '<p class="readmore"><a href="#">Rút Gọn</a></p>',
        embedCSS: true,
        sectionCSS: 'display: block; width: 100%;',
        startOpen: false,
        expandedClass: 'readmore-js-expanded',
        collapsedClass: 'readmore-js-collapsed'
    });
    var runlike = 0;
    $(document).on('click', ".btn-like", function() {
        var selector = $(this);
        var id = selector.data('id');
        if(runlike == 0){
            runlike = 1;
            $.ajax({
                url: urlLike,
                type: "POST",
                data: {id: id},
                success: function (data) {
                    data = $.parseJSON(data);
                    if(data['success'] == 1){
                        $('.number-like').text(parseInt($('.number-like').text()) + 1);
                    }else{
                        alert(data['error']);
                    }
                    runlike = 0;
                }
            });
        }
    });
    $(document).on('click', '.changeserver', function(){
        var server = parseInt($(this).find('span').text());
        var max = parseInt($('.loadchapter:visible').length);
        if(server < max){
            changeServer(server + 1);
            $(this).find('span').text(server + 1);
        }else{
            changeServer(1);
            $(this).find('span').text(1);
        }

    });

    $(document).on('click', '#submit_error', function(){
        var contentError = $("#report_error_text").val();
        var typeError = $("#report_error_title").val();
        var order = $("#episode_name").val();
        var book_id = $("#book_id").val();
        var episode_id = $("#episode_id").val();
        var txtError = '';
        if(typeError == 0){
            txtError += 'Vui Lòng Chọn Lỗi.\n';
        }
        if(txtError != ''){
            alert(txtError);
        }else{
            $.ajax({
                type: 'POST',
                cache: false,
                url: urlError,
                data: { episode_id: episode_id, contentError: contentError, book_id: book_id, typeError: typeError, order:order},
                success: function(data){
                    data = $.parseJSON(data);
                    if(data['status'] == 0){
                        for (var key in data['error']) {
                            txtError += data['error'][key] + '\n';
                        }
                        alert(txtError);
                    }else{
                        $('.popup').hide();
                        alert('Cảm ơn bạn đã báo lỗi.');
                    }
                }
            });
        }
    });
    var runLikeComment = 0;
    $(document).on('click', ".like-comment", function() {
        var selector = $(this);
        var id = selector.data('id');
        if(runLikeComment == 0){
            runLikeComment = 1;
            $.ajax({
                url: urlLikeComment,
                type: "POST",
                data: {id: id},
                success: function (data) {
                    data = $.parseJSON(data);
                    if(data['success'] == 1){
                        selector.find('.total-like-comment').text(parseInt(selector.find('.total-like-comment').text()) + 1);
                    }else{
                        alert(data['error']);
                    }
                    runLikeComment = 0;
                }
            });
        }
    });
    var checkImage = setInterval (function (){
        if ($('.chapter_content #page_1').height() < 20){
            if($('.chapter_content #page_1 img').attr('src').indexOf("tintruyen.net") > -1){
                changeServer(4);
            }else{
                //changeServer(2);
            }
        }
        clearInterval(checkImage);
    }, 2000);
    if($('.chapter_content img.lazy').last().attr("data-cdn") !== undefined){
        $('.server-chap').show();
    }
    $(".remove-subscribe").click(function() {
        var id = $(this).data('id');
        $.ajax({
            url: linkRemoveSubscribe,
            type: "POST",
            data: {id:id},
            success: function(data){
                location.reload(true);
            }
        });
    });
    $(".remove-history").click(function() {
        var id = $(this).data('id');
        $.ajax({
            url: urlHistory,
            type: "POST",
            data: {id:id},
            success: function(data){
                location.reload(true);
            }
        });
    });
    $(".story-list-bl01 .text-center .btn-collapse").click(function() {
        if($(".story-list-bl01 .text-center .btn-collapse .show-text").hasClass('hidden')){
            $(".story-list-bl01 .text-center .btn-collapse .show-text").removeClass('hidden');
            $(".story-list-bl01 .text-center .btn-collapse .hide-text").addClass('hidden');
            $(".advsearch-form").addClass('hidden');
        }else{
            $(".story-list-bl01 .text-center .btn-collapse .hide-text").removeClass('hidden');
            $(".story-list-bl01 .text-center .btn-collapse .show-text").addClass('hidden');
            $(".advsearch-form").removeClass('hidden');
        }
    });
    $(window).scroll(function() {
        $(this).scrollTop() > 100 ? $("#back-to-top").fadeIn() : $("#back-to-top").fadeOut()
    });
    $("#back-to-top").click(function() {
        return $("body,html").animate({
            scrollTop: 0
        }, 800), !1
    })
    $(document).on('change', ".selectEpisode", function() {
        window.location.href = $(this).val();
    });

    if (window.location.hash == '#_=_'){
        if (history.replaceState) {
            var cleanHref = window.location.href.split('#')[0];
            history.replaceState(null, null, cleanHref);
        } else {
            window.location.hash = '';
        }
    }
    $('.story-list-bl01 #category').change(function(){
        window.location.href = $(this).val();
    });
    $('.story-list-bl01 #category-sort').change(function(){
        window.location.href = $(this).val();
    });
    var header2 = $('.chapter_control');
    if(header2.length > 0 && device == 1){
        var lastScrollTop = 0;
        $(window).on('resize scroll', function() {
            var visible = $(".bottom-chap").isInViewport();
            var st = $(this).scrollTop();
            if(st < lastScrollTop || visible == true) {
                $('#back-to-top').show();
                header2.show();
            } else if(visible == false){
                header2.hide();
                $('#back-to-top').hide();
            }
            lastScrollTop = st;
        });
    }

    jQuery.fn.isInViewport = function() {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return (elementTop < viewportBottom);
    }
    if (typeof NodeList.prototype.forEach !== 'function')  {
        NodeList.prototype.forEach = Array.prototype.forEach;
    }
    $(document).on( "keyup", "body", function( event ) {
        if (
            !$(event.target).closest('.search_result').length && !$(event.target).closest('#search_input').length
            && !$(event.target).closest('.comment-container textarea').length
        ) {
            switch (event.keyCode) {
                case 37:
                    var linkPrev = $('.link-prev-chap').attr('href');
                    if(typeof linkPrev != 'undefined') {
                        window.location = linkPrev;
                    }
                    break;
                case 39:
                    var linkNext = $('.link-next-chap').attr('href');
                    if(typeof linkNext != 'undefined'){
                        window.location = linkNext;
                    }
                    break;
            }
        };
    })
    lazyload();
    $('.lazy').Lazy({
        threshold: 2000
    });
    $('.hero-item.has-excerpt').on('mouseenter', function () {
        $(this).addClass('open')
    }).on('mouseleave', function () {
        $(this).removeClass('open')
    })
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && getCookie('setting_dark_mode') == false) {
        $('body').removeClass('light').addClass('dark');
        $('footer').removeClass('light').addClass('dark');
        setCookie('setting_dark_mode','dark');
    }
    $(document).on('click', ".ads_close_mobile", function() {
        $('#ads_mobile').remove();
        setCookie2('mobile_banner', '1', 120);
    });
    $(document).on('click', ".aanetwork-pto-143", function() {
        setCookie2('pto-banner', '1', 7200);
    });
    $(document).on('click', ".aanetwork-ads-banner-box-fix > div a:eq(1)", function() {
        setCookie2('top-fix-banner', '1', 7200);
        $('.aanetwork-ads-banner-box-fix').remove();
    });
    $(document).on('click', ".ad_close", function() {
        $('#left-banner').remove();
        setCookie2('left_banner', '1', 900);
    });

    $(document).on( "click", ".image_popup", function( event ) {
        closeads('preload_ads');
        closeads('preload_banner_mobile');
    })
    if($('#image_popup').length > 0){
        $('#image_popup').show();
    }

    if($('#image_popup_mobile').length > 0){
        $('#image_popup_mobile').show();
    }

})
function findChapter() {
    var e = $(".chapter-list-modal input").val();
    e.length > 0 ? (e = e.toLowerCase(), $(".chapter-list-modal .chapter-list a").each((function() {
        var t = $(this).text().toLowerCase().replace("chương ", "");
        t.indexOf(":") > -1 && (t = t.substring(0, t.indexOf(":") + 1)), 0 == t.indexOf(e) ? $(this).show() : $(this).hide()
    }))) : $(".chapter-list-modal a").show()
}
div_suggest_margin = 0;
function scroll_div(target){
    var div_width = $('#div_suggest .scroll').width();
    var num_block = $('#list_suggest li').length;
    var max_block = Math.floor(div_width/190);
    if(target == 'right'){
        if(div_suggest_margin == -10){
            div_suggest_margin = div_width - (((max_block+1)*190) - 10);
        }else{
            div_suggest_margin = div_suggest_margin - 190;
        }
        if(div_suggest_margin <= -10 - ((num_block*190) - div_width)){
            div_suggest_margin = -10;
        }
    }else if(target == 'left'){
        div_suggest_margin = -10;
    }
    $('#list_suggest').css('margin-left',div_suggest_margin+'px');
}
function show_bottom_menu(target){
    if($(target).attr('class') == "fa fa-list"){
        $(target).attr('class','fa fa-window-close');
        $("#header_left_menu").attr('class','menu_mobile');
    }else{
        $(target).attr('class','fa fa-list');
        $("#header_left_menu").attr('class','');
    }
}

function setting_active_dark_mode(e){
    setting_dark_mode = getCookie('setting_dark_mode');
    if(setting_dark_mode == 'light' || setting_dark_mode == false){
        setCookie('setting_dark_mode','dark');
        $('body').removeClass('light').addClass('dark');
        $('footer').removeClass('light').addClass('dark');
        $(e).addClass('active');
    }else{
        setCookie('setting_dark_mode','light');
        $('body').removeClass('dark').addClass('light');
        $('footer').removeClass('dark').addClass('light');
        $(e).removeClass('active');
    }
}

function setCookie(name, value, hours) {
    var expires="";
    if(!hours){
        hours = 8760;
    }
    var date=new Date();
    date.setTime(date.getTime() + (hours*60*60*1000));
    expires="; expires="+date.toUTCString();
    document.cookie=name+"="+(value||"")+expires+"; path=/";
}
function setCookie2(name, value, time) {
    var expires="";
    var date=new Date();
    date.setTime(date.getTime() + (time*1000));
    expires="; expires="+date.toUTCString();
    document.cookie=name+"="+(value||"")+expires+"; path=/";
}
function getCookie(name){
    var pattern = RegExp(name + "=.[^;]*")
    matched = document.cookie.match(pattern)
    if(matched){
        var cookie = matched[0].split('=')
        return decodeURI(cookie[1])
    }
    return false
}
function deleteCookie(name){
    document.cookie=name+'=; Max-Age=-99999999;';
}

function show_hidden_div(target){
    if($(".hidden_div[target="+target+"]").css("display") == "none"){
        $(".hidden_div").hide();
        $(".hidden_div[target="+target+"]").show();
    }else{
        $(".hidden_div").hide();
    }
}
function closeList(event){
    $('.popup').html();
    $('.popup').hide();
}
function popupList(order){
    var slug = $('#slug').val();
    var idBook = $('#book_id').val();
    var order = $('#episode_name').val();
    $.ajax({
        type: 'POST',
        cache: true,
        url: urlPopupList,
        data: {slug: slug, id: idBook, order, order}
    }).done(
        function(dataResult) {
            $('.popup').html(dataResult);
            $('.popup').show();
           
            var elem = $('.chapter-list #chap_' + order),
                container = $('.chapter-list'),
                pos = elem.position().top + container.scrollTop() - container.position().top;

            container.animate({scrollTop: pos}, 100)

        });
}

function popup(action){
    if(action == 'report' || action == 'app'){
        $.ajax({
            type: 'POST',
            cache: false,
            url: urlPopup,
            dataType: "html",
            data: {type: action}
        }).done(
            function(dataResult) {
                $('.popup').html(dataResult);
                $('.popup').show();
            });
    }else{
        if($('.popup #popup_content .popup_content > h2').hasClass('module_login') == false){
            $.ajax({
                type: 'POST',
                cache: false,
                url: urlPopup,
                dataType: "html",
                data: {type: action, url:window.location.href}
            }).done(
                function(dataResult) {
                    $('.popup').html(dataResult);
                    if(action == 'register'){
                        captcha('register');
                        $('.module_login').hide();
                        $('.module_register').show();
                    }else if(action == 'forgot'){
                        captcha('forgot');
                        $('.module_login').hide();
                        $('.module_forgot').show();
                    }else if(action == 'success'){
                        $('.module_forgot').hide();
                        $('.module_success').show();
                    }else{
                        $('.module_forgot').hide();
                        $('.module_register').hide();
                        $('.module_success').hide();
                        $('.module_login').show();
                    }
                    $('.popup').show();
                });
        }else{
            if(action == 'register'){
                captcha('register');
                $('.module_login').hide();
                $('.module_register').show();
            }else if(action == 'forgot'){
                captcha('forgot');
                $('.module_login').hide();
                $('.module_forgot').show();
            }else if(action == 'success'){
                $('.module_forgot').hide();
                $('.module_success').show();
            }else{
                $('.module_forgot').hide();
                $('.module_register').hide();
                $('.module_success').hide();
                $('.module_login').show();
            }
            $('.popup').show();
        }
    }
}
function captcha(type_action){
    $.ajax({
        type: 'get',
        cache: false,
        url: urlCaptcha,
        cache: false,
        dataType: "json",
        success: function(data){
            if(type_action == 'register'){
                $('.register-captcha img').attr('src', data['imgCaptcha']);
                $('.register-captcha #captcha-register').val(data['idCaptcha']);
            }else if(type_action == 'forgot'){
                $('.forgot-captcha img').attr('src', data['imgCaptcha']);
                $('.forgot-captcha #captcha-forgot').val(data['idCaptcha']);
            }
        }
    });
}

function register(){
    var textError = "";
    if($('#email_register').val().trim() == ""){
        textError += "Email không được để trống.\n";
    }else if(validateEmail($('#email_register').val().trim()) == false){
        textError += "Định dạng email không chính xác.\n";
    }

    if($('#password_register').val().trim() == ""){
        textError += "Mật khẩu không được để trống.\n";
    }else if($('#password_register').val().trim().length <= 6){
        textError += "Mật khẩu phải lớn hơn 6 ký tự.\n";
    }

    if($('#captcha_register').val().trim() == ""){
        textError += "Mã xác nhận không được để trống.\n";
    }

    if(textError != ""){
        captcha('register');
        alert(textError);
    }else {
        $.ajax({
            type: 'POST',
            cache: false,
            url: urlRegister,
            dataType: "json",
            data: {
                email: $('#email_register').val(),
                password: $('#password_register').val(),
                captcha: $('#captcha_register').val(),
                id_captcha: $('#captcha-register').val(),
                expire: 1
            },
            success: function (dataResult) {
                if (dataResult['status'] == '0') {
                    var textError = "";
                    for (var key in dataResult['error']) {
                        textError += dataResult['error'][key] + "\n";
                    }
                    alert(textError);
                } else {
                    location.reload(true);
                }
            }
        });
    }
}

function validateEmail(email) {
    var re = new RegExp(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    return re.test(email);
}

function validateName(name) {
    var nameRegex = /^[a-zA-Z\-\s\_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/;
    return nameRegex.test(name);
}

function changeServer(server) {
    $(".chapter-control .btn-success").removeClass("btn-success").addClass("btn-primary");
    $(".server_" + server).addClass("btn-success");
    if(server == '1'){
        $(".chapter_content img").each(function() {
            var link = $(this).attr("data-original");
            $(this).attr("src", $(this).attr("data-original"));
        });
    }else if(server == '2'){
        $(".chapter_content img").each(function() {
            var link = $(this).attr("src");
            link = "https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&resize_h=0&rewriteMime=image%2F*&url=" + encodeURIComponent(link);
            $(this).attr("src", link);
        });
    }else if(server == '4'){
        $(".chapter_content img").each(function() {
            var link = $(this).attr("data-original");
            if( link !== undefined){
                if(link.indexOf("mangaqq.net") > -1 || link.indexOf("cdnqq.xyz") > -1){
                    link = link.replace("mangaqq.net", "i200.truyenvua.com");
                    link = link.replace("cdnqq.xyz", "i200.truyenvua.com");
                }else if(link.indexOf("mangaqq.com") > -1){
                    link = link.replace("mangaqq.com", "i216.truyenvua.com");
                }else if(link.indexOf("trangshop.net") > -1 || link.indexOf("photruyen.com") > -1 || link.indexOf("tintruyen.com") > -1){
                    link = link.replace("photruyen.com", "i109.truyenvua.com");
                    link = link.replace("tintruyen.com", "i109.truyenvua.com");
                    link = link.replace("trangshop.net", "i109.truyenvua.com");
                }else if(link.indexOf("tintruyen.net") > -1){
                    link = link.replace("//tintruyen.net", "//i138.truyenvua.com");
                    link = link.replace("//i125.tintruyen.net", "//i125.truyenvua.com");
                }else if(link.indexOf("qqtaku.com") > -1){
                    link = link.replace("qqtaku.com", "i125.truyenvua.com");
                }
                $(this).attr("src", link);
            }
        });
    }else{
        $(".chapter_content img").each(function() {
            var link = $(this).attr("data-cdn");
            $(this).attr("src", link);
        });
    }
}
function loadError(that){
    var link = $(that).attr("data-original");
    if( link !== undefined){
        link = "https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&resize_h=0&rewriteMime=image%2F*&url=" + encodeURIComponent(link);
        $(this).attr("src", link);
        $(this).attr("onerror", "");
    }
}
function lazyload(){
    $('.lazy-image').Lazy({
        enableThrottle: true,
        throttle: 0,
        attribute: "data-src",
        effect: "show",
        afterLoad: function(element) {
            element.removeClass('lazy-image');
        },
    });
}

function closeads(type){
    if(type == 'preload_ads'){
        $('#image_popup').hide();
        setCookie('preload_banner', 1, 2);
    }else if(type == 'preload_banner_mobile'){
        $('#image_popup_mobile').hide();
        setCookie('preload_banner_mobile', 1, 2);
    }
}

function changeValue(idName, idSlug){
    var name = document.getElementById(idName).value;
    slug = name.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '')
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    document.getElementById(idSlug).value = slug;
}
var visitedComicsLimit = 360;
if(login == 0){
    saveVisitedComics();
}

function saveVisitedComics() {
    if ($("#chapter_content").find(".chapter_content").length > 0 && "undefined" != typeof Storage) {
        var e = $('#episode_id').val();
        if (e) {
            void 0 !== localStorage["visited-chapters"] && localStorage.removeItem("visited-chapters");
            var t = $(".breadcrumb li").eq(1).find("a"),
                a = $(".breadcrumb li").eq(2).find("a"),
                i = $('meta[itemprop="image"]').attr("content");
            if (t && a && i) {
                var s = $('#book_id').val(),
                    r = {
                        id: s,
                        image: i.replace(siteImage, ""),
                        name: t.find("span").text(),
                        url: t.attr("href").replace(siteRoot, ""),
                        chapterName: a.find("span").text().replace("Chapter ", ""),
                        chapterUrl: a.attr("href").replace(siteRoot, ""),
                        chapterIds: [e]
                    };
                if (void 0 !== localStorage["visited-comics"]) {
                    var n = JSON.parse(localStorage["visited-comics"]),
                        l = n.map((function(e) {
                            return e.id
                        })).indexOf(s);
                    if (l > -1) {
                        var c = n[l],
                            d = c.chapterIds && c.chapterIds.length > 0 ? c.chapterIds : [];
                        if (d.length > 0) {
                            var p = d.indexOf(e);
                            p >= 0 && d.splice(p, 1)
                        }
                        if (d.push(e), d.length > 20)
                            for (var m = 20; m < d.length; m++) d.shift();
                        r.chapterIds = d, n.splice(l, 1)
                    }
                    if (n.push(r), n.length > visitedComicsLimit)
                        for (m = visitedComicsLimit; m < n.length; m++) n.shift();
                        localStorage["visited-comics"] = JSON.stringify(n)
                } else {
                    var u = [];
                    u.push(r), localStorage["visited-comics"] = JSON.stringify(u)
                }
            }
        }
    }
}
if(login == 0) {
    if ($(".book_detail").length > 0 && !$(".read-continue").length && ("undefined" != typeof Storage && void 0 !== localStorage["visited-comics"] && (items = JSON.parse(localStorage["visited-comics"])).length > 0)) {
        for (var i = items.length - 1; i >= 0; i--)
            if (items[i].id == $('#book_id').val()) {
                var readHtml = ' <li class="li04"><a href="' + items[i].chapterUrl + '" class="button is-info is-rounded"><i class="fa fa-location-arrow" aria-hidden="true"></i> Đọc tiếp</a></li>';
                $(".story-detail-menu .li03").after(readHtml);
                break
            }
    }
    if ($(".visited-comics-page").length) {
        var t = getParameterByName("t");
        if ("undefined" != typeof Storage){
            if (void 0 !== localStorage["visited-comics"]) {
                var pageSize = 42;
                (items = JSON.parse(localStorage["visited-comics"])).length > 0 ? ($(".visited-comics-page").data("items", items.reverse()), populateVisitedComic(1, pageSize), createPaging(items, pageSize)) : $(".visited-comics-page").html('<div class="warning-list box">Xin lỗi, không tìm thấy kết quả nào!! Hãy đăng nhập để sử dụng tính năng này.</div>')
            } else $(".visited-comics-page").html('<div class="warning-list box">Xin lỗi, không tìm thấy kết quả nào!! Hãy đăng nhập để sử dụng tính năng này.</div>')
        }
    }
}
function getParameterByName(e, t) {
    t || (t = window.location.href), e = e.replace(/[\[\]]/g, "\\$&");
    var a = new RegExp("[?&]" + e + "(=([^&#]*)|&|#|$)").exec(t);
    return a ? a[2] ? decodeURIComponent(a[2].replace(/\+/g, " ")) : "" : null
}
function createPaging(e, t) {
    var a = Math.ceil(e.length / t);
    if (a > 1) {
        for (var i = $("<div>").addClass("page_redirect"),  s = 1; s <= a; s++) {
            var r = $("<a>"), p = $("<p>");
            1 == s && p.addClass("active");
            var n = p.text(s).data("page", s).click((function(e) {
                return e.preventDefault(), $(".page_redirect p").removeClass("active"), $(this).addClass("active"), populateVisitedComic($(this).data("page"), t), $("html, body").animate({
                    scrollTop: 0
                }, 200, "linear"), !1
            }));
            r.append(n), i.append(r)
        }
        $(".page_redirect").remove(), $(".visited-comics-page").after('<div class="clear clearqq"></div>'), $(".clearqq").after(i)
    }
}

function populateVisitedComic(e, t) {
    var a = $(".visited-comics-page").data("items");
    if (a) {
        for (var i = a.slice((e - 1) * t, e * t), o = $("<ul>").addClass('list_grid grid'), s = siteImage, r = 0; r < i.length; r++) {
            var n = i[r];
            var image = n.image;
            if(n.image.indexOf("http") == -1){
                image = s + n.image
            }
            var htmlElement =
                '<li>' +
                    '<div class="book_avatar">' +
                        '<span class="remove-history" title="Xóa truyện đã đọc" data-id="' + n.id + '" onclick="removeVisitedComic(this); return false;"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>' +
                        '<a href="' + n.url + '"><img class="center" src="' + image + '" alt="' + n.name + '"></a>' +
                    '</div>' +
                    '<div class="book_info">' +
                        '<div class="book_name">'+
                            '<h3><a title="' + n.name + '" href="' + n.url + '">' + n.name + '</a></h3>'+
                        '</div>'+
                        '<div class="clear"></div>'+
                        '<div class="last_chapter">' +
                            '<a href="' + n.chapterUrl + '" title="Đọc Tiếp Chapter ' + n.chapterName + '">Đọc Tiếp ' + n.chapterName + '</a>' +
                        '</div>' +
                    '</div>' +
                '</li>';
            o.append(htmlElement);
        }
        $(".visited-comics-page").empty().append(o)
    }
}


function removeVisitedComic(e) {
    if ("undefined" != typeof Storage && void 0 !== localStorage["visited-comics"]) {
        var t = JSON.parse(localStorage["visited-comics"]),
            a = parseInt($(e).data("id"));
        if (t.length > 0) {
            var i = t.map((function(e) {
                return parseInt(e.id)
            })).indexOf(a);

            i > -1 && (t.splice(i, 1), localStorage["visited-comics"] = JSON.stringify(t), $(e).parent().parent().remove())
        }
    }
}