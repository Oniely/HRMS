const departmentModalContainer = $("#department_modal_container");
const modalBtn = $("#modal_btn");

const editModal = $("#edit_department_modal");
const editDepartmentBtn = $(".edit_department_btn");

const showPasswordModal = $("#show_password_modal");
const showPasswordBtn = $(".show_password_btn");

// Event listener for opening the department modal
modalBtn.on("click", function () {
	departmentModalContainer.removeClass("hidden").addClass("flex");
});

// Event listener for opening the edit department modal
editDepartmentBtn.on("click", function (e) {
	editModal.removeClass("hidden").addClass("flex");
	let department_id = $(e.target).attr("data-department-id");
	console.log(department_id);
	$("#editAccountBtnDept").attr("data-department-id", department_id);
	$("#editAccountForm").attr("data-department-id", department_id);

	$.ajax({
		url: "/HRMS/admin/functions/department/get_department_account.php",
		method: "GET",
		data: {
			department_id,
		},
		success: function (res) {
			let data = JSON.parse(res);
			$("#dept_username").val(data["username"]);
			$("#dept_password").val(data["password"]);
		},
		error: function (xhr, status, error) {
			console.error("Error:", error);
		},
	});
});

// Event listener for opening the show password modal
showPasswordBtn.on("click", function (e) {
	showPasswordModal.removeClass("hidden").addClass("flex");
	let department_id = $(e.target).attr("data-department-id");
	console.log(department_id);
	$("#showPassword").attr("data-department-id", department_id);
	$("#showPasswordForm").attr("data-department-id", department_id);
	$("#admin_password").focus(); // Changed id to 'admin_password'
	$("#showPassword").show();
});

// Event listener for the form submission to show the password
$("#showPasswordForm").on("submit", function (e) {
	e.preventDefault();

	const department_id = $("#showPasswordForm").attr("data-department-id");
	const password = $("#admin_password").val();

	$.ajax({
		url: "/HRMS/admin/functions/department/show_password.php",
		method: "GET",
		data: {
			department_id,
			password,
		},
		success: (res) => {
			let data = JSON.parse(res);

			console.log(department_id, password);

			if (data["status"] === "error") {
				$("#admin_password").val("");
				$(".close_btn").click();
				alert(data["message"]);
				return;
			}

			$("#showed_username").text(data["username"]);
			$("#showed_password").text(data["password"]);

			$("#showPassword").hide();
			$("#passwordContainer").show();
			$("#inputContainer").hide();

			let count = 10;
			const timer = setInterval(() => {
				$("#timer").text(count--);
			}, 1000);

			setTimeout(() => {
				showPasswordModal.addClass("hidden").removeClass("flex");
				$("#inputContainer").show();
				$("#admin_password").val("");
				$("#passwordContainer").hide();
				$("#timer").text("10");
				clearInterval(timer);
			}, 10500);
		},
		error: (xhr, status, error) => {
			alert("An error occurred while processing your request.");
			console.error("Error:", error);
		},
	});
});

// Event listener for the close button
$(".close_btn").on("click", function () {
	departmentModalContainer.addClass("hidden").removeClass("flex");
	editModal.addClass("hidden").removeClass("flex");
	showPasswordModal.addClass("hidden").removeClass("flex");
	$("#inputContainer").show();
	$("#admin_password").val("");
	$("#passwordContainer").hide();
	$("#timer").text("10");
});

// Event listener for the Escape key to close the modal
document.body.addEventListener("keydown", (e) => {
	if (e.key === "Escape") {
		$(".close_btn").click();
	}
});

// Event listener for the edit privilege form submission
$("#editAccountForm").on("submit", (e) => {
	e.preventDefault();
	const department_id = $("#editAccountForm").attr("data-department-id");
	const username = $("#dept_username").val();
	const password = $("#dept_password").val();

	if (!username || !password) {
		alert("You must fill in all the fields");
		return;
	}

	$.ajax({
		url: "/HRMS/admin/functions/department/edit_department_account.php",
		method: "POST",
		data: {
			department_id,
			username,
			password,
		},
		success: function (res) {
			if (res === "SUCCESS") {
				location.reload();
			} else if (res === "EXIST") {
				alert("Username already exists.")
			} else if (res === "FAILED") {
				alert("Updating Department Account has failed.");
			}
		},
		error: function (xhr, status, error) {
			console.error("Error:", error);
		},
	});
});
