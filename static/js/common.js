$(document).ready(function () {

    /* ---------------------------------------------- /*
     * Header
    /* ---------------------------------------------- */

    var header = $('header');
    var $window = $(window);

    $window.scroll(function(){
        if ( $window.scrollTop() > 200) {
            header.addClass("fixed");
        } else {
            header.removeClass('fixed');
        }
    });

    /* ---------------------------------------------- /*
     * Menu button
    /* ---------------------------------------------- */

    $('.menu__btn').click(function (e) {
        e.preventDefault();
        var navSelector = $('.nav');
        var windowWidth = $window.width();

        if (windowWidth < 769) {
            var headerHeight = $('header').innerHeight();
            navSelector.css('top', headerHeight);
            // navSelector.toggleClass('opacity');
            navSelector.slideToggle();
            console.log(windowWidth);
        }
        else {
            navSelector.toggleClass('opacity');
            console.log(windowWidth);
        }

    });

    /* ---------------------------------------------- /*
     * Slider
    /* ---------------------------------------------- */

    $('.bxslider').bxSlider({
        mode: 'fade',
        pagerCustom: '#bx-pager',
        pagerType: 'full'
    });

    /* ---------------------------------------------- /*
     * LogIn
    /* ---------------------------------------------- */

    $('.user__btn, .logIn__close').click(function () {

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

    /* ---------------------------------------------- /*
     * Slogan and News on Welcome section
    /* ---------------------------------------------- */

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

    /* ---------------------------------------------- /*
     * Scroll to id
    /* ---------------------------------------------- */

    $("a[href*='#']").mPageScroll2id({
        scrollSpeed: 900,
        scrollEasing: "easeInOutSine"
    });

    /* ---------------------------------------------- /*
     * VK Comments
    /* ---------------------------------------------- */

    if ($("#work__comments").length) {
        VK.Widgets.Comments("work__comments", {limit: 20, attach: "*"});
    }

    /* ---------------------------------------------- /*
     * SessionUpdateResult popUp
    /* ---------------------------------------------- */

    if ($('#sessionUpdateResult').length) {
        if( $('.modal__message').is(':empty')) {
            // return false;
        }
        else {
            $('#sessionUpdateResult').pignosePopup();
        }
    }

    /* ---------------------------------------------- /*
     * ImagesUploadPreview
    /* ---------------------------------------------- */

    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                };
                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('.filearea input').on('change', function() {

        imagesPreview(this, 'div.fileareaPreview');

        var filesCount = $(this)[0].files.length;
        $(this).parent('.filearea').addClass('haveFile');
        $(this).siblings('span').html("Добавлен " + filesCount + " файл(ов)");
    });

    /* ---------------------------------------------- /*
     * Tag delete
    /* ---------------------------------------------- */

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

    /* ---------------------------------------------- /*
     * Phone mask
    /* ---------------------------------------------- */

    $('input[name="phone"]').inputmask({"mask": "+7(999) 999-9999"});
});

/* ---------------------------------------------- /*
 * Ajax forms
/* ---------------------------------------------- */

$(document).on('submit', '#ajaxLogin', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    var url = $(this).attr('action');

    $.post(url, formData)
        .done(function (data) {
            if (data.auth === true) {
                $.get('/login/ajax')
                    .done(function (data) {
                        $('.logIn').addClass('hidden');
                        $(this).empty();
                        $(this).append(data);
                    })
                    .fail(function (data) {
                        //todo
                    });
            }
        })
        .fail(function (data) {
            //todo
            console.log(data.responseText);
        });

});

$(document).on('submit', '#ajaxRegistration', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    var url = $(this).attr('action');
    $.post(url, formData)
        .done(function (data) {
            if (data.auth === true) {
                $.get('/login/ajax')
                    .done(function (data) {
                        $('.logIn').addClass('hidden');
                        $(this).empty();
                        $(this).append(data);
                    })
                    .fail(function (data) {
                        //todo
                    });
            }
        })
        .fail(function (data) {
            //todo
        });
});
