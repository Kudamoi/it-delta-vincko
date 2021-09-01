$(document).ready(function () {

	$(".js-installment-period").on("change", (function (event) {

		var price = $(this).attr("data-price"),
			div = $(this).val(),
			instPrice = formatInstalmentPrice(price, div);

		$(this).parents(".js-installment").find(".js-installment-price").html(instPrice);

	}));

});


function formatInstalmentPrice(price, div) {
	var result = 0;

	if (price > 0 && div > 0) {
		result = Math.ceil(price / div);
	}
	return number_format(result, 0, ',', '&nbsp;');
}


function number_format(number, decimals = 0, dec_point = '.', thousands_sep = ',') {

	let sign = number < 0 ? '-' : '';

	let s_number = Math.abs(parseInt(number = (+number || 0).toFixed(decimals))) + "";
	let len = s_number.length;
	let tchunk = len > 3 ? len % 3 : 0;

	let ch_first = (tchunk ? s_number.substr(0, tchunk) + thousands_sep : '');
	let ch_rest = s_number.substr(tchunk)
		.replace(/(\d\d\d)(?=\d)/g, '$1' + thousands_sep);
	let ch_last = decimals ?
		dec_point + (Math.abs(number) - s_number)
			.toFixed(decimals)
			.slice(2) :
		'';

	return sign + ch_first + ch_rest + ch_last;
}