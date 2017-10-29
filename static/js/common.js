$(document).ready(function () {

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

        $('.logIn .forms').empty();

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

    //ImagesUploadPreview

    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;


            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('.filearea input').on('change', function() {

        imagesPreview(this, 'div.fileareaPreview');

        var filesCount = $(this)[0].files.length;
        $(this).parent('.filearea').addClass('haveFile');
        $(this).siblings('span').html("Добавлен " + filesCount + " файл(ов)")
        console.log($(this).files);
    });

    $('[id^=tag_]').click(function () {
        var url = $(this).attr('href');
        var element = $(this);
        $.get(url)
            .done(function (data) {
                if (data.isDeleted === true) {
                    element.remove();
                }
                event.preventDefault();
                event.stopPropagation();
            })
            .fail(function (data) {
                console.log(data);
                event.preventDefault();
                event.stopPropagation();
            });
        event.preventDefault();
        event.stopPropagation();
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
    var ajaxLoginSel = $('#ajaxRegistration');
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
