$(document).ready(function () {
	load_modal();


	$('.js-auth-form').submit(function () {
		var $form = $(this);

		$.ajax({
			url: $form.attr("action"),
			method: 'POST',
			data: $form.serialize(),
			dataType: 'json',
			success: function (res) {
				if (res.TYPE == 'OK') {
					$(".info-popup").remove();
					location.reload();
				} else {
					$(".info-popup").remove();
					$('input[name="' + res.FIELD + '"]').after('<div class="info-popup info-popup--unknown">'
						+ '<div class="info-popup__wrapper">'
						+ '<div class="info-popup__sign">'
						+ '	<svg width="18" height="18" viewBox="0 0 18 18" fill="none"'
						+ '		 xmlns="http://www.w3.org/2000/svg">'
						+ '		<path'
						+ '			d="M8.99996 17.3333C4.40496 17.3333 0.666626 13.595 0.666626 8.99998C0.666626 4.40498 4.40496 0.666645 8.99996 0.666645C13.595 0.666645 17.3333 4.40498 17.3333 8.99998C17.3333 13.595 13.595 17.3333 8.99996 17.3333ZM9.83329 4.83331H8.16663V9.83331H9.83329V4.83331ZM9.83329 11.5H8.16663V13.1666H9.83329V11.5Z"'
						+ '				fill="#FF3232"/>'
						+ '		</svg>'
						+ '	</div>'
						+ '	<div class="info-popup__text">'
						+ res.MESSAGE
						+ '</div>'
						+ '	</div>'
						+ '</div>');
					}
			},
			error: function (error) {
				location.reload();
			}
		});
		return false;
	});
});