$(function () {

    /* ---------------------------------------------- /*
     * Header
    /* ---------------------------------------------- */

    window.onscroll = getScrollPosition;

    function getScrollPosition() {
        const header = document.querySelector('header');
        if (window.pageYOffset > 200) {
            header.classList.add('fixed');
            return;
        }
        header.classList.remove('fixed');
    }

    /* ---------------------------------------------- /*
     * Menu button
    /* ---------------------------------------------- */

    $('.menu__btn').click(function (e) {
        e.preventDefault();
        const navSelector = $('.nav');
        const windowWidth = window.innerWidth;

        if (windowWidth < 769) {
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

        http('/login/ajax').then(
            response => {
                $('.logIn .forms').append(response);
                $('#toReg').click(function () {
                    $('.forms form').toggle(600);
                });
            }
        );

        http('/register/ajax').then(
            onSuccess => {
                $('.logIn .forms').append(onSuccess);
                $('#ajaxRegistration').hide();
                $('#toLog').click(function () {
                    $('.forms form').toggle(600);
                });
            }
        );

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

    $('#fotoInput').fileuploader({
        // Options will go here
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
        changeInput: ' ',
        theme: 'thumbnails',
        enableApi: true,
        addMore: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
            '<ul class="fileuploader-items-list">' +
            '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner">+</div></li>' +
            '</ul>' +
            '</div>',
            item: '<li class="fileuploader-item">' +
            '<div class="fileuploader-item-inner">' +
            '<div class="thumbnail-holder">${image}</div>' +
            '<div class="actions-holder">' +
            '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
            '<span class="fileuploader-action-popup"></span>' +
            '</div>' +
            '<div class="progress-holder">${progressBar}</div>' +
            '</div>' +
            '</li>',
            item2: '<li class="fileuploader-item">' +
            '<div class="fileuploader-item-inner">' +
            '<div class="thumbnail-holder">${image}</div>' +
            '<div class="actions-holder">' +
            '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
            '<span class="fileuploader-action-popup"></span>' +
            '</div>' +
            '</div>' +
            '</li>',
            startImageRenderer: true,
            canvasImage: false,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove'
            },
            onItemShow: function(item, listEl) {
                const plusInput = listEl.find('.fileuploader-thumbnails-input');

                plusInput.insertAfter(item.html);

                // add sorter button to the item html
                item.html.find('.fileuploader-action-remove').before('<a class="fileuploader-action fileuploader-action-sort" title="Sort"><i></i></a>');

                if(item.format == 'image') {
                    item.html.find('.fileuploader-item-icon').hide();
                }
            }
        },
        afterRender: function(listEl, parentEl, newInputEl, inputEl) {
            const plusInput = listEl.find('.fileuploader-thumbnails-input'),
                api = $.fileuploader.getInstance(inputEl.get(0));

            plusInput.on('click', function() {
                api.open();
            });
        },
        editor: {
            // editor cropper
            cropper: {
                // cropper ratio
                // example: null
                // example: '1:1'
                // example: '16:9'
                // you can also write your own
                ratio: null,
                minWidth: null,
                minHeight: null,
                showGrid: true
            },

            // editor on save quality (0 - 100)
            // only front-end
            quality: null,
            maxWidth: null,
            maxHeight: null,

            // Callback fired after saving the image in editor
            onSave: function(blobOrDataUrl, item, listEl, parentEl, newInputEl, inputEl) {
                // callback will go here
            }
        },
        // dragDrop: {
        //     container: '.fileuploader-thumbnails-input'
        // },
        // onRemove: function(item) {
        //     $.post('php/upload_remove.php', {
        //         file: item.name
        //     });
        // },
        sorter: {
            selectorExclude: null,
            placeholder: '<li class="fileuploader-item fileuploader-sorter-placeholder"><div class="fileuploader-item-inner"></div></li>',
            scrollContainer: window,
            // onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
            //     var api = $.fileuploader.getInstance(inputEl.get(0)),
            //         fileList = api.getFileList(),
            //         _list = [];
            //
            //     $.each(fileList, function(i, item) {
            //         _list.push({
            //             name: item.name,
            //             index: item.index
            //         });
            //     });
            //
            //     $.post('php/ajax_sort_files.php', {
            //         _list: JSON.stringify(_list)
            //     });
            // }
        },
    });

    /* ---------------------------------------------- /*
     * Elements delete
    /* ---------------------------------------------- */

    $('.workImgDel').click(function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        const element = $(this).parent('.image');

        http(url).then(
            response => {
                if (response.isDeleted === true) {
                    element.remove();
                }
            },
            onError => {
                console.log(onError);
            }
        );
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
        const url = $(this).attr('href');
        const likeSel = $('#likesCount');

        http(url).then(
            response => {
                if (response.isLiked === true) {
                    const currentVal = parseInt(likeSel.text());
                    likeSel.empty();
                    likeSel.append(currentVal + 1);
                    $('.work__likes').addClass('work__likes_checked');
                }
            }
        );
        return false;
    });

    /* ---------------------------------------------- /*
     * Categories
    /* ---------------------------------------------- */

    $('[id^=dcid_]').click(function (e) {
        e.preventDefault();
        const itemId = $(this).attr('id').split('_')[1];
        const itemName = $(this).find('span').html();
        const $position = $(this).parent().siblings('.notInWork').find('.inputGroup');
        const $message = $(this).parent().siblings('.notInWork').find('.empty');
        const $delLink = $(this);

        http($(this).attr('href')).then(
            response => {
                const json = JSON.parse(response);
                if (json.isRemoved) {
                    $delLink.remove();
                    $message.remove();

                    $position.append(
                        '<input id="' + itemId + '" type="checkbox" name="categories[]" value="' + itemId + '">' +
                        '<label for="' + itemId + '">' + itemName + '</label>'
                    );

                }
            },
            onError => {
                console.log(onError);
            }
        );
    });

    /**
     * Materials
     */
    $('[id^=dmid_]').click(function (e) {
        e.preventDefault();
        const itemId = $(this).attr('id').split('_')[1];
        const itemName = $(this).find('span').html();
        const $position = $(this).parent().siblings('.notInWork').find('.inputGroup');
        const $message = $(this).parent().siblings('.notInWork').find('.empty');
        const $delLink = $(this);

        http($(this).attr('href')).then(
            response => {
                const json = JSON.parse(response);
                if (json.isRemoved) {
                    $delLink.remove();
                    $message.remove();
                    $position.append(
                        '<input id="' + itemId + '" type="checkbox" name="materials[]" value="' + itemId + '">' +
                        '<label for="' + itemId + '">' + itemName + '</label>'
                    );

                }
            },
            onError => {
                console.log(onError);
            }
        );
    });

    /* ---------------------------------------------- /*
     * Gallery
    /* ---------------------------------------------- */

    if (window.location.href.indexOf("/gallery") >= 0) {
        const page = getUrlParameter('page').length ? getUrlParameter('page')[0] : 0;
        getWorks(getUrlParameter('categories[]'), page);

        $('[id^=cid_]').click(function () {
            const catIds = getCheckCategories();
            getWorks(catIds, 0);
        });

        $(document).on('click', '#workNext', function () {
            const pageId = $(this).attr('data-page');
            const catIds = getCheckCategories();
            getWorks(catIds, pageId);
        });

        $(document).on('click', '#workPrevious', function () {
            const pageId = $(this).attr('data-page');
            const catIds = getCheckCategories();
            getWorks(catIds, pageId);
        });

        /**
         * get checked catalog items
         * @returns {Array}
         */
        function getCheckCategories() {
            const catIds = [];
            const checks = $('[id^=cid_]');
            for (let i = 0; i < checks.length; i++) {
                if (checks[i].id === undefined) {
                    continue;
                }
                const catId = $('#' + checks[i].id + ':checked').attr('data-id');
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
            let parameters = {};
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
            http('/gallery/works', parameters, 'POST').then(
                response => {
                    $('#galleryWorksAll').empty().append(response);
                },
                onError => {
                    $('#galleryWorksAll').empty().append('<p>Мы не смогли загрузить список работ. Возможно возникла ошибка сети</p>');
                    console.log(onError);
                }
            );
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
                for (const cat of parameters.categories) {
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
    const formData = $(this).serialize();
    const url = $(this).attr('action');
    http(url, formData, 'POST').then(
        data => {
            const json = JSON.parse(data);
            if (json.auth === true) {
                window.location.href = '/cabinet';
            }
        },
        onError => {
            console.log(onError);
        }
    );
});

$(document).on('submit', '#ajaxRegistration', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    const url = $(this).attr('action');
    $('.errorText').empty();
    $.post(url, formData)
        .done(function (data) {
            if (data.auth === true) {
                window.location.href = '/cabinet';
            }
        })
        .fail(function (data) {
            const json = data.responseJSON;
            if (json.errors) {
                for (const fieldName in json.errors) {
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
 * @param {string} needleParamName
 * @returns {Array}
 */
function getUrlParameter(needleParamName) {
    const url = decodeURIComponent(window.location.search.substring(1));
    const result = [];
    const allVars = url.split('&');
    for (let i = 0; i < allVars.length; i++) {
        const param = allVars[i].split('=');
        if (param[0] === needleParamName) {
            result.push(param[1]);
        }
    }
    return result;
}

/**
 * http transport
 *
 * @param {string} url
 * @param params mixed of request params
 * @param {string} method
 * @returns {Promise<>}
 */
function http(url = '', params = '', method = 'GET') {
    return new Promise(function (resolve, reject) {
        const xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        if (method === 'POST') {
            xhr.setRequestHeader('X-CSRF-TOKEN', getCsrfToken());
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        }
        xhr.onload = function () {
            if (this.status === 200) {
                resolve(this.response);
            } else {
                const error = new Error(this.statusText);
                error.code = this.status;
                reject(error);
            }
        };
        xhr.onerror = function () {
            reject(new Error("Network Error"));
        };
        if (params) {
            if (params instanceof Object) {
                xhr.send($.param(params));
            } else {
                xhr.send(params);
            }
        } else {
            xhr.send();
        }
    });
}

/**
 * get csrf token
 * @returns {(string | null) | string}
 */
function getCsrfToken() {
    let meta = document.getElementsByTagName('meta');
    for (let item of meta) {
        if (item.getAttribute('name') === 'csrf-token') {
            return item.getAttribute('content');
        }
    }
    return null;
}