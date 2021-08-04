$(document).ready(function () {
	load_modal();

	$(".popup__code").mask("999999", {
		completed: function completed() {
			$(".popup__send-code").css("display", "grid");
		}
	});

	$(".js-registration").submit(function () {
		var $form = $(this).parents("form"),
			$btn = $(document.activeElement),
			btnSerialize = $btn.attr("name") + "=" + $btn.val();

		$.ajax({
			url: $form.attr("action"),
			method: 'POST',
			data: $form.serialize() + "&" + btnSerialize,
			dataType: 'json',
			success: function (res) {
				console.log(res);

				if (res.TYPE == 'ERROR') {
					$(".error").remove();
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

					$form.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
					$form.find(".popup__wait").css("opacity", "0")
					$form.find(".popup__wait-time").css("display", "block")
					$form.find(".popup__success").css("display", "flex");
					$form.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
					$form.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");				}
			},
			error: function (error) {
				console.log(error);
			}
		});
	});

	$(".js-sms").click(function () {

		var $form = $(this).parents("form");
		console.log($form.attr("action"));
		console.log($form.serialize());

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

});


