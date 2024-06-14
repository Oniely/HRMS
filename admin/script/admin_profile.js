const showPasswordBtn = $("#showPasswordBtn");
const showPasswordModal = $("#show_password_modal");
const adminProfileModal = $("#edit_admin_profile");

showPasswordBtn.on("click", (e) => {
	showPasswordModal.removeClass("hidden");
	showPasswordModal.addClass("flex");

	let admin_id = $(e.currentTarget).attr("data-admin-id");

	$("#showPassword").attr("data-admin-id", admin_id);
	$("#showPasswordForm").attr("data-admin-id", admin_id);
	$("#admin_password").focus();
	$("#showPassword").show();
});

$('.close_btn').on('click', () => {
    showPasswordModal.addClass("hidden");
    showPasswordModal.removeClass("flex");

	adminProfileModal.addClass('hidden');
	adminProfileModal.removeClass('flex');
});

document.body.addEventListener("keydown", (e) => {
	if (e.key === "Escape") {
		$(".close_btn").click();
	}
});

$("#showPasswordForm").on("submit", (e) => {
	e.preventDefault();

	const admin_id = $("#showPasswordForm").attr("data-admin-id");
	const password = $("#admin_password").val();

	$.ajax({
		url: "/HRMS/admin/functions/admin/show_password.php",
		method: "GET",
		data: {
			admin_id,
			password,
		},
		success: (res) => {
			if (res === "FAILED") {
				$("#admin_password").val("");
				$(".close_btn").click();
				alert("Password Incorrect.");
				return;
			}
			let data = JSON.parse(res);
            $('#show_password_modal').hide();

			$("#showPassword").hide();
			$("#passwordContainer").show();

			$("#inputContainer").hide();

            $('#edit_admin_profile').removeClass('hidden');
            $('#edit_admin_profile').addClass('flex');
			
			$("#admin_username").val(data[0]);
			$("#e-admin_password").val(data[1]);
			$("#admin_fname").val(data[2]);
			$("#admin_lname").val(data[3]);
			$("#admin_number").val(data[4]);
		},
	});
});

const adminProfileForm = $("#adminProfileForm");

adminProfileForm.on("submit", (e) => {
	e.preventDefault();

	let formData = new FormData(adminProfileForm[0]);

	$.ajax({
		url: "/HRMS/admin/functions/admin/update_admin_profile.php",
		method: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: (res) => {
			console.log(res);

			if (res === "NO_SESSION") return alert("Session Expired.");
			if (res === "INVALID_REQUEST") return alert("Denied Request.");
			if (res === "UPDATE_FAILED") return alert("Something went wrong. Update has failed!");
			if (res === "SUCCESS") {
				location.reload();
				return;
			}
		},
	});
});