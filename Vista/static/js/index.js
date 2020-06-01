$(function () {
	$("#signIn").click(function () {
		$(".hidden").fadeIn();
		$(".hidden").css({
			display: "flex",
		});
	});
	$(".hidden").mouseup(function(e) {
        if(e.target.className == "hidden"){
            $(".hidden").fadeOut();
        }
	});
});
