$(document).ready(function () {

    /* ---------------------------------------------- /*
     * Header
    /* ---------------------------------------------- */

    var $header = $('header');
    var $window = $(window);

    $window.scroll(function(){
        if ( $window.scrollTop() > 200) {
            $header.addClass("fixed");
        } else {
            $header.removeClass('fixed');
        }
    });

    $('.menu__btn').on('click', function (e) {
        e.preventDefault();
        var navSelector = $('.nav');

        if ($(window).width() < 769) {
            var headerHeight = $('.header').innerHeight();
            navSelector.css('top', headerHeight);
            navSelector.slideToggle();
            navSelector.toggleClass('opacity');
        }
        else {
            navSelector.toggleClass('opacity');
        }

    });




    $(".side-title a").click(
        function (e) {
            $(e.target).closest('.side').toggleClass('expanded');
        }
    );
    $('.bxslider').bxSlider({
        mode: 'fade',
        pagerCustom: '#bx-pager',
        pagerType: 'full',
        buildPager: function(slideIndex){
            return slideIndex - 1;
        }
    });

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

    VK.Widgets.Comments("work__comments", {limit: 20, attach: "*"});


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

    //Tag delete
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

    //textEditor

    // $('textarea').richText({
    //
    //     // text formatting
    //     bold: true,
    //     italic: true,
    //     underline: true,
    //
    //     // text alignment
    //     leftAlign: true,
    //     centerAlign: true,
    //     rightAlign: true,
    //
    //     // lists
    //     ol: true,
    //     ul: true,
    //
    //     // title
    //     heading: true,
    //
    //     // fonts
    //     fonts: false,
    //     fontList: [ "Arial",
    //         "Arial Black",
    //         "Comic Sans MS",
    //         "Courier New",
    //         "Geneva",
    //         "Georgia",
    //         "Helvetica",
    //         "Impact",
    //         "Lucida Console",
    //         "Tahoma",
    //         "Times New Roman",
    //         "Verdana"
    //     ],
    //     fontColor: true,
    //
    //     // uploads
    //     imageUpload: true,
    //     fileUpload: false,
    //
    //     // media
    //     videoEmbed: true,
    //
    //     // link
    //     urls: false,
    //
    //     // tables
    //     table: true,
    //
    //     // code
    //     removeStyles: true,
    //     code: true,
    //
    //     // colors
    //     colors: [],
    //
    //     // dropdowns
    //     fileHTML: '',
    //     imageHTML: '',
    //
    //     // developer settings
    //     useSingleQuotes: false,
    //     height: 0,
    //     heightPercentage: 0,
    //     id: "",
    //     class: "",
    //     useParagraph: false
    // });

    $('input[name="phone"]').inputmask({"mask": "+7(999) 999-9999"});



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
