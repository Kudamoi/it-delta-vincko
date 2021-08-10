$(document).ready(function () {
	var $form = $(".js-forgot-form");
	viewPopap($form);


	$form.find("[name='USER_CHECKWORD_EMAIL'], [name='USER_CHECKWORD_SMS']").keyup(function(){
		var $form = $(this).parents("form");
		if ($(this).inputmask("isComplete")) {

			$(this).parent().find(".popup__send-code").css("display", "grid");
		}else {
			$(this).find(".popup__send-code").css("display", "none");
		}
		$form.find("[name='USER_CHECKWORD']").val($(this).val());

	});

	$form.find(".popup__send-code").click(function(){

		$(".js-forgot-form").submit();

		$form.find(".popup__send-code, .popup__code,  .popup__wait-repeat").show();
		$form.find(".popup__wait").css("opacity", "1")
		$form.find(".popup__wait-time").css("display", "none")
		$form.find(".popup__success").css("display", "none");
		$form.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--active");
		$form.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--unactive");
		/*
		var $form = $(this).parents("form");
		$.ajax({
			url: "/ajax/profile-forgot-change-password.php",
			method: 'POST',
			data: $form.serialize(),
			dataType: 'html',
			success: function (html) {
				$form.after(html);
			},
			error: function (error) {
				console.log(error);
			},
		});
		$form.find(".popup--new-pass").show()
		$form.find("[type='password']").removeAttr("disabled");
		$form.find(".popup__send-code, .popup__code,  .popup__wait-repeat").show();
		$form.find(".popup__wait").css("opacity", "1")
		$form.find(".popup__wait-time").css("display", "none")
		$form.find(".popup__success").css("display", "none");
		$form.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--active");
		$form.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--unactive");*/
		return false;
	});

	$form.find("[name='USER_PHONE_NUMBER']").keyup(function () {
		var $form = $(this).parents("form");
		$form.find("[name='USER_LOGIN']").val($(this).val());
	});

	$form.find("[name='USER_PHONE_NUMBER'],[name='USER_EMAIL']").keyup(function () {
		if ($(this).inputmask("isComplete")) {
			btnActive($(this).parents("form").find("[name='send_account_info']"));
		}
	});

	$form.find(".popup__wait-repeat").click(function () {
		var $form = $(this).parents("form");
		var formAction = $form.attr("action").split("?"),
			formActionChange = formAction[0] + "?forgot_password=yes";
		$form.attr("action", formActionChange);
		$form.find("[name='TYPE']").val("SEND_PWD");
		$("[name='send_account_info']").submit();
	});



	$form.submit(function () {
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
					ajaxError($form, res.MESSAGE, res.FIELD);
					if( $btn.attr("name") == 'send_account_info'){
						// если нажата кнопка send_account_info, деактивируем ее
						btnUnActive($btn);
					}
				} else {
					btnActive($btn);
					removeError();
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
		var formAction = $form.attr("action").split("?"),
			formActionChange = formAction[0] + "?forgot_password=yes";
		$form.attr("action", formActionChange);
		$form.find("[name='TYPE']").val("SEND_PWD");
		$("[name='USER_LOGIN']," +
			"[name='USER_PHONE_NUMBER']," +
			"[name='USER_EMAIL']"+
			"[name='USER_CHECKWORD_SMS']," +
			"[name='USER_CHECKWORD_EMAIL']," +
			"[name='USER_CHECKWORD']").val("");

		desroySendCode($form);

		removeError();

		$(".popup--new-pass").hide();

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
})

