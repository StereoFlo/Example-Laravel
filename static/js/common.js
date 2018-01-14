$(function () {

    /* ---------------------------------------------- /*
     * Header
    /* ---------------------------------------------- */

    window.onscroll = getScrollPosition;

    function getScrollPosition() {
        const header = document.getElementsByTagName('header');
        if (window.pageYOffset > 200) {
            header[0].classList.add('fixed');
            return;
        }
        header[0].classList.remove('fixed');
    }

    /* ---------------------------------------------- /*
     * Menu button
    /* ---------------------------------------------- */

    $('.menu__btn').click(function (e) {
        e.preventDefault();
        const navSelector = $('.nav');

        if (screen.width < 769) {
            const headerHeight = $('header').innerHeight();
            navSelector.css('top', headerHeight);
            navSelector.slideToggle();
        } else {
            navSelector.toggleClass('opacity');
        }
    });

    /* ---------------------------------------------- /*
     * LogIn
    /* ---------------------------------------------- */

    $('.user__btn, .logIn__close').click(function (e) {
        e.preventDefault();
        $('.logIn .forms').empty();
        $(document).keydown(function (e) {
            if (e.keyCode === 27) {
                $('.logIn').addClass('hidden');
            }
        });

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
        $('body').toggleClass('fixed');
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
        scrollEasing: "easeInOutSine",
        offset: 55,
    });

    /* ---------------------------------------------- /*
     * Tooltip
    /* ---------------------------------------------- */

    $('.work__circle').tooltip({
        position: 'top',
        backgroundColor: '#E83B3A',
        offset: 1
    });

    /* ---------------------------------------------- /*
     * ImagesUploadPreview
    /* ---------------------------------------------- */

    var imagesPreview = function (input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                };
                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('.filearea input').on('change', function () {

        imagesPreview(this, 'div.fileareaPreview');

        var filesCount = $(this)[0].files.length;
        $(this).parent('.filearea').addClass('haveFile');
        $(this).siblings('span').html("Добавлен " + filesCount + " файл(ов)");
    });

    /* ---------------------------------------------- /*
     * Elements delete
    /* ---------------------------------------------- */

    $('.workImgDel').click(function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var element = $(this).parent('.image');

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


    // $('[id^=tag_]').click(function (event) {
    //     event.preventDefault();
    //     var url = $(this).attr('href');
    //     var element = $(this);
    //     $.get(url)
    //         .done(function (data) {
    //             if (data.isDeleted === true) {
    //                 element.remove();
    //             }
    //         })
    //         .fail(function (data) {
    //             console.log(data);
    //         });
    // });

    /* ---------------------------------------------- /*
     * Slider
    /* ---------------------------------------------- */

    $('.galleryCategory__title a').click(function () {
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
     * Categories, Materials
    /* ---------------------------------------------- */

    $('[id^=dcid_]').click(function (e) {
        e.preventDefault();
        var itemId = $(this).attr('id').split('_')[1];
        var itemName = $(this).find('span').html();
        var $position = $(this).parent().siblings('.notInWork').find('.inputGroup');
        var $message = $(this).parent().siblings('.notInWork').find('.empty');
        var $delLink = $(this);

        $.get($(this).attr('href'), function (response) {
            if (response.isRemoved) {
                $delLink.remove();
                $message.remove();

                $position.append(
                    '<input id="' + itemId + '" type="checkbox" name="categories[]" value="' + itemId + '">' +
                    '<label for="' + itemId + '">' + itemName + '</label>'
                );

            }
        });
    });

    $('[id^=dmid_]').click(function (e) {
        e.preventDefault();
        var itemId = $(this).attr('id').split('_')[1];
        var itemName = $(this).find('span').html();
        var $position = $(this).parent().siblings('.notInWork').find('.inputGroup');
        var $message = $(this).parent().siblings('.notInWork').find('.empty');
        var $delLink = $(this);

        $.get($(this).attr('href'), function (response) {
            if (response.isRemoved) {
                $delLink.remove();
                $message.remove();

                $position.append(
                    '<input id="' + itemId + '" type="checkbox" name="materials[]" value="' + itemId + '">' +
                    '<label for="' + itemId + '">' + itemName + '</label>'
                );

            }
        });
    });

    /* ---------------------------------------------- /*
     * Gallery
    /* ---------------------------------------------- */

    if (window.location.href.indexOf("/gallery") >= 0) {
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
            setCheckboxes(parameters);

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

        /**
         * set checkboxes
         * @param parameters
         */
        function setCheckboxes(parameters) {
            if (parameters.categories && parameters.categories.length > 0) {
                for (var cat of parameters.categories) {
                    $('#cid_' + cat).prop('checked', true);
                }
            }
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
                        window.location.href = '/cabinet';
                    })
                    .fail(function (data) {
                    });
            }
        })
        .fail(function (data) {
            $('#emailError').html('Неверная пара логин/пароль');
        });

});

$(document).on('submit', '#ajaxRegistration', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    var url = $(this).attr('action');
    $('.errorText').empty();
    $.post(url, formData)
        .done(function (data) {
            if (data.auth === true) {
                $.get('/login/ajax')
                    .done(function (data) {
                        window.location.href = '/cabinet';
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
                                $('#' + fieldName + 'Error').append(error);
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
    var result = [];
    var allVars = url.split('&');
    for (var i = 0; i < allVars.length; i++) {
        var param = allVars[i].split('=');
        if (param[0] === needleParamName) {
            result.push(param[1]);
        }
    }
    return result;
}