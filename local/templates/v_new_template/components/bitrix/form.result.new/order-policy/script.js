$(document).ready(function () {

	var forms = document.getElementsByClassName('form');
	var btns = $('.close-btn');
	var btnns = $('.form__bottom div');

	for (var i = 0; i < btns.length; i++) {
		closeOpenBlockBtn(btns[i], forms[i]);
	}



	var value = $('input[name="radio"]:checked').val();

	$("[name='web_form_apply']").click(function(){
		$(this).parents("section").find("form").submit();
	})

	$(".js-check-form-valid").click(function (e) {
		$("input[data-field='AGREEMENT']").prop("checked", true).removeAttr("disabled");

		var $form = $(this).parents("form"),
			$error = $(this).parents("form").find(".error_message"),
			top1 = $("#form-1").position().top,
			data = $form.serialize(),
			class_name = "error";

		$('.js-check-valid-field').removeClass(class_name);
		$.ajax({
			url: '/ajax/form-valid-order-policy.php',
			method: 'GET',
			data: data,
			dataType: 'json',
			success: function (res) {
				$.each(res.value, function (i, value) {
					$('input[name="'+i+'"]').val(value);
				});
				console.log(res);
				if (res.count > 0) {
					$('html').scrollTop(top1);
					$error.show();
					$.each(res.error, function (i, value) {
						$('.js-check-valid-field[data-field="' + i + '"').addClass(class_name);
					});
				} else {
					$error.hide();
					$("#form-2").removeClass("def-close");
					$('html').scrollTop($("#form-2").offset().top-15);
					$('.installment__rules').addClass("installment__rules--active");
				}
			},
			fail: function (e) {
				console.log(e);
			}
		});
	});

	$("input[data-field='AGREEMENT']").change(function(){
		if($(this).prop("checked")){
			$("form input[data-field='AGREEMENT']").removeAttr("disabled");
		}else{
			$("form input[data-field='AGREEMENT']").attr("disabled","disabled");
		}
	});

	$("[name='PAYMENT']").change(function(){
			$(this).parents('section').find("[name='web_form_apply']").removeAttr("disabled");
		});
	$(".to-short-rd").on("click", function () {
		$("#short-rd").removeClass("hidden");
	});


	function closeOpenBlockNext(blockClose, blockOpen, btn) {
		blockClose.classList.add('close');
		blockOpen.classList.remove('def-close');
		btn.classList.remove('close-btn_hide');
	}

	function closeOpenBlockBtn(btn, block) {
		if (btn) {
			btn.addEventListener('click', function () { });
		}
	}
});
