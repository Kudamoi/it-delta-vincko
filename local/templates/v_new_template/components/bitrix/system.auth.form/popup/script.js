$(document).ready(function () {

	load_modal();

	$('.js-auth-form').submit(function () {
		var $form = $(this);
		console.log($form.serialize());
		console.log($form.attr("action"));
		$.ajax({
			url: $form.attr("action"),
			method: 'GET',
			data: $form.serialize(),
			dataType: 'json',
			success: function (res) {
				if(res.st == true){
					$(".error").remove();
					location.reload();
				}else{
					$(".error").remove();
					$form.find( ".popup__form-title" ).after( "<p class='error' style='grid-column: 1/3; color: red'>"+res.err+"</p>" );
				}
			},
			fail: function (error) {

			}
		});
		return false;
	});

	/*
	function timer(parent) {
		parent.find(".popup__wait-time").css("display", "block");
		parent.find(".popup__wait").css("display", "block");

		var _Seconds = 20,
			_int;

		parent.find('.popup__wait-num').text(_Seconds); // выводим получившееся значение в блок

		_int = setInterval(function () {
			// запускаем интервал
			if (_Seconds > 0) {
				_Seconds--; // вычитаем 1

				parent.find('.popup__wait-num').text(_Seconds); // выводим получившееся значение в блок
			} else {
				parent.find(".popup__wait-repeat").css("display", "block");
				parent.find(".popup__wait-time").css("display", "none");
				clearInterval(_int); // очищаем интервал, чтобы он не продолжал работу при _Seconds = 0
			}
		}, 1000);
	}

	function showBtn(selector, parent, switcher) {
		if (selector.inputmask("isComplete")) {

			parent.find(".popup__form--" + switcher + " .grey-border-button--unactive").removeClass("grey-border-button--unactive");
			parent.find(".popup__form--" + switcher + " .grey-border-button").addClass("grey-border-button--active");
			parent.find(".popup__form--" + switcher + " .grey-border-button--active").on("click", function () {
				parent.find(".popup__form--" + switcher + " .grey-border-button").css("display", "none");
				parent.find(".popup__form--" + switcher + " .popup__code").css("display", "block");
				timer(parent);
			});
		} else {
			parent.find(".popup__form--" + switcher + " .grey-border-button").addClass("grey-border-button--unactive");
			parent.find(".popup__form--" + switcher + " .grey-border-button").removeClass("grey-border-button--active");
		}
	}

	var selector = document.getElementsByClassName("phone-input");
	var popupers = $(".popup");
	popupers.each(function (index) {
		var parent = $(this);
		var phone = parent.find(".phone-input");
		var email = parent.find(".email-input");
		phone.inputmask("+7(999) 999-9999");
		showBtn(phone, parent, "phone");
		phone.keyup(function () {
			showBtn(phone, parent, "phone");
		});
		email.inputmask("email");
		showBtn(email, parent, "mail");
		email.on("keyup", function () {
			showBtn(email, parent, "mail");
		});
		parent.find(".popup__wait-repeat").on("click", function () {
			parent.find(".popup__wait-repeat").css("display", "none");
			parent.find(".popup__wait-time").css("display", "block");
			timer(parent);
		});
		parent.find(".popup__code").mask("9999", {
			completed: function completed() {
				parent.find(".popup__send-code").css("display", "grid");
			}
		});
		parent.find(".popup__send-code").on("click", function () {
			parent.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
			parent.find(".popup__wait-time").css("opacity", "0");
			parent.find(".popup__wait-time").css("display", "block");
			parent.find(".popup__success").css("display", "flex");
			parent.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
			parent.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
		});
	});
	var popups = $(".popup");
	popups.each(function (index) {
		var close1 = $(this).find(".popup__close");
		var close2 = $(this).find(".popup__wall");
		var popup = $(this);
		close1.on("click", function () {
			popup.addClass("hidden");
		});
		close2.on("click", function () {
			popup.addClass("hidden");
		});
	});
	var items = $(".pass-wrapper");
	items.each(function (index) {
		var eye = $(this).children(".pass__eye");
		var input = $(this).children("input");
		var open = 0;
		eye.on("click", function () {
			if (open == 0) {
				input.attr("type", "text");
				open = 1;
			} else {
				input.attr("type", "password");
				open = 0;
			}
		});
	});
	var left = 1;
	$(".popup__switch").on("click", function () {
		if (left == 1) {
			$(this).addClass("popup__switch--right");
			$(".popup__switch-item-left").removeClass("popup__switch-item--active");
			$(".popup__switch-item-right").addClass("popup__switch-item--active");
			$(".popup__form--phone").css("display", "none");

			if (window.innerWidth > 780) {
				$(".popup__form--mail").css("display", "grid");
			} else {
				$(".popup__form--mail").css("display", "flex");
			}

			left = 0;
		} else {
			$(this).removeClass("popup__switch--right");
			$(".popup__switch-item-left").addClass("popup__switch-item--active");
			$(".popup__switch-item-right").removeClass("popup__switch-item--active");
			$(".popup__form--mail").css("display", "none");

			if (window.innerWidth > 780) {
				$(".popup__form--phone").css("display", "grid");
			} else {
				$(".popup__form--phone").css("display", "flex");
			}

			left = 1;
		}
	});


*/
});