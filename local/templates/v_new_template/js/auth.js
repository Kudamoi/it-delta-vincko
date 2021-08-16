function timer(parent) {
	parent.find(".popup__wait-time").css("display", "block");
	parent.find(".popup__wait").css("display", "block");
	let _Seconds = (parent.find(".popup__wait-time").attr("data-interval")?? 60 ),
		int;
	parent.find('.popup__wait-num').text(_Seconds); // выводим получившееся значение в блок

	int = setInterval(function () { // запускаем интервал
		if (_Seconds > 0) {
			_Seconds--; // вычитаем 1
			parent.find('.popup__wait-num').text(_Seconds); // выводим получившееся значение в блок
		} else {
			parent.find(".popup__wait-repeat").css("display", "block");
			parent.find(".popup__wait-time").css("display", "none");
			clearInterval(int); // очищаем интервал, чтобы он не продолжал работу при _Seconds = 0
		}
	}, 1000);
}

function regShowBtn(){}
function showBtn(selector, parent, switcher) {

	if (selector.inputmask("isComplete")) {

		parent.find((".popup__form--" + switcher + " .grey-border-button--unactive")).removeClass("grey-border-button--unactive");
		parent.find((".popup__form--" + switcher + " .grey-border-button")).addClass("grey-border-button--active");

		parent.find((".popup__form-mod--" + switcher + " .send-message-btn")).removeAttr("disabled");
		parent.find((".popup__form-mod--" + switcher + " .send-message-btn")).on("click", function () {

			if (parent.find(".info-popup--unknown").length > 0) {
			} else {
				sendCodeFunc(parent, switcher);
			}

		})

	} else {

		parent.find((".popup__form--" + switcher + " .grey-border-button")).addClass("grey-border-button--unactive");
		parent.find((".popup__form--" + switcher + " .grey-border-button")).removeClass("grey-border-button--active");
	}

}


function schowBtnSendCode($form){
	$form.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
	$form.find(".popup__wait").css("opacity", "0")
	$form.find(".popup__wait-time").css("display", "block")
	$form.find(".popup__success").css("display", "flex");
	$form.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
	$form.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
}

function sendCodeFunc(parent, switcher) {
	parent.find(".popup__form--" + switcher + " .grey-border-button").css("display", "none");
	parent.find(".popup__form--" + switcher + " .popup__code").css("display", "block");
	parent.find(".popup__form--" + switcher + " .sms_code").show();
	if(parent.find(".popup__form--" + switcher + " .popup__wait-time").length > 0) {
		timer(parent.find(".popup__form--" + switcher));
	}
}

function desroySendCode($form){
	$form.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
	$form.find(".popup__wait").css("opacity", "0")
	$form.find(".popup__wait-time").css("display", "block")
	$form.find(".popup__success").css("display", "none");
	$form.find(".js-info-mail").css("display", "none");
	$form.find(".sms_code").hide();
	$form.find(".send-message-btn").show();
	btnUnActive($form.find(".send-message-btn"));
}

function viewPopap($form) {

	$form.find(".js-in-modal").on("click", (function (event) {
		load_modal($(this));
		return false;
	}));

	$form.find(".pass-input").inputmask({
		regex: "[0-9A-Za-z!@$%^&*()_+-]{8,}",
		showMaskOnHover: false,
	});

	$form.find(".popup__code").keyup(function(){
		var $form = $(this).parents("form");
		if ($(this).inputmask("isComplete")) {
			$form.find(".popup__send-code").css("display", "grid");
		}else{
			$form.find(".popup__send-code").css("display", "none");
		}
	});

	$form.find(".popup__code").inputmask("999999");

	$form.find(".phone-input").inputmask("+7(999) 999-9999", {
		completed: function () {
	}});


	$form.find(".mail-input").inputmask({alias: 'email'}).on('click touchpress', function() {
		var cursor_pos = $(this).getCursorPosition(),
			p_this = $(this)
		setTimeout(function() {
			// console.log(p_this.val())
			if(p_this.val() === '') {
				p_this.setCursorPosition(0)
				return
			}
			p_this.setCursorPosition(cursor_pos)
		}, 3)
	});


	$form.find(".pass__eye").on("click", function () {
		var $input = $(this).parents(".pass-wrapper").find("input"),
			view = $input.attr("data-view");
		if (view == 0) {
			$input.attr("type", "text");
			$input.attr("data-view", 1)
		} else {
			$input.attr("type", "password");
			$input.attr("data-view", 0);
		}
		return false;
	});

	$form.find(".popup__wait-repeat").on("click", function () {
		$form.find(".popup__wait-repeat").css("display", "none");
		$form.find(".popup__wait-time").css("display", "block");
		timer($form);
	});



	$(".popup__close,.popup__wall").on("click", function () {
		closePopup();
	});
}

function closePopup() {
	$(".popup").addClass("hidden").remove();
	$(".js-event").removeAttr("data-ajax-stop");
}

function hideHelp(pthis){
	pthis.unknown
}

function clickModal() {
}

function load_modal(pthis) {
	var $new_modal,
		ajax_url;

	if (pthis.hasClass("js-modal-change-password")) {
		$new_modal = $(".popup--new-pass");
		ajax_url = "/ajax/profile-change-password.php";
	}
	if (pthis.hasClass("js-modal-auth")) {
		$new_modal = $(".popup--login");
		ajax_url = "/ajax/profile-auth.php";
	}
	if (pthis.hasClass("js-modal-forgot")) {
		$new_modal = $(".popup--forget");
		ajax_url = "/ajax/profile-forgot.php";
	}
	if (pthis.hasClass("js-modal-registration")) {
		$new_modal = $(".popup--registration");
		ajax_url = "/ajax/profile-registration.php";
	}

	$.ajax({
		url: ajax_url,
		method: 'POST',
		dataType: 'html',
		success: function (html) {
			closePopup();
			$("footer").before(html);

		}
	});
}

function ajaxError($form, message, field = "") {
	$form.find(".error").remove();
	$form.find(".unknown").removeClass("unknown");
	$form.find(".info-popup__text").empty();
	if (field > '') {
		var $errorBlock = $form.find('.info-popup[data-field="' + field + '"]');
		var $parent = $errorBlock.parent();
		$parent.addClass("unknown");

		$form.find('input[data-field="' + field + '"]').show();
		if (field == "USER_PASSWORD") {
			$form.find('[name="' + field + '"]')
				.attr("type", "text").val("").attr("placeholder", message)
				.parent().addClass("unknown");
		} else {
			$errorBlock.find('.info-popup__text').text(message);
		}
		setTimeout(function () {
			$parent.find('.info-popup__text').hide();
		}, 1000);
		$parent.find(".info-popup__sign").find("svg").mouseenter(function(){
			$(this).parents(".info-popup").find('.info-popup__text').show();
		}).mouseleave(function(){
			$(this).parents(".info-popup").find('.info-popup__text').hide();
		})
	} else {
		$form.find(".popup__main").after("<p class='error' style='grid-column: 1/3; color: red'>" + message + "</p>");
	}
}

function sendCodeFuncDestroy($form) {
	$form.find(".popup__send-code, .popup__code,  .popup__wait-repeat").show();
	$form.find(".popup__wait").css("opacity", "1")
	$form.find(".popup__wait-time").css("display", "none")
	$form.find(".popup__success").css("display", "none");
	$form.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--active");
	$form.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--unactive");
}

function removeError(){
	$(".error").remove();
	$(".unknown").removeClass("unknown");
}



function showCode(){}
function hideCode(){}

function changePass($form,$phis,pass,pass_confirm){
	if ($phis.inputmask("isComplete")) {
		$phis.attr("data-complete", 1);
	}else {
		$phis.attr("data-complete", 0);
	}

	if($(pass).attr("data-complete") == 1 && $(pass_confirm).attr("data-complete") == 1){
		btnActive($form.find(".js-btn-disabled"));
	}else{
		btnUnActive($form.find(".js-btn-disabled"));
	}

}

function btnActive($btn) {
	$btn
		.removeAttr("disabled")
		.removeClass("blue-button--unactive")
		.removeClass("grey-border-button--unactive")
		.addClass("blue-button--active")
		.addClass("grey-border-button--active");

}

function btnUnActive($btn) {
	$btn
		.attr("disabled", "disabled")
		.removeClass("blue-button--active")
		.removeClass("grey-border-button--active")
		.addClass("blue-button--unactive")
		.addClass("grey-border-button--unactive");
}

$(document).ready(function () {
	$(".js-modal").on("click", (function (event) {
		$(".js-modal").removeClass("js-event");
		$(this).addClass("js-event");
		load_modal($(this));
		return false;
	}));
});


$.fn.setCursorPosition = function(pos) {
	this.each(function(index, elem) {
		if (elem.setSelectionRange) {
			elem.setSelectionRange(pos, pos)
		}
		else if (elem.createTextRange) {
			var range = elem.createTextRange()
			range.collapse(true)
			range.moveEnd('character', pos)
			range.moveStart('character', pos)
			range.select()
		}
	})
	return this
}
$.fn.getCursorPosition = function() {
	var pos = 0,
		el = $(this).get(0)
	if(document.selection) {
		el.focus()
		var Sel = document.selection.createRange()
		var SelLength = document.selection.createRange().text.length
		Sel.moveStart('character', -el.value.length)
		pos = Sel.text.length - SelLength
	}
	else if(el.selectionStart || el.selectionStart == '0')
		pos = el.selectionStart
	return pos
}