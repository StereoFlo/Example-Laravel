$( document ).ready(function() {
    $.get('/login/ajax')
		.done(function (data) {
        $('.logIn').append(data);
		$('#ajaxReg').hide();
		$('.signIn__toRegisterBtn').click(function(){ $('form').toggle(600); });
		})
		.fail(function(data) {
    	});

	$(".side-title a").click(
		function(e) {
			$(e.target).closest('.side').toggleClass('expanded');
		}
	);
	$('.bxslider').bxSlider();
	$('a.menu-btn').click(
		function(e) {
			e.preventDefault();
			$(e.target).closest('nav').toggleClass('opened');
		}
	);
	$('.user__btn, .logIn__close').on('click', function () {
		$('.logIn').toggleClass('hidden');
  	});


    $('.slogan').hide();
    $(".sloganShow").hover(
        function() {
            $(this).siblings('.news, .slogan').stop();
            $(this).siblings('.news').slideUp(600);
            $(this).siblings('.slogan').slideDown(600);
        }
        ,
        function() {
            $(this).siblings(".news, .slogan").stop();
            $(this).siblings(".news").slideDown();
            $(this).siblings(".slogan").slideUp();
        }
    );

	$("a[href*='#']").mPageScroll2id({
		scrollSpeed: 900,
		scrollEasing: "easeInOutSine"
	});
	$('.menu__btn').on('click', function() {
		if ($(window).width() < 1000) {
			var headerHeight = $('.header').innerHeight();
			$('.nav').css('top', headerHeight);
		}
		$('.nav').slideToggle();
		console.log(headerHeight);
	});
	$('.login__registration').on('click', function() {
		window.location = 'registration.html';
	});



});

$(document).on('click', '#ajaxLoginButton',function () {
    var ajaxFromLogin = $('#ajaxLogin').serialize();
    var url  = $('#ajaxLogin').attr('action');
    $.post(url, ajaxFromLogin)
        .done(function( data ) {
            console.log(data)
        }).fail(function (data) {
        console.log(data)
    });
});
