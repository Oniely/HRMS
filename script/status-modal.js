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

$('#photo').on('change', function () {
	const files = $('#photo')[0].files;
	const formData = new FormData();
	if (files.length > 0) {
		formData.append('photo', this.files[0]);
	}

	$.ajax({
		url: "/hr/functions/faculty/upload_photo.php",
		method: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: (res) => {
			if (res === 'SUCCESS') {
				location.reload();
			} else {
				alert('Failed To Upload a Photo');
			}
		}
	});
});