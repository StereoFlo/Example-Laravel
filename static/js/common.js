$(function () {

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
            navSelector.slideToggle();
        }
        else {
            navSelector.toggleClass('opacity');
        }

    });

    /* ---------------------------------------------- /*
     * LogIn
    /* ---------------------------------------------- */

    $('.user__btn, .logIn__close').click(function (e) {
        e.preventDefault();
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
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $(".sloganShow").click(function () {
            //todo
        })
    } else {
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
    }

    /* ---------------------------------------------- /*
     * Scroll to id
    /* ---------------------------------------------- */

    $("a[href*='#']").mPageScroll2id({
        scrollSpeed: 900,
        scrollEasing: "easeInOutSine",
        offset: 55,
    });

    /* ---------------------------------------------- /*
     * VK Comments
    /* ---------------------------------------------- */

    if ($("#work__comments").length) {
        VK.Widgets.Comments("work__comments", {limit: 20, attach: "*"});
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

    $('[id^=tag_]').click(function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var element = $(this);
        $.get(url)
            .done(function (data) {
                if (data.isDeleted === true) {
                    element.remove();
                }
            })
            .fail(function (data) {
                console.log(data);
            });
    });

    /* ---------------------------------------------- /*
     * Slider
    /* ---------------------------------------------- */

    $('.galleryCategory__title a').click(function (e) {
        event.preventDefault();
        $('.galleryCategory').toggleClass('galleryCategory_opened');
    });

    /* ---------------------------------------------- /*
     * Phone mask
    /* ---------------------------------------------- */

    $('input[name="phone"]').inputmask({"mask": "+7(999) 999-9999"});

    /* ---------------------------------------------- /*
     * Likes
    /* ---------------------------------------------- */

    $('#setLike').click(function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var likeSel = $('#likesCount');
        $.get(url)
            .done(function (data) {
                if (data.isLiked === true) {
                    var currentVal = parseInt(likeSel.text());
                    likeSel.empty();
                    likeSel.append(currentVal + 1);
                    $('.work__likes').addClass('work__likes_checked');
                }
            })
            .fail(function (data) {
                //todo
            });
        return false;
    });

    /* ---------------------------------------------- /*
     * Categories
    /* ---------------------------------------------- */

    $('[id^=dcid_]').click(function (event) {
        event.preventDefault();
        var catId = $(this).attr('id').split('dcid_')[1];
        var catName = $(this).find('span').html();
        var $delLink = $(this);

        $.get($(this).attr('href'), function (response) {
            if (response.isRemoved) {

                $delLink.remove();
                // if($category.length == 0) {
                //     $(this).append('<p>Вы не добавили свою работу не в одну категорию</p>');
                // }

                $('#notInWork').append(
                    '<input id="'+ catId +'" type="checkbox" name="categories[]" value="'+ catId +'">' +
                    '<label for="'+ catId +'">'+ catName +'</label>'
                );

            } else {
                alert('panic!')
            }
        });
    });

    /* ---------------------------------------------- /*
     * Gallery
    /* ---------------------------------------------- */

    if(window.location.href.indexOf("/gallery") >= 0) {
        var page = getUrlParameter('page').length ? getUrlParameter('page')[0] : 0;
        getWorks(getUrlParameter('categories[]'), page);

        $('[id^=cid_]').click(function () {
            var catIds = getCheckCategories();
            getWorks(catIds, 0);
        });

        $(document).on('click', '#workNext', function () {
                var pageId = $(this).attr('data-page');
                var catIds = getCheckCategories();
                getWorks(catIds, pageId);
        });

        $(document).on('click', '#workPrevious', function () {
            var pageId = $(this).attr('data-page');
            var catIds = getCheckCategories();
            getWorks(catIds, pageId);
        });

        /**
         * get checked catalog items
         * @returns {Array}
         */
        function getCheckCategories() {
            var catIds = [];
            var checks = $('[id^=cid_]');
            for (var i = 0; i < checks.length; i++) {
                if (checks[i].id === undefined) {
                    continue;
                }
                var catId = $('#' + checks[i].id + ':checked').attr('data-id');
                if (catId === undefined) {
                    continue;
                }
                catIds.push(catId);
            }
            return catIds;
        }

        /**
         * get works by ajax
         * @param catIds array
         * @param pageId integer
         *
         * @return void
         */
        function getWorks(catIds, pageId) {
            var parameters = {};
            if (catIds.length > 0) {
                parameters.categories = catIds;
            }
            if (pageId === undefined) {
                parameters.page = 0;
            } else {
                parameters.page = pageId;
            }

            setUrl(parameters);
            // this is need for post query
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('/gallery/works', parameters)
                .done(function (data) {
                    $('#galleryWorksAll').empty().append(data);
                })
                .fail(function (data) {
                    $('#galleryWorksAll').empty().append('<p>Мы не смогли загрузить список работ. Возможно возникла ошибка сети</p>');
                    console.log(data);
                });
        }

        /**
         * set url to address
         * @param parameters parameters object
         */
        function setUrl(parameters) {
            history.pushState({}, "", decodeURI(window.location.origin + window.location.pathname + '?' + $.param(parameters)));
        }

    }

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
                    });
            }
        })
        .fail(function (data) {

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
            var json = data.responseJSON;
            if (json.errors) {
                for (var fieldName in json.errors) {
                    if (json.errors.hasOwnProperty(fieldName)) {
                        if (json.errors[fieldName] instanceof Array) {
                            json.errors[fieldName].forEach(function (error) {
                                $('#' + fieldName + 'Error').empty().append(error);
                            });
                        }
                    }
                }
            } else {
                console.log(json.message)
            }
            console.log(json.errors);
        });
});

/**
 * parse parameter in url
 * @param needleParamName string
 * @returns {Array}
 */
function getUrlParameter(needleParamName) {
    var url = decodeURIComponent(window.location.search.substring(1));
    var result =[];
    var allVars = url.split('&');
    for (var i = 0; i < allVars.length; i++) {
        var param = allVars[i].split('=');
        if (param[0] === needleParamName) {
            result.push(param[1]);
        }
    }
    return result;
}