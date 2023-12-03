$("#burger").on("click", () => {
    $("#side-bar").toggleClass("open");
    $("#navbar").toggleClass("open");
    if (!$("#side-bar").hasClass("open") && !$("#navbar").hasClass("open")) {
        $(".dropdown-menu").removeClass("open");
        $(".arrow").removeClass("open");
    }

    if ($("#logo-img").attr("src") === "images/sc.svg") {
        $("#logo-img").attr("src", "images/sc-logo.svg");
        $("#logo-img").css("padding", "5px");
    } else {
        $("#logo-img").attr("src", "images/sc.svg");
        $("#logo-img").css("padding", "3rem");
    }
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
        
        $("#logo-img").attr("src", "images/sc-logo.svg");
        $("#logo-img").css("padding", "5px");
    }
});
