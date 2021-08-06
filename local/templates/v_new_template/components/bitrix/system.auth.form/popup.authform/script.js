$(document).ready(function () {
	load_modal();
	$("[name='USER_LOGIN']").attr("disabled");

	$("[name='USER_LOGIN'],[name='USER_PASSWORD']").keyup(function(){
		if ($(this).inputmask("isComplete")) {
			$(this).attr("data-complete", 1);
		}else {
			$(this).attr("data-complete", 0);
		}
		if($("[name='USER_LOGIN']").attr("data-complete") == 1 && $("[name='USER_PASSWORD']").attr("data-complete") == 1){
			$("[name='Login']").removeClass("blue-button--unactive");
			$("[name='USER_LOGIN']").removeAttr("disabled");
		}else{
			$("[name='Login']").addClass("blue-button--unactive");
			$("[name='USER_LOGIN']").attr("disabled");

		}
	});
	$('.js-auth-form').submit(function () {
		var $form = $(this),
			$btn = $(document.activeElement),
			btnSerialize = $btn.attr("name") + "=" + $btn.val(),
			action = $form.attr("action");
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
					$(".error").remove();
					$(".unknown").removeClass("unknown");
					$(".info-popup__text").empty();
					if (res.FIELD > '') {
						var $errorBlock = $('[data-field="' + res.FIELD + '"]');
						var $parent = $errorBlock.parent();
						$parent.addClass("unknown");
						$('[name="' + res.FIELD + '"]').show();
						if (res.FIELD == "USER_PASSWORD"){
							$('[name="' + res.FIELD + '"]')
								.attr("type","text").val("").attr("placeholder",res.MESSAGE)
								.parent().addClass("unknown");
						}else {
							$errorBlock.find('.info-popup__text').text(res.MESSAGE);
						}
					} else {
						$form.find(".popup__main").after("<p class='error' style='grid-column: 1/3; color: red'>" + res.MESSAGE + "</p>");
					}
				} else {
					$(".unknown").removeClass("unknown");
					$(".info-popup").remove();
					var $domClick = $("body").find(".js-event");
					if($domClick.length > 0){
						if ($domClick.attr('value') > ''){
							$domClick.parents("form").submit();
						}else{
							//document.location.href = $domClick.attr("href");
							location.reload();
						}
					}else{
						location.reload();
					}

				}
			},
			error: function (error) {
				console.log(error);
				//location.reload();
			}
		});
		return false;
	});
});