$("#burger").on("click", () => {
	$("#side-bar").toggleClass("open");
	$("#navbar").toggleClass("open");
	if (!$("#side-bar").hasClass("open") && !$("#navbar").hasClass("open")) {
		$(".dropdown-menu").removeClass("open");
		$(".arrow").removeClass("open");
	}

	$("#sc-logo").toggle();
	$("#sc").toggle();
});

$(window).on("resize", () => {
	if ($(window).width() <= 768) {
		$("#side-bar, #navbar").removeClass("open");
		$(".dropdown-menu").removeClass("open");
		if (
			!$("#side-bar").hasClass("open") &&
			!$("#navbar").hasClass("open")
		) {
			$(".dropdown-menu").removeClass("open");
			$(".arrow").removeClass("open");
		}

		$("#sc").hide();
		$("#sc-logo").show();
	}
});
