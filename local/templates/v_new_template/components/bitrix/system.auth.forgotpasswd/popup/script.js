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

	$form.find("[name='USER_PHONE_NUMBER']").keyup(function () {
		var $form = $(this).parents("form");
		$form.find("[name='USER_LOGIN']").val($(this).val());
	});

	$form.find("[name='USER_PHONE_NUMBER'],[name='USER_EMAIL']").keyup(function () {
		removeError();
		if ($(this).inputmask("isComplete")) {
			btnActive($(this).parents("form").find("[name='send_account_info']"));
		}
	});

	$form.find("[name='USER_PASSWORD'],[name='USER_CONFIRM_PASSWORD']").keyup(function(){
		changePass($form, $(this),"[name='USER_PASSWORD']","[name='USER_CONFIRM_PASSWORD']");
	});

	$form.find(".popup__wait-repeat").click(function () {
		var $form = $(this).parents("form");
		var formAction = $form.attr("action").split("?"),
			formActionChange = formAction[0] + "?forgot_password=yes";
		$form.attr("action", formActionChange);
		$form.find("[name='TYPE']").val("SEND_PWD");
		$("[name='send_account_info']").trigger("click");
	});

	$form.submit(function(){
		return false;
	})

	$(".js-btn").on("click",function () {
		var $btn = $(this),
			btnSerialize = $btn.attr("name") + "=" + $btn.val(),
			action = $form.attr("action");
		if($btn.attr("name") == "code_check_submit_button"){
			action = "/ajax/check_code.php";
		}

		$.ajax({
			url: action,
			method: 'POST',
			data: $form.serialize() + "&" + btnSerialize,
			dataType: 'json',
			success: function (res) {
				console.log(res);
				var formAction = $form.attr("action").split("?");
				if (res.TYPE == 'ERROR') {
					ajaxError($form, res.MESSAGE, res.FIELD);
					if($btn.attr("name") =='change_pwd' && res.FIELD == "CHECKWORD"){
						btnUnActive($form.find(".js-btn-disabled"));
						$(".popup").find(".js-change-pwd").hide();
						var classes;
							if($("[name='USER_CHECKWORD_SMS']").val()>''){
								classes = "popup__form--phone";
						}else{
								classes = "popup__form--mail";
						}
						$(".popup").find(".js-forgot-pwd:not(form .js-forgot-pwd)").show();
						$form.find(".popup__form."+classes+".js-forgot-pwd").css("display","grid");

						var formActionChange = formAction[0] + "?forgot_password=yes";
						$form.attr("action", formActionChange);
						$form.find("[name='TYPE']").val("SEND_PWD");
					}
					if( $btn.attr("name") == 'send_account_info'){
						// если нажата кнопка send_account_info, деактивируем ее
						btnUnActive($btn);
					}
				} else {
					removeError();

					if( $btn.attr("name") == 'code_check_submit_button') {
						// успех при отправки кода
						var formActionChange = formAction[0] + "?change_password=yes";
						$(".popup").find(".js-change-pwd").show();
						$form.find(".js-change-pwd").css("display","flex");
						$(".popup").find(".js-forgot-pwd").hide();


						$form.attr("action", formActionChange);
						$form.find("[name='TYPE']").val("CHANGE_PWD");
						$form.parents(".popup").addClass("popup--new-pass");

					}else if ($btn.attr("name") == 'change_pwd'){
						// успех при изменении пароля
						$(".js-in-modal.js-modal-auth").trigger("click");

					}else if ( $btn.attr("name") =='send_account_info'){
						// событие отправки смс
						if($btn.attr("data-switcher") == 'mail'){
							$btn.parents(".popup__main").find(".js-info-mail").show();
							$btn.parent().find(".popup__success").css("display", "flex");
						}else {
							$btn.parent().find(".sms_code").show();
							$("[name='USER_CHECKWORD_SMS'],[name='USER_CHECKWORD']").removeAttr("disabled");
							sendCodeFunc($form.parents(".popup"), $btn.attr("data-switcher"));
						}
					}


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

