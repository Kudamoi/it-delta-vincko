$(document).ready(function () {
	load_modal();

	$('.js-auth-form').submit(function () {
		var $form = $(this);
		console.log($form.serialize());
		console.log($form.attr("action"));
		$.ajax({
			url: $form.attr("action"),
			method: 'POST',
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
			fail: function (error) {}
		});
		return false;
	});
alert();
	var phone = $(".js-auth-form .phone-input");
	phone.inputmask("+7(999) 999-9999");
	phone.keyup(function () {
		showBtn(phone, $('.js-auth-form'), "phone");
	});
	/*
	var regNumber = 0;
		var selector = document.getElementsByClassName("phone-input");
		var popupers = $(".popup");

		popupers.each(function (index) {
			$("input").keyup(function () {
				if (parent.hasClass("popup--registration")) {
					regShowBtn();
				}
			});
			var parent = $(this);
			var phone = parent.find(".phone-input");
			var email = parent.find(".mail-input");
			phone.inputmask("+7(999) 999-9999");
			showBtn(phone, parent, "phone");

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
			var parent1 = parent.find(".popup__form--phone");
			var parent2 = parent.find(".popup__form--mail");
			parent1.find(".popup__code").mask("999999", {
				completed: function completed() {
					parent1.find(".popup__send-code").css("display", "grid");
				}
			});
			parent1.find(".popup__code").mask("999999", {
				completed: function completed() {
					parent1.find(".popup__send-code").css("display", "grid");
				}
			});
			parent2.find(".popup__code").mask("999999", {
				completed: function completed() {
					parent2.find(".popup__send-code").css("display", "grid");
				}
			});
			parent1.find(".popup__send-code").on("click", function () {
				if (parent.hasClass("popup--registration")) {
					regNumber = 1;
					regShowBtn();
				}

				parent1.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
				parent1.find(".popup__wait").css("opacity", "0");
				parent1.find(".popup__wait-time").css("display", "block");
				parent1.find(".popup__success").css("display", "flex");
				parent1.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
				parent1.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
			});
			parent2.find(".popup__send-code").on("click", function () {
				if (parent.hasClass("popup--registration")) {
					regNumber = 1;
					regShowBtn();
				}

				parent2.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
				parent2.find(".popup__wait").css("opacity", "0");
				parent2.find(".popup__wait-time").css("display", "block");
				parent2.find(".popup__success").css("display", "flex");
				parent2.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
				parent2.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
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
		$("#agree").on("click", function () {
			regShowBtn();
		});
		$(".pass-input").inputmask({
			regex: "[1-9A-Za-z!@$%^&*()_+-]",
			showMaskOnHover: false
		});

	});*/
});