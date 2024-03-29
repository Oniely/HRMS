$(document).ready(function () {
	// Show the modal
	$(".status-btn").click(function () {
		$(".status-modal").addClass("open");
	});

	// Hide the modal on close button click
	$(".close-btn").click(function () {
		$(".status-modal").removeClass("open");
	});

	// Close modal when clicking outside the form
	$(document).mouseup(function (e) {
		var container = $(".status-form");

		// If the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$(".status-modal").removeClass("open");
		}
	});

	// Prevent modal from closing when clicking inside the form
	$(".status-form").click(function (e) {
		e.stopPropagation();
	});
});
