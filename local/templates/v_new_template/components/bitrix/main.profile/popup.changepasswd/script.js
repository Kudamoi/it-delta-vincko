$(document).ready(function () {

	load_modal();

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
				console.log(res);

			},
			error: function (error) {
				console.log(error);
			}
		});
		return false;
	});

});