$(document).ready(function () {
	// Show the modal
	$(".history-btn").click(function () {
		$(".history-modal").addClass("open");
	});

	// Hide the modal on close button click
	$(".close-btn").click(function () {
		$(".history-modal").removeClass("open");
	});

	// Close modal when clicking outside the form
	$(document).mouseup(function (e) {
		var container = $(".history-form");

		// If the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$(".history-modal").removeClass("open");
		}
	});

	// Prevent modal from closing when clicking inside the form
	$(".history-form").click(function (e) {
		e.stopPropagation();
	});
});


