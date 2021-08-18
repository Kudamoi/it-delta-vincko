$(document).ready(function () {
	//order page installment calculate
	let currentlyPrice = Number($('#b-data-old-sum').attr('data-old-sum'));
	console.log(currentlyPrice);
	console.log('123');
	$('#b-form-order-ajax').find('.payment-method__price-month').html(Math.ceil(currentlyPrice / 12) + ' ₽');

	$(".js-bonuce").click(function(e){
		e.preventDefault();
		$(".header__popup").removeClass("hidden");
		return false;
	});
	$('#back_call .form__control[name=phone]').inputmask("+7 (999) 999-99-99");

	$("#b-add-order").click(
		function () {
			sendAjaxForm('result_form', 'b-form-order-ajax', '/ajax/addorder.php');
			return false;
		}
	);
	$("#b-equipitem-current").on('click', '.js-refresh-equipitem-data-ajax', function () {
		let slug = $(this).data("slug");
		const pageUrl = '/equipment-kits/';
		history.pushState(null, null, pageUrl + slug + '/');
		$.ajax({
			url: "/ajax/equipitem.php",
			type: "POST",
			dataType: "html",
			data: {'ELEMENT_CODE': slug},
			success: function (data) {
				$('#b-equipitem-current').html(data)
			}
		});
	});
	$("#b-packageitem-current").on('click', '.js-refresh-packageitem-data-ajax', function () {
		let slug = $(this).data("slug");
		const pageUrl = '/packages/';
		history.pushState(null, null, pageUrl + slug + '/');
		$.ajax({
			url: "/ajax/packageitem.php",
			type: "POST",
			dataType: "html",
			data: {'ELEMENT_CODE': slug},
			success: function (data) {
				$('#b-packageitem-current').html(data)
			}
		});
	});


	$('#back_call .form__control[name=phone]').inputmask("+7 (999) 999-99-99");

	$("#ajax_form_callback_btn").on('click', function () {
			$.ajax({
				url: '/ajax/callback_reg.php',
				type: "POST",
				dataType: "html",
				data: $("#ajax_form_callback").serialize(),
				success: function (response) {
					if (response == 'errEnt') {
						$('#back_call').append('<div id="js-callback-error" style="text-align: center;   color: red;margin-top: 30px; "class="">Поля не до конца заполнены, заполните их до конца и повторите снова</div>');
						setTimeout(function () {
							$("#js-callback-error").hide('fast');
						}, 2000);
					} else {
						let html = '<div id="js-callback-ok" class=""><div class="callback__title">Заявка принята!</div><div class="callback__description">В ближайшее время с Вами свяжутся наши менеджеры</div></div>'
						$('#back_call').html(html);
					}

				},
				error: function (response) {
					let html = '<div id="js-callback-ok" class=""><div class="callback__title">Ошибка!</div><div class="callback__description">Данные не отправлены. Сообщите об этом администратору!</div></div>'
					$('#back_call').html(html);
				}
			});
		}
	);
	$('.ready-pack__item').each(function () {
		let currentlyPrice = Number($(this).find('.ready-pack__bottom .ready-pack__bottom-result .currently-price').html().replace(/\s/g, ''));
		$(this).find('.ready-pack__bottom .solutions__bottom_column-price').html(Math.ceil(currentlyPrice / 12) + ' ₽');
	})
	$('.solutions__bottom_column-select').on('change', function () {
		let currentlyPrice = Number($(this).closest('.ready-pack__bottom').find('.currently-price').html().replace(/\s/g, ''));
		$(this).closest('.ready-pack__bottom').find('.solutions__bottom_column-price').html(Math.ceil(currentlyPrice / $(this).val()) + ' ₽');
	})
	$('.solutions__bottom_right').each(function () {
		let currentlyPrice = Number($(this).find('.solutions__bottom_column-newprice').html().replace(/\s/g, '').replace('₽', '').replace('&nbsp;', ''));
		$(this).find('.solutions__bottom_column-price').html(Math.ceil(currentlyPrice / 12) + ' ₽');
	})




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
			/* $(".popup__form--phone .grey-border-button").css("display", "none");
             $(".popup__form--phone .popup__code").css("display", "block");
               */
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
	$(".new-pass-button").on("click", function () {
		$(".popup").addClass("hidden");
		$(".popup--new-pass").removeClass("hidden");
	});
	$(".to-registration").on("click", function () {
		$(".popup").addClass("hidden");
		$(".popup--registration").removeClass("hidden");
	});
	$(".to-login").on("click", function () {
		$(".popup").addClass("hidden");
		$(".popup--login").removeClass("hidden");
	});
	$(".forget-pass").on("click", function () {
		$(".popup").addClass("hidden");
		$(".popup--forget").removeClass("hidden");
	});

	$(".footer_bottom-js").on("click", function(){
		$("#input_phone").focus();
	});

	// $('form').submit(function(){
	// 	$.ajax({
	// 		type: "POST",
	// 		url: $(this).attr('action'),
	// 		data: $(this).serialize()+'&ajax_key=Y',
	// 		dataType: "json",
	// 		success: function(data)
	// 		{
	// 			if (data.type == 'error') {
	// 				alert(data.message);
	// 			} else {
	// 				alert('Вы авторизовались!');
	// 			}
	// 		}
	// 	});
	//
	// });
	/* Article FructCode.com */
});

//функция оформления заказа
function sendAjaxForm(result_form, ajax_form, url) {

	$error = $("#" + ajax_form).find(".form__required"),
		top1 = $("#" + ajax_form).position().top,
		class_name = "error";

	$('.js-check-valid-field').removeClass(class_name);

	$.ajax({
		url: url, //url страницы
		type: "POST", //метод отправки
		dataType: "html", //формат данных
		data: $("#" + ajax_form).serialize(),  // Сеарилизуем объект
		success: function (response) { //Данные отправлены успешно
			response = $.parseJSON(response);
			if (response.type == 'error') {

				$('html').scrollTop(top1);
				$error.show();
				$.each(response.msg, function (i, value) {
					$('input[name="' + value + '"]').addClass('error');
				});


				//$('#b-form-order-ajax-errors').html("<style>.messages{margin-bottom: 20px;}</style><span style='color: red;font-size: 1.2em;'>" + response.msg + "</span>");
			} else if (response.type == 'ok') {
				window.location.href = response.url;
			}
		},
		error: function (response) { // Данные не отправлены
			$('#b-form-order-ajax-errors').html('Ошибка. Данные не отправлены.');
		}
	});


}


