$(document).ready(function () {

	load_modal();

	$("[name='USER_CHECKWORD_EMAIL'], [name='USER_CHECKWORD_SMS']").change(function () {
		var $form = $(this).parents("form"),
			code = $(this).val();
		$form.find("[name='USER_CHECKWORD']").val(code);
		if (code.replace("_", "").length == 6) {
			$form.find(".popup--new-pass").show()
			$form.find("[type='password']").removeAttr("disabled");
		}
	});

	$("[name='USER_PHONE_NUMBER']").change(function () {
		var $form = $(this).parents("form");
		$form.find("[name='USER_LOGIN']").val($(this).val());
	});

	$(".popup__wait-repeat").click(function () {
		var $form = $(this).parents("form");
		var formAction = $form.attr("action").split("?"),
			formActionChange = formAction[0] + "?forgot_password=yes";
		$form.attr("action", formActionChange);
		$form.find("[name='TYPE']").val("SEND_PWD");
		$("[name='send_account_info']").submit();
	});

	$(".js-forgot-form").submit(function () {
		var $form = $(this),
			$btn = $(document.activeElement),
			btnSerialize = $btn.attr("name") + "=" + $btn.val();
console.log($form.serialize() + "&" + btnSerialize);
		$.ajax({
			url: $form.attr("action"),
			method: 'POST',
			data: $form.serialize() + "&" + btnSerialize,
			dataType: 'json',
			success: function (res) {
				console.log(res);
				if (res.TYPE == 'ERROR') {
					if(res.FIELD >''){
						var $errorBlock = $('[data-field="' + res.FIELD + '"]');
						var $parent = $errorBlock.parent();
						$(".info-popup__text").empty();
						$parent.addClass("unknown");
						$errorBlock.find('.info-popup__text').text(res.MESSAGE);
					}else{
						$form.find(".popup__main").after("<p class='error' style='grid-column: 1/3; color: red'>"+res.MESSAGE+"</p>");
					}

				} else {
					$(".error").remove();
					$(".unknown").removeClass("unknown");
					sendCodeFunc($form.parents(".popup"), $btn.attr("data-switcher"));
					$("[name='USER_CHECKWORD_EMAIL'], [name='USER_CHECKWORD_SMS'],[name='USER_CHECKWORD']").removeAttr("disabled");
					var formAction = $form.attr("action").split("?"),
						formActionChange = formAction[0] + "?change_password=yes";
					$form.attr("action", formActionChange);
					$form.find("[name='TYPE']").val("CHANGE_PWD");
				}
			},
			error: function (error) {
				console.log(error);
			}
		});


		return false;
	});

	var left = 1;
	$(".popup__switch").on("click", function () {
		var $form = $(this).parents(".popup").find("form");
		var formAction = $form.attr("action").split("?"),
			formActionChange = formAction[0] + "?forgot_password=yes";
		$form.attr("action", formActionChange);
		$form.find("[name='TYPE']").val("SEND_PWD");

		$("[name='USER_LOGIN'],[name='USER_EMAIL'],[name='USER_PHONE_NUMBER']").val("").prop('readOnly', false);
		$("[name='USER_CHECKWORD_SMS'],[name='USER_CHECKWORD_EMAIL'],[name='USER_CHECKWORD']").val("").hide();
		$("[name='USER_PASSWORD'],[name='USER_CONFIRM_PASSWORD']").val("");
		$(".send-message-btn").show();
		$(".popup--new-pass").hide();
		if (left == 1) {
			$(this).addClass("popup__switch--right");
			$(".popup__switch-item-left").removeClass("popup__switch-item--active");
			$(".popup__switch-item-right").addClass("popup__switch-item--active");
			$(".popup__form--phone").css("display", "none");

			$form.find("[name='USER_LOGIN']").attr("disabled","disabled");

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

			$form.find("[name='USER_LOGIN']").removeAttr("disabled");

			if (window.innerWidth > 780) {
				$(".popup__form--phone").css("display", "grid");
			} else {
				$(".popup__form--phone").css("display", "flex");
			}

			left = 1;
		}

		$(".pass-input").inputmask({
			regex: "[1-9A-Za-z!@$%^&*()_+-]{8,}",
			showMaskOnHover: false,
			oncomplete: function () {
				$("[name='change_pwd']")
					.removeAttr("disabled")
					.removeClass("blue-button--unactive")
					.addClass("blue-button--active");
			},
			onincomplete: function () {
				$("[name='change_pwd']")
					.attr("disabled", "disabled")
					.addClass("blue-button--unactive")
					.removeClass("blue-button--active");
			}
		})
	});
})

