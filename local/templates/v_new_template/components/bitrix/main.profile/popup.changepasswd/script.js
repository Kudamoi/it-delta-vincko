$(document).ready(function () {

	load_modal();

	$('.js-changepasswd-form').submit(function () {

		var $form = $(this);
		console.log($form.attr("action"));
		console.log($form.serialize());
		$.ajax({
			url: $form.attr("action"),
			method: 'POST',
			data: $form.serialize(),
			dataType: 'json',
			success: function (res) {
				alert(2);
				console.log(res);

			},
			fail: function (error) {
				alert(3);
			}
		});
		return false;
	});

});