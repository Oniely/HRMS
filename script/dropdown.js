$(".dropdown-btn").on("click", (e) => {
    const dropdownBtn = $(e.currentTarget);

    $("#side-bar").addClass("open");
    $("#navbar").addClass("open");

    const target = dropdownBtn.siblings(".dropdown-menu");
    $(".dropdown-menu").not(target).removeClass("open");
    target.toggleClass("open");

    dropdownBtn.find(".arrow").toggleClass("open");

    $(".arrow").not(dropdownBtn.find(".arrow")).removeClass("open");

    if ($("#logo-img").attr("src") === "images/sc-logo.svg") {
        $("#logo-img").attr("src", "images/sc.svg");
        $("#logo-img").css("padding", "3rem");
    }
});

$(document).on("click", (e) => {
    const profileBtn = $(".profile-btn");
    const profileMenu = $(".profile-menu");

    if (
        !profileBtn.is(e.target) &&
        !profileBtn.has(e.target).length &&
        !profileMenu.is(e.target) &&
        !profileMenu.has(e.target).length
    ) {
        profileMenu.removeClass("open");
    } else {
        profileMenu.toggleClass("open");
    }
});

$(".profile-btn").on("click", (e) => {
    e.stopPropagation();
    $(".profile-menu").toggleClass("open");
});
