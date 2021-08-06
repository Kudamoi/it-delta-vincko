$(document).ready(function () {

	load_modal();

	$("[name='NEW_PASSWORD'],[name='NEW_PASSWORD_CONFIRM']").keyup(function(){
		if ($(this).inputmask("isComplete")) {
			$(this).attr("data-complete", 1);
		}else {
			$(this).attr("data-complete", 0);
		}
		if($("[name='NEW_PASSWORD']").attr("data-complete") == 1 && $("[name='NEW_PASSWORD_CONFIRM']").attr("data-complete") == 1){
			btnActive($(this).parents("form"));
		}else{
			btnUnActive($(this).parents("form"));
		}
	});

	btnUnActive($('.js-changepasswd-form'));

	$('.js-changepasswd-form').submit(function () {

		var $form = $(this),
			$btn = $(document.activeElement),
			btnSerialize = $btn.attr("name") + "=" + $btn.val(),
			action = $form.attr("action");

		console.log(action);
		console.log($form.serialize());
		$.ajax({
			url: action,
			method: 'POST',
			data: $form.serialize() + "&" + btnSerialize,
			dataType: 'json',
			success: function (res) {
				if (res.TYPE == 'ERROR') {
					ajaxError($form, res.MESSAGE, res.FIELD);
				}else{
					$form.parents(".popup").find(".popup__content").html("<div class='popup__head'>"+
						res.MESSAGE +
						"<div class='popup__close'>" +
						"<svg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'>" +
						"<path d='M8.99926 7.99993L14.8713 2.12784C14.9874 1.99234 15.048 1.81804 15.0411 1.63977C15.0343 1.46149 14.9604 1.29239 14.8342 1.16624C14.7081 1.04009 14.5389 0.966185 14.3607 0.959299C14.1824 0.952413 14.0081 1.01305 13.8726 1.12909L8.00051 7.00118L2.12843 1.12201C1.99504 0.988629 1.81414 0.913696 1.62551 0.913696C1.43688 0.913696 1.25598 0.988629 1.12259 1.12201C0.989211 1.25539 0.914278 1.4363 0.914278 1.62493C0.914278 1.81356 0.989211 1.99446 1.12259 2.12784L7.00176 7.99993L1.12259 13.872C1.04844 13.9355 0.988221 14.0137 0.945705 14.1015C0.903188 14.1894 0.879296 14.2851 0.875528 14.3827C0.87176 14.4802 0.888197 14.5775 0.923808 14.6684C0.959419 14.7593 1.01344 14.8419 1.08247 14.9109C1.1515 14.9799 1.23405 15.0339 1.32495 15.0695C1.41584 15.1052 1.51312 15.1216 1.61067 15.1178C1.70822 15.1141 1.80394 15.0902 1.89182 15.0477C1.9797 15.0051 2.05784 14.9449 2.12134 14.8708L8.00051 8.99868L13.8726 14.8708C14.0081 14.9868 14.1824 15.0474 14.3607 15.0406C14.5389 15.0337 14.7081 14.9598 14.8342 14.8336C14.9604 14.7075 15.0343 14.5384 15.0411 14.3601C15.048 14.1818 14.9874 14.0075 14.8713 13.872L8.99926 7.99993Z' fill='#005DFF'></path>" +
						"</svg>" +
						"</div></div>");
				}
			},
			error: function (error) {
				console.log(error);
			}
		});
		return false;
	});

});