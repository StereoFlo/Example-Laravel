$(document).ready(function () {
    $.get('/login/ajax')
        .done(function (data) {
            $('.logIn .forms').append(data);
            $('#toReg').click(function () {
                $('.forms form').toggle(600);
            });
        })
        .fail(function (data) {
            //todo
        });

    $.get('/register/ajax')
        .done(function (data) {
            $('.logIn .forms').append(data);
            $('#ajaxRegistration').hide();
            $('#toLog').click(function () {
                $('.forms form').toggle(600);
            });
        })
        .fail(function (data) {
            //todo
        });

    $(".side-title a").click(
        function (e) {
            $(e.target).closest('.side').toggleClass('expanded');
        }
    );
    $('.bxslider').bxSlider();
    $('a.menu-btn').click(
        function (e) {
            e.preventDefault();
            $(e.target).closest('nav').toggleClass('opened');
        }
    );
    $('.user__btn, .logIn__close').on('click', function () {
        $('.logIn').toggleClass('hidden');
        $('#ajaxRegistration').hide();
        $('#ajaxLogin').show();
    });


    $('.slogan').hide();
    $(".sloganShow").hover(
        function () {
            $(this).siblings('.news, .slogan').stop();
            $(this).siblings('.news').slideUp(600);
            $(this).siblings('.slogan').slideDown(600);
        }
        ,
        function () {
            $(this).siblings(".news, .slogan").stop();
            $(this).siblings(".news").slideDown();
            $(this).siblings(".slogan").slideUp();
        }
    );

    $("a[href*='#']").mPageScroll2id({
        scrollSpeed: 900,
        scrollEasing: "easeInOutSine"
    });
    $('.menu__btn').on('click', function () {
        var navSelector = $('.nav');
        if ($(window).width() < 1000) {
            var headerHeight = $('.header').innerHeight();
            navSelector.css('top', headerHeight);
        }
        navSelector.slideToggle();
        console.log(headerHeight);
    });
});

$(document).on('click', '#ajaxLoginButton', function () {
    var ajaxLoginSel = $('#ajaxLogin');
    var loginFormsSel = $('.logIn .forms');
    var formData = ajaxLoginSel.serialize();
    var url = ajaxLoginSel.attr('action');
    $.post(url, formData)
        .done(function (data) {
            console.log(data);
            if (data.auth === true) {
                $.get('/login/ajax')
                    .done(function (data) {
                        $('.logIn').addClass('hidden');
                        loginFormsSel.empty();
                        loginFormsSel.append(data);
                        $('.signIn__toRegisterBtn').click(function () {
                            $('.forms form').toggle(600);
                        });
                    })
                    .fail(function (data) {
                        //todo
                    });
            }
        }).fail(function (data) {
        console.log(data)
    });
});

$(document).on('click', '#ajaxRegistrationButton', function () {
    var ajaxLoginSel = $('#ajaxReg');
    var formData = ajaxLoginSel.serialize();
    var url = ajaxLoginSel.attr('action');
    $.post(url, formData)
        .done(function (data) {
            console.log(data)
        }).fail(function (data) {
            //todo
            console.log(data)
    });
});
