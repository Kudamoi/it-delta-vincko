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
							console.log(html);
							$(".popup").addClass("hidden")
							$("footer").before(html);
						}
					});
				}
			}));
			return false;
	}

	$(document).ready(function () {
		load_modal();
	});