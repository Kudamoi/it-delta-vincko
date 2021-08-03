$(document).ready(function () {
$('#back_call .form__control[name=phone]').inputmask("+7 (999) 999-99-99");
$("#ajax_form_callback_btn").on('click',function(){
		$.ajax({
                url: '/ajax/callback_reg.php',
                type: "POST",
                dataType: "html",
                data: $("#ajax_form_callback").serialize(),
                success: function(response) {
                if(response=='errEnt') {
                    $('#back_call').append('<div id="js-callback-error" style="text-align: center;   color: red;margin-top: 30px; "class="">Поля не до конца заполнены, заполните их до конца и повторите снова</div>');
                    setTimeout(function() { $("#js-callback-error").hide('fast'); }, 2000);
                } else {
                let html = '<div id="js-callback-ok" class=""><div class="callback__title">Заявка принята!</div><div class="callback__description">В ближайшее время с Вами свяжутся наши менеджеры</div></div>'
                       $('#back_call').html(html);
                }

               	},
               	error: function(response) {
               	                   	let html = '<div id="js-callback-ok" class=""><div class="callback__title">Ошибка!</div><div class="callback__description">Данные не отправлены. Сообщите об этом администратору!</div></div>'
               	$('#back_call').html(html);
               	}
                });
		}
	);
	$('.ready-pack__item').each(function(){
		let currentlyPrice = Number($(this).find('.ready-pack__bottom .ready-pack__bottom-result .currently-price').html().replace(/\s/g, ''));
		$(this).find('.ready-pack__bottom .solutions__bottom_column-price').html(Math.ceil(currentlyPrice/12)+' ₽');
	})
	$('.solutions__bottom_column-select').on('change', function() {
		let currentlyPrice = Number($(this).closest('.ready-pack__bottom').find('.currently-price').html().replace(/\s/g, ''));
		$(this).closest('.ready-pack__bottom').find('.solutions__bottom_column-price').html(Math.ceil(currentlyPrice/$(this).val())+' ₽');
	})
	$('.solutions__bottom_right').each(function(){

		let currentlyPrice = Number($(this).find('.solutions__bottom_column-newprice').html().replace(/\s/g, '').replace('₽','').replace('&nbsp;', ''));
		$(this).find('.solutions__bottom_column-price').html(Math.ceil(currentlyPrice/12)+' ₽');

	})

})

