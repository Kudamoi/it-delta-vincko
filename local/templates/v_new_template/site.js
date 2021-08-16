var site={
	init: function(){
		site.chopTabs();
		site.packetSwitcher();
		site.priceFormat();
		site.sliderMain();
		site.orderNew();
		site.reg();
		site.geoCity();
		site.zayavkaActions();
		site.filters();
		site.chopSelectLink();
		site.callbackNew();
		site.reviewNew();
	},
	
	chopTabs: function(){
		$(".js-tab").on("click", function(e){
			e.preventDefault();
			$(".js-tabblock, .js-tab").removeClass("selected");
			$("#js-block"+$(this).data("id")).addClass("selected");
			$("html,body").animate({
				scrollTop: $("#js-block").offset().top
            }, 300);
			$("#js-tab"+$(this).data("id")).addClass("selected");
		});
		
		$(".js-chopitem-rate-switcher").on("click", function(e){
			e.preventDefault();
			var $this = $(this);
			$(".js-chopitem-rate-switcher").removeClass("selected");
			$this.addClass("selected");
			$(".js-chopitem-rate").hide();
			$("#js-rate-chop-"+$this.data("value")).show();
		});
	},
	
	sliderMain: function(){
		$("#slider-main").length && $("#slider-main").slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			autoplay: false,
			//autoplaySpeed: 4000,
			dots: true,
			dotsClass: "promo-main__dots"
		}).on("beforeChange",function(event, slick, currentSlide, nextSlide){
			if (!($("#js-mainslide"+nextSlide).hasClass("loaded"))){
				$("#js-mainslide"+nextSlide).addClass("loaded");
				$("#js-mainslidepic"+nextSlide).attr("src",$("#js-mainslidepic"+nextSlide).data("src"));
			}
		});
		$("#stories-main").length && $("#stories-main").slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			dots: true,
			infinite: false,
			arrows: false,
			autoplay: false,
			dotsClass: "stories-main__dots",
			speed: 300,
			adaptiveHeight: true,
			responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        dots: true
                    }
                },
                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        dots: true
                    }
                },
                {
                    breakpoint: 680,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        dots: true
                    }
                },
                {
                    breakpoint: 460,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        dots: true
                    }
                }
            ]
		});
	},
	
	priceFormat: function(){
		$(".js-price").length && $(".js-price").each(function(i){
			$(this).text(site.priceFormatting($(this).text()));
		});
	},
	
	filters: function(){
		$("#js-form-submit-onchange").on("change", ".js-packet-filter-reload", function(){
			$("#js-form-submit-onchange").submit();
		});
	},
	
	chopSelectLink: function(){
		$(".js-chop-select-link").change(function(){
			location.href = $(this).val();
		});
	},
	
	packetSwitcher: function(){
		site.packetPrice();
		$(".js-switcher-p").change(function(){
			var switcherID = $(this).attr("id"),
				switcherName = $(this).data("name");
			$("#js-"+switcherID).toggle(this.checked);
			$("#js-"+switcherID+"-no").toggle(!this.checked);
			if (!this.checked){
				$("#js-total-"+switcherName).hide();
				$("#js-"+switcherID+" .js-input-radio").prop("checked", false);
				$(".js-"+switcherID+"-price").hide();
				$("#"+switcherName+"ID").val("");
				site.packetPrice();
				site.priceFormat();
			} else {
				$("#js-total-"+switcherName).show();
				$("#js-"+switcherID+" .js-input-radio:first").prop("checked", true);
				$(".js-"+switcherID+"-price:first").show();
				$("#js-"+switcherName+"-price").text($("#js-"+switcherID+" .js-input-radio:checked").data("price"));
				$("#"+switcherName+"ID").val($("#js-"+switcherID+" .js-input-radio:first").val());
				site.packetPrice();
				site.priceFormat();
			}
		}).change();
		
		$(".js-packet-radio").change(function(){
			var radioID = $(this).data("id"),
				radioName = $(this).data("name"),
				radioPrice = $(this).data("price");
			$(".js-packet-"+radioName+"-price").hide();
			$("#"+radioName+"-price"+radioID).show();
			$("#js-"+radioName+"-price").text(radioPrice);
			$("#"+radioName+"ID").val(radioID);
			site.packetPrice();
			site.priceFormat();
		});
	},
	
	packetPrice: function(){
		var complectPrice = $("#js-complect-price").length && parseInt($("#js-complect-price").text().replace(/\s/g, '')),
			abonplataPrice = $(".js-packet-radio[name='abonplata-service']:checked").length && $("#js-abonplata-price").length && parseInt($(".js-packet-radio[name='abonplata-service']:checked").data("price")),
			strahovkaPrice = $(".js-packet-radio[name='strahovka']:checked").length && parseInt($(".js-packet-radio[name='strahovka']:checked").data("price"));
		$("#js-fullprice").text(complectPrice + abonplataPrice + strahovkaPrice);
	},
	
	priceFormatting: function(price){
		return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
	},
	
	zayavkaActions: function(){
		$(".js-choptozayavka-select").on("click", function(e){
			e.preventDefault();
			var chopID = $(this).data("id");
			$("#js-choptozayavka-hidden").append("<input id='js-chopselected"+chopID+"' class='js-chopselected' type='hidden' name='chop[]' value='"+chopID+"'>");
			$(this).hide();
			$("#js-choptozayavka-uncheck"+chopID).show();
			$("#js-choptozayavka-counter").text($(".js-chopselected").length);
			$("#js-choptozayavka-clear").css("display","block");
		});
		$(".js-choptozayavka-unselect").on("click", function(e){
			e.preventDefault();
			var chopID = $(this).data("id");
			$("#js-choptozayavka-hidden").find("#js-chopselected"+chopID).remove();
			$(this).hide();
			$("#js-choptozayavka-check"+chopID).show();
			$("#js-choptozayavka-counter").text($(".js-chopselected").length);
			if ($(".js-chopselected").length < 1){
				$("#js-choptozayavka-clear").hide();
			}
		});
		$("#js-choptozayavka-clear").on("click", function(e){
			e.preventDefault();
			$("#js-choptozayavka-hidden").empty();
			$(".js-choptozayavka-unselect").hide();
			$(".js-choptozayavka-select").show();
			$("#js-choptozayavka-counter").text($(".js-chopselected").length);
			$(this).hide();
		});
		$(".js-izayavka-remove").on("click", function(e){
			e.preventDefault();
			$("#js-izayavka-chop"+$(this).data("id")).remove();
		});
		$(".js-localstor").on("change keyup", function(e){
			var $this = $(this);
			localStorage.setItem($this.attr("name"),$this.val());
		});
		$(".js-localstor").each(function(){
			var $this = $(this),
				localStor = localStorage.getItem($this.attr("name"),$this.val());
			$this.val(localStor);
		});
		$("#iz-submit").length && $("#iz-submit").on("click", function(e){
			e.preventDefault();
			var $form = $("#iz-form"),
				$sendButton = $(this);
			$("#js-hidden-loader").show();
			$sendButton.text("Идет отправка...");
			$.ajax({
				url: $form.attr("action"),
				type: $form.attr("method"),
				data: $form.serialize(),
				dataType: "json",
				success: function(d){
					$("#js-hidden-loader").hide();
					$("#js-izayavka-wrap").hide().html("");
					$("#js-izayavka-ok").show();
					$(".js-localstor").on("change keyup", function(e){
						var $this = $(this);
						localStorage.removeItem($this.attr("name"));
					});
				},
				error: function(e){
					alert("Произошла ошибка при отправлении заявки. Попробуйте еще раз позже.");
					$("#js-hidden-loader").hide();
					$sendButton.text("Отправить");
				}
			});
		});
	},
	
	geoCity: function(){
		$(".js-get-city").on("click", function(e){
			e.preventDefault();
			$.ajax({
				url: "/ajax/citymodal.php",
				type: "POST",
				data: {
					city: $(this).data("id")
				},
				dataType: "json",
				success: function(d){
					location.reload();
				},
				error: function(e){
					location.reload();
				}
			});
		});
	},

	orderNew: function(){
		$("#js-neworder").length && $("#js-neworder").on("click", function(e){
			e.preventDefault();
			var $form = $("#js-packet-form");
			$.ajax({
				url: $form.attr("action"),
				type: $form.attr("method"),
				data: $form.serialize(),
				dataType: "json",
				success: function(d){},
				error: function(e){}
			});
			location.replace("/order/");
		});
	},

	callbackNew: function(){
		$("#js-callback-form").length && $("#js-callback-form").on("submit", function(e){
			e.preventDefault();
			var $form = $("#js-callback-form");
			$("#js-callback-error").hide().text("");
			$.ajax({
				url: $form.attr("action"),
				type: $form.attr("method"),
				data: $form.serialize(),
				dataType: "json",
				success: function(d){
					if (d["success"] === true){
						$("#js-callback-form-wrap").hide();
						$("#js-callback-ok").show();
					} else {
						$("#js-callback-error").show().text(d["msg"]);
					}
				},
				error: function(e){
					$("#js-callback-error").show().text("Ошибка при отправке заявки");
				}
			});
		});
	},

	reviewNew: function(){
		$("#js-r-form").length && $("#js-r-form").on("submit", function(e){
			e.preventDefault();
			var $form = $("#js-r-form");
			$("#js-r-err").hide().text("");
			$.ajax({
				url: $form.attr("action"),
				type: $form.attr("method"),
				data: $form.serialize(),
				dataType: "json",
				success: function(d){
					if (d["success"] === true){
						$form.hide();
						$("#js-r-ok").text(d["msg"]);
					} else {
						$("#js-r-err").show().text(d["msg"]);
					}
				},
				error: function(e){
					$("#js-r-err").show().text("Ошибка при добавлении отзыва");
				}
			});
		});
	},
	
	reg: function(){
		var $mail = $("#reg-login");
		$("#reg-phonenumber").on("change keyup", function(){
			$mail.val(this.value);
		});
	}
}
$(document).ready(site.init);