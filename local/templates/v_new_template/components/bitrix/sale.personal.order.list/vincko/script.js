$(document).ready(function () {
	$("[name='profile__c-tabs']").change(function () {
		$(".profile__c-main").removeClass("show");
		if ($(this).attr("id") == "c-all-orders") {
			$(".profile__c-main--all-orders").addClass("show");
		} else {
			$(".profile__c-main--personal-requests").addClass("show");
		}
	});

	$(".js-paid").click(function () {
		var $parent = $(this).parent(),
			url = $parent.attr("data-url"),
			paySystemId = $(this).attr("data-pay"),
			accountNumber = $parent.attr("data-accountNumber"),
			paymentNumber = $parent.attr("data-paymentNumber");
		$parent
			.parents(".profile__c-main-order-bottom")
			.find(".profile__c-main-order-bottom-wrapper")
			.append("<div class='profile__c-main-order-bottom-answ js-answer'>"
				+ "Идет переадресация на страницу оплаты"
				+ "</div>"
			);
		$.ajax({
			url: url,
			method: 'POST',
			data:
				{
					sessid: BX.bitrix_sessid(),
					paySystemId: paySystemId,
					accountNumber: accountNumber,
					paymentNumber: paymentNumber
				},
			dataType: 'html',
			success: function (res) {
				$parent.append(res);
				console.log(res);
			},
			error: function (error) {
				console.log(error);
			}
		});
		return false;
	});

});