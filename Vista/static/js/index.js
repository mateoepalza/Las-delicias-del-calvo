$(function () {
	$("#signIn").click(function () {
		$(".hidden").fadeIn();
		$(".hidden").css({
			display: "flex",
		});
	});
	$(".hidden").click(function () {
		$(".hidden").fadeOut();
	});
});
