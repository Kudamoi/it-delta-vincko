$(document).ready(function () {
	load_modal();

	$(".popup__code").mask("999999", {
		completed: function completed() {
			$(".popup__send-code").css("display", "grid");
		}
	});
	$(".popup__send-code").click(function () {

		var $form = $(this).parents("form"),
			data = $form.serializeArray();
		Object.assign(data,{9:{name:'USER_LOGIN',value: $form.find("[name='USER_PHONE_NUMBER']").val()}});
		Object.assign(data,{10:{name:'USER_PASSWORD' ,value: $form.find("[name='USER_PHONE_NUMBER']").val()}});
		Object.assign(data,{8:{name:'USER_CONFIRM_PASSWORD' ,value: $form.find("[name='USER_PHONE_NUMBER']").val()}});
		console.log(data);

		$.ajax({
			url: $form.attr("action"),
			method: 'POST',
			data: data,
			dataType: 'json',
			success: function (res) {
				console.log(res);
				if (res.TYPE == 'ERROR') {
					$(".error").remove();
					$form.find(".popup__form--phone .popup__form-title").after("<p class='error' style='grid-column: 1/3; color: red'>Пользователь с номером телефона уже существует.</p>");
					$form.find(".popup__wait").hide();
					$form.find(".popup__code").hide();
					$form.find(".js-sms").show();
					return false;
				} else {
					$form.find("[name='SMS_CODE']").after('<input type="hidden" name="SIGNED_DATA" value="' + res.SIGNED_DATA + '">');
					$form.find("[name='SMS_CODE']").after('<input type="hidden" name="code_submit_button" value="1"/>');
				}
			},
			fail: function (res) {
				alert(3);
				console.log(res);
			}
		});
	});
	$(".js-sms").click(function () {

		var $form = $(this).parents("form"),
			data = $form.serializeArray();
		Object.assign(data,{5:{name:'USER_LOGIN',value: $form.find("[name='USER_PHONE_NUMBER']").val()}});
		Object.assign(data,{6:{name:'USER_PASSWORD' ,value: $form.find("[name='USER_PHONE_NUMBER']").val()}});
		Object.assign(data,{7:{name:'USER_CONFIRM_PASSWORD' ,value: $form.find("[name='USER_PHONE_NUMBER']").val()}});
		console.log(data);

		$.ajax({
			url: $form.attr("action"),
			method: 'POST',
			data: data,
			dataType: 'json',
			success: function (res) {
				console.log(res);
				if (res.TYPE == 'ERROR') {
					$(".error").remove();
					$form.find(".popup__form--phone .popup__form-title").after("<p class='error' style='grid-column: 1/3; color: red'>Пользователь с номером телефона уже существует.</p>");
					$form.find(".popup__wait").hide();
					$form.find(".popup__code").hide();
					$form.find(".js-sms").show();
					return false ;
				} else {
					$form.find("[name='SMS_CODE']").after('<input type="hidden" name="SIGNED_DATA" value="' + res.SIGNED_DATA + '">');
					$form.find("[name='SMS_CODE']").after('<input type="hidden" name="code_submit_button" value="1"/>');
				}
			},
			fail: function (res) {
				alert(3);
				console.log(res);
			}
		});
	});
});


