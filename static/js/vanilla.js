$(function () {
//
//     /* ---------------------------------------------- /*
//      * Menu button
//     /* ---------------------------------------------- */
//
//     $('.menu__btn').click(function (e) {
//         e.preventDefault();
//         var navSelector = $('.nav');
//         var windowWidth = $window.width();
//
//         if (windowWidth < 769) {
//             var headerHeight = $('header').innerHeight();
//             navSelector.css('top', headerHeight);
//             // navSelector.toggleClass('opacity');
//             navSelector.slideToggle();
//             console.log(windowWidth);
//         }
//         else {
//             navSelector.toggleClass('opacity');
//             console.log(windowWidth);
//         }
//
//     });
//
//     /* ---------------------------------------------- /*
//      * Slider
//     /* ---------------------------------------------- */
//
//     $('.bxslider').bxSlider({
//         mode: 'fade',
//         pagerCustom: '#bx-pager',
//         pagerType: 'full'
//     });
//
//     /* ---------------------------------------------- /*
//      * Slogan and News on Welcome section
//     /* ---------------------------------------------- */
//
//     $('.slogan').hide();
//     $(".sloganShow").hover(
//         function () {
//             $(this).siblings('.news, .slogan').stop();
//             $(this).siblings('.news').slideUp(600);
//             $(this).siblings('.slogan').slideDown(600);
//         }
//         ,
//         function () {
//             $(this).siblings(".news, .slogan").stop();
//             $(this).siblings(".news").slideDown();
//             $(this).siblings(".slogan").slideUp();
//         }
//     );
//
//     /* ---------------------------------------------- /*
//      * Scroll to id
//     /* ---------------------------------------------- */
//
//     $("a[href*='#']").mPageScroll2id({
//         scrollSpeed: 900,
//         scrollEasing: "easeInOutSine"
//     });
//
//     /* ---------------------------------------------- /*
//      * VK Comments
//     /* ---------------------------------------------- */
//
//     if ($("#work__comments").length) {
//         VK.Widgets.Comments("work__comments", {limit: 20, attach: "*"});
//     }
//
//     /* ---------------------------------------------- /*
//      * ImagesUploadPreview
//     /* ---------------------------------------------- */
//
//     var imagesPreview = function(input, placeToInsertImagePreview) {
//
//         if (input.files) {
//             var filesAmount = input.files.length;
//             for (i = 0; i < filesAmount; i++) {
//                 var reader = new FileReader();
//                 reader.onload = function(event) {
//                     $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
//                 };
//                 reader.readAsDataURL(input.files[i]);
//             }
//         }
//
//     };
//
//     $('.filearea input').on('change', function() {
//
//         imagesPreview(this, 'div.fileareaPreview');
//
//         var filesCount = $(this)[0].files.length;
//         $(this).parent('.filearea').addClass('haveFile');
//         $(this).siblings('span').html("Добавлен " + filesCount + " файл(ов)");
//     });
//
//     /* ---------------------------------------------- /*
//      * Tag delete
//     /* ---------------------------------------------- */
//
//     $('[id^=tag_]').click(function (event) {
//         event.preventDefault();
//         var url = $(this).attr('href');
//         var element = $(this);
//         $.get(url)
//             .done(function (data) {
//                 if (data.isDeleted === true) {
//                     element.remove();
//                 }
//             })
//             .fail(function (data) {
//                 console.log(data);
//             });
//     });
//
//     /* ---------------------------------------------- /*
//      * Phone mask
//     /* ---------------------------------------------- */
//
//     $('input[name="phone"]').inputmask({"mask": "+7(999) 999-9999"});
// });
//

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
});

/**
 * Document ready
 */
document.addEventListener('DOMContentLoaded', function () {

    /**
     * Login contaiter selector
     * @type {Element}
     */
    var loginContainer = document.querySelector('.logIn');

    /**
     * button to open
     * @type {Element}
     */
    var openBtn = document.querySelector('.user__btn');
    openBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (loginContainer.classList.contains('hidden')) {
            loginContainer.classList.remove('hidden');
            loadLoginForm('.forms', 'GET', '/login/ajax');
        }
    }, false);

    /**
     * close button selector
     * @type {Element}
     */
    var closeButton = document.querySelector('.logIn__close');
    closeButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (!loginContainer.classList.contains('hidden')) {
            loginContainer.classList.add('hidden');
        }
    }, false);

    var tags = document.querySelectorAll('a[id^=tag_]');
    if (tags.length > 0) {
        tags.forEach(function (element) {
            element.addEventListener('click', function (e) {
                e.preventDefault();
                sendForm(null,'GET', element.getAttribute('href'), removeTag());
            })
        });
    }

});

function removeTag(e, element) {
    console.log(e);
    var json = JSON.parse(e);
    if (json.isDeleted === true) {
        element.parentNode.removeChild(element);
    } else {
        alert('Элемент не удален');
    }
}

/**
 * Clicks
 */
document.addEventListener('click', function (e) {
    var clickAttribute = e.target.getAttribute('id');

    if (clickAttribute === 'toReg') {
        loadLoginForm('.forms', 'GET', '/register/ajax');
    }

    if (clickAttribute === 'toLog') {
        loadLoginForm('.forms', 'GET', '/login/ajax');
    }
});

/**
 * submit listener
 */
document.addEventListener('submit', function (e) {
    var submitAttribute = e.target.getAttribute('id');
    if (submitAttribute === 'ajaxLogin') {
        e.preventDefault();
        sendForm(e.target, 'POST', '/login', login);
    }
    if (submitAttribute === 'ajaxRegistration') {
        e.preventDefault();
        sendForm(e.target, 'POST', '/register', register);
    }

});

/**
 * Login form callback
 * @param e XMLHttpRequest.response
 */
function login(e) {
    var answer = JSON.parse(e.target.responseText);
    if (answer.auth === true) {
        loadLoginForm('.forms', 'GET', '/login/ajax');
        return true;
    }
    errorsProcessor(answer);
    return false;
}

/**
 * register form callback
 * @param e
 */
function register(e) {
    var answer = JSON.parse(e.target.responseText);
    if (answer.auth === true) {
        loadLoginForm('.forms', 'GET', '/login/ajax');
    }
    errorsProcessor(answer);
    return false;
}

/**
 *
 * @param answer
 * @returns {boolean}
 */
function errorsProcessor(answer) {
    if (answer.errors) {
        for (var fieldName in answer.errors) {
            if (answer.errors.hasOwnProperty(fieldName)) {
                if (answer.errors[fieldName] instanceof Array) {
                    answer.errors[fieldName].forEach(function (error) {
                        var sel = document.querySelector('#' + fieldName + 'Error');
                        if (!sel) {
                            console.log('#' + fieldName + 'Error - not found');
                            return;
                        }
                        sel.innerHTML = '';
                        sel.innerHTML = error;
                    });
                }
            }
        }
        return true;
    }
    console.log('errorsProcessor: i cant find answer.errors');
    var sel = document.querySelector('#errors');
    sel.innerHTML = '';
    sel.innerHTML = 'Что-то пошло не так... Возможно проблема в вашем логин/пароле. Попробуйте позже';
    return false;
}

/**
 * load form
 *
 * @param selector string
 * @param method string
 * @param url string
 * @param callback
 */
function loadLoginForm(selector, method, url, callback) {
    var formSel = document.querySelector(selector);
    formSel.innerHTML = '';
    var request = new XMLHttpRequest();
    request.open(method, url);
    if (callback) {
        request.addEventListener('load', callback, false);
    }
    request.setRequestHeader('Accept', 'application/json');
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState !== 4) {
            console.log('wait for ready state be a valid... Now its ' + request.readyState);
            return;
        }
        if (request.status !== 200) {
            console.log('Error when loading the form login');
            formSel.innerHTML = 'was an error when loading the form';
            return false;
        }
        formSel.innerHTML = request.response;
    }
}

/**
 *
 * @param formContent
 * @param method
 * @param url
 * @param callback
 */
function sendForm(formContent, method, url, callback) {
    var request = new XMLHttpRequest();
    if (formContent) {
        var formData = new FormData(formContent);
    }
    if (callback) {
        request.addEventListener('load', callback, false);
    }
    request.open(method, url, true);
    request.setRequestHeader('Accept', 'application/json');
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    if (formContent) {
        request.send(formData);
    }
    request.send();
}