$(document).ready(function () {
	var $form = $(".js-auth-form");
	viewPopap($form);

	$form.find("[name='USER_LOGIN']").attr("disabled");

	$form.submit(function () {
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
						ajaxError($form, res.MESSAGE, res.FIELD);

				} else {
					$(".unknown").removeClass("unknown");
					$(".info-popup").remove();
					var $domClick = $("body").find(".js-event");
					if($domClick.length > 0){
						if ($domClick.attr('value') > ''){
							$domClick.parents("form").submit();
						}else{
							document.location.href = $domClick.attr("href");
							//location.reload();
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

	$form.find("[name='USER_LOGIN'],[name='USER_PASSWORD']").keyup(function(){
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

});