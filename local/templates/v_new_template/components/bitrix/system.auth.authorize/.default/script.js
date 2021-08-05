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
});