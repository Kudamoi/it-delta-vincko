$(document).ready(function () {
	$("[name='profile__c-tabs']").change(function () {
		$(".profile__c-main").removeClass("show");
		if ($(this).attr("id") == "c-all-orders") {
			$(".profile__c-main--all-orders").addClass("show");
		} else {
			$(".profile__c-main--personal-requests").addClass("show");
		}
	});
});