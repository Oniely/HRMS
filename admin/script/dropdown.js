$(".dropdown-btn").on("click", (e) => {
	const dropdownBtn = $(e.currentTarget);

	$("#sc-logo").hide();
	$("#sc").show();

	$("#side-bar").addClass("open");
	$("#navbar").addClass("open");

	const target = dropdownBtn.siblings(".dropdown-menu");
	$(".dropdown-menu").not(target).removeClass("open");
	target.toggleClass("open");

	dropdownBtn.find(".arrow").toggleClass("open");

	$(".arrow").not(dropdownBtn.find(".arrow")).removeClass("open");
});

$(document).on("click", (e) => {
	const profileBtn = $(".profile-btn");
	const profileMenu = $(".profile-menu");

	const mProfileBtn = $(".m-profile-btn");
	const mProfileMenu = $(".m-profile-menu");

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

	if (
		!mProfileBtn.is(e.target) &&
		!mProfileBtn.has(e.target).length &&
		!mProfileMenu.is(e.target) &&
		!mProfileMenu.has(e.target).length
	) {
		mProfileMenu.removeClass("open");
	} else {
		mProfileMenu.toggleClass("open");
	}
});

$(".profile-btn").on("click", (e) => {
	e.stopPropagation();
	$(".profile-menu").toggleClass("open");
});

$(".m-profile-btn").on("click", (e) => {
	e.stopPropagation();
	$(".m-profile-menu").toggleClass("open");
});


$(document).on("click", (e) => {
	const notificationBtn = $(".notification-btn");
	const notificationMenu = $(".notification-menu");

	const mNotificationBtn = $(".m-notification-btn");
	const mNotificationMenu = $(".m-notification-menu");

	if (
		!notificationBtn.is(e.target) &&
		!notificationBtn.has(e.target).length &&
		!notificationMenu.is(e.target) &&
		!notificationMenu.has(e.target).length
	) {
		notificationMenu.removeClass("open");
	} else {
		notificationMenu.toggleClass("open");
	}

	if (
		!mNotificationBtn.is(e.target) &&
		!mNotificationBtn.has(e.target).length &&
		!mNotificationMenu.is(e.target) &&
		!mNotificationMenu.has(e.target).length
	) {
		mNotificationMenu.removeClass("open");
	} else {
		mNotificationMenu.toggleClass("open");
	}
});

$(".notification-btn").on("click", (e) => {
	e.stopPropagation();
	$(".notification-menu").toggleClass("open");
});

$(".m-notification-btn").on("click", (e) => {
	e.stopPropagation();
	$(".m-notification-menu").toggleClass("open");
});
