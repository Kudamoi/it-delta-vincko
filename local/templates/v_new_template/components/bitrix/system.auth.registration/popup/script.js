$(document).ready(function () {
	var $form = $(".js-registration-form");

	viewPopap($form);
	btnUnActive($form.find("[name='Register']"));

	$form.submit(function () {

		var $form = $(this),
			$btn = $(document.activeElement),
			btnSerialize = $btn.attr("name") + "=" + $btn.val(),
			action = $form.attr("action");
		if ($btn.attr("name") == "code_check_submit_button") {
			action = "/ajax/check_code.php";
		}

		console.log($form.attr("action"));
		console.log($form.serialize());
		console.log(btnSerialize);


		$.ajax({
			url: action,
			method: 'POST',
			data: $form.serialize() + "&" + btnSerialize,
			dataType: 'json',
			success: function (res) {
				console.log(res);
				if (res.TYPE == 'ERROR') {
					ajaxError($form, res.MESSAGE, res.FIELD);

					if ($btn.attr("name") == "code_check_submit_button") {
						sendCodeFunc($form.parents(".popup"), $btn.attr("data-switcher"));
					}
				} else {
					// смс успешно отправлено
					if ($btn.attr("name") == "code_submit_button") {
						sendCodeFunc($form, "phone");
						$form.find("[name='SMS_CODE']").removeAttr("disabled").after('<input type="hidden" name="SIGNED_DATA" value="' + res.SIGNED_DATA + '">');
					}
					if ($btn.attr("name") == "code_check_submit_button") {
						schowBtnSendCode($form);
						$form.find(".sms_code").hide();
						btnActive($form.find("[name='Register']"));


						/*$("[name='USER_AGREEMENT']").change(function (){
							if($(this).prop("checked")){
								$('[name="Register"]')
									.addClass("btn-registration--active")
									.removeClass("btn-registration--unactive")
									.removeAttr("disabled");
							}else{
								$('[name="Register"]')
									.addClass("btn-registration--unactive")
									.removeClass("btn-registration--active")
									.attr("disabled","disabled");
							}
						});*/
					}
					if ($btn.attr("name") == "Register") {
						$(".js-modal-auth").trigger("click");
						//location.reload();
					}
				}
			},
			error: function (error) {
				console.log(error);
			}
		});

		return false;
	});

	$form.find(".popup__wait-repeat").click(function () {
		var $form = $(this).parents("form");
		$.ajax({
			url: "/ajax/get_code.php",
			method: 'POST',
			data: $form.serialize(),
			dataType: 'json',
			success: function (res) {
				console.log(res);
				if (res.TYPE == 'ERROR') {
					ajaxError($form, res.MESSAGE, res.FIELD);
				} else {
					removeError();

				}
			},
			error: function (error) {
			}
		});
	});

	$("[name='USER_LOGIN']").keyup(function () {
		removeError();
		var $form = $(this).parents("form");
		$form.find("[name='USER_PHONE_NUMBER']").val($(this).val());
		if ($(this).inputmask("isComplete")) {
			btnActive($form.find(".send-message-btn"));
		} else {
			btnUnActive($form.find(".send-message-btn"));
		}
	});

	/*
		$(".js-sms").click(function () {
			alert();
			if(!$(this).hasClass("grey-border-button--active")){
				//return false;
			}
			var $form = $(this).parents("form");


			$.ajax({
				url: $form.attr("action"),
				method: 'POST',
				data: $form.serialize(),
				dataType: 'json',
				success: function (res) {
					console.log(res);
					if (res.TYPE == 'ERROR') {
						if (res.FIELD > '') {
							var $errorBlock = $('[data-field="' + res.FIELD + '"]');
							var $parent = $errorBlock.parent();
							$(".info-popup__text").empty();
							$parent.addClass("unknown");
							$errorBlock.find('.info-popup__text').text(res.MESSAGE);
							$form.find(".popup__wait").hide();
							$form.find(".popup__code").hide();
							$form.find(".js-sms").show();
						} else {
							$form.find(".popup__main").after("<p class='error' style='grid-column: 1/3; color: red'>" + res.MESSAGE + "</p>");
						}
					} else {
						$(".error").remove();
						$(".unknown").removeClass("unknown");
						$form.find("[name='SMS_CODE']").after('<input type="hidden" name="SIGNED_DATA" value="' + res.SIGNED_DATA + '">');
					}
				},
				error: function (error) {
					console.log(error);
				}
			});

	});*/



});


