function timer(parent) {
	parent.find(".popup__wait-time").css("display", "block");
	parent.find(".popup__wait").css("display", "block");

	let _Seconds = 20,
		int;
	parent.find('.popup__wait-num').text(_Seconds); // выводим получившееся значение в блок

	int = setInterval(function() { // запускаем интервал
		if (_Seconds > 0) {
			_Seconds--; // вычитаем 1
			parent.find('.popup__wait-num').text(_Seconds); // выводим получившееся значение в блок
		} else {
			parent.find(".popup__wait-repeat").css("display", "block");
			parent.find(".popup__wait-time").css("display", "none");
			clearInterval(int); // очищаем интервал, чтобы он не продолжал работу при _Seconds = 0
		}
	}, 1000);
}
function regShowBtn (){
	let parent = $(".popup--registration");

	console.log(parent.find(".text-field").inputmask("isComplete") );
	console.log(regNumber);
	console.log($("#agree")[0].checked);

	let texts = 1;
	parent.find(".text-field").each(function(index){
		if (!$(this).inputmask("isComplete")){
			texts = 0
		}
	});
	if (texts == 1 && regNumber == 1 && $("#agree")[0].checked){
		parent.find(".btn-registration").removeClass("btn-registration--unactive");
	}
	else{
		parent.find(".btn-registration").addClass("btn-registration--unactive");

	}

}

function showBtn(selector, parent, switcher ) {
	if (selector.inputmask("isComplete")){
		parent.find((".popup__form--"+switcher+" .grey-border-button--unactive")).removeClass("grey-border-button--unactive");
		parent.find((".popup__form--"+switcher+" .grey-border-button")).addClass("grey-border-button--active");

		parent.find((".popup__form-mod--"+switcher+" .send-message-btn")).removeAttr("disabled");

		parent.find((".popup__form-mod--"+switcher+" .send-message-btn")).on("click", function(){

			if(parent.find(".info-popup--unknown").length>0){

			} else{
				sendCodeFunc(parent, switcher);
			}

		})

	}
	else{

		parent.find((".popup__form--"+switcher+" .grey-border-button")).addClass("grey-border-button--unactive");
		parent.find((".popup__form--"+switcher+" .grey-border-button")).removeClass("grey-border-button--active");
	}

}
function sendCodeFunc(parent, switcher){
	parent.find((".popup__form--"+switcher+" .grey-border-button")).css("display", "none");
	parent.find((".popup__form--"+switcher+" .popup__code")).css("display", "block");

	let parent1 = parent.find(".popup__form--"+switcher);

	const input1 = parent1.find("."+switcher+"-input");
	input1.prop('readOnly', true);

	timer(parent1);
}
function viewPopap(){
	let popupers = $(".popup");
	popupers.each(function(index){
		$("input").keyup(function(){
			if(parent.hasClass("popup--registration")){
				regShowBtn();
			}
		});

		let parent = $(this);

		let phone = parent.find(".phone-input");
		let email = parent.find(".mail-input");

		phone.inputmask("+7(999) 999-9999");
		showBtn(phone, parent, "phone");
		phone.keyup(function(){
			showBtn(phone, parent, "phone");

		});


		email.inputmask("email");
		showBtn(email, parent, "mail");
		email.on("keyup", function(){
			showBtn(email, parent, "mail");
		});



		let items = $(".pass-wrapper");
		items.each(function(index){
			let eye = ($(this).children(".pass__eye"));
			let input = $(this).children("input");
			let open=0

			eye.on("click", function(){
				if(open==0){
					input.attr("type", "text");
					open = 1;
				}else{
					input.attr("type", "password");
					open = 0
				}
			});
		});


		parent.find(".popup__wait-repeat").on("click", function(){
			parent.find(".popup__wait-repeat").css("display", "none");
			parent.find(".popup__wait-time").css("display", "block");

			timer(parent);
		})



		let parent1 = parent.find(".popup__form--phone");
		let parent2 = parent.find(".popup__form--mail");

		parent1.find(".popup__code").mask("999999",{
			completed: function(){
				parent1.find(".popup__send-code").css("display", "grid");

			}
		})

		parent1.find(".popup__code").mask("999999",{
			completed: function(){
				parent1.find(".popup__send-code").css("display", "grid");

			}
		})

		parent2.find(".popup__code").mask("999999",{
			completed: function(){
				parent2.find(".popup__send-code").css("display", "grid");

			}
		})
		parent1.find(".popup__send-code").on("click", function(){

			if(parent.hasClass("popup--registration")){
				regNumber = 1;
				regShowBtn();
			}

			parent1.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");

			parent1.find(".popup__wait").css("opacity", "0")
			parent1.find(".popup__wait-time").css("display", "block")
			parent1.find(".popup__success").css("display", "flex");
			parent1.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
			parent1.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
		})

		parent2.find(".popup__send-code").on("click", function(){

			if(parent.hasClass("popup--registration")){
				regNumber = 1;
				regShowBtn();
			}

			parent2.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");

			parent2.find(".popup__wait").css("opacity", "0")
			parent2.find(".popup__wait-time").css("display", "block")
			parent2.find(".popup__success").css("display", "flex");
			parent2.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
			parent2.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
		})

	})

	let close1 = $(".popup__close");
	let close2 = $(".popup__wall");

	let popup = $(".popup");

	close1.on("click", function(){
		popup.addClass("hidden");
	});

	close2.on("click", function(){
		popup.addClass("hidden");
	});
}
function load_modal() {


	$(".js-modal").on("click", (function () {
		var $new_modal = $($(this).attr("data-modal-class"));
		if ($new_modal.length > 0) {
			$(".popup").addClass("hidden");
			$new_modal.removeClass("hidden");
		} else {
			$.ajax({
				url: $(this).attr("data-modal"),
				method: 'POST',
				dataType: 'html',
				success: function (html) {
					$(".popup").addClass("hidden")
					$("footer").before(html);
					viewPopap();
				}
			});
		}
		return false;
	}));


}

$(document).ready(function () {
	load_modal();
});