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
  let admin_id = $(e.target).attr("data-admin-id");
  $("#editAccountBtn").attr("data-admin-id", admin_id);
  $("#editDepartmentForm").attr("data-admin-id", admin_id);
});

// Event listener for opening the show password modal
showPasswordBtn.on("click", function (e) {
  showPasswordModal.removeClass("hidden").addClass("flex");
  let admin_id = $(e.target).attr("data-admin-id");
  $("#showPassword").attr("data-admin-id", admin_id);
  $("#showPasswordForm").attr("data-admin-id", admin_id);
  $("#admin_password").focus(); // Changed id to 'admin_password'
  $("#showPassword").show();
});

// Event listener for the form submission to show the password
$("#showPasswordForm").on("submit", function (e) {
  e.preventDefault();

  const department_id = $("#showPasswordForm").attr("data-admin-id");
  const password = $("#admin_password").val();

  $.ajax({
    url: "/HRMS/admin/functions/department/show_password.php",
    method: "GET",
    data: {
      department_id,
      password,
    },
    success: (res) => {
      if (res.status === "error") {
        $("#admin_password").val("");
        $(".close_btn").click();
        alert(res.message);
        return;
      }
      $("#showed_username").text(res.username);
      $("#showed_password").text(res.department_password);

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
      }, 11000);
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
});

// Event listener for the Escape key to close the modal
document.body.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    $(".close_btn").click();
  }
});

// Event listener for the edit privilege form submission
$("#editPrivilageForm").on("submit", (e) => {
  e.preventDefault();
  const admin_id = $("#editPrivilageForm").attr("data-admin-id");
  const privilage = $("#edit_privilage").val();

  if (!privilage) {
    alert("Please select an option.");
    return;
  }

  $.ajax({
    url: "/HRMS/admin/functions/admin/edit_admin_privilage.php",
    method: "POST",
    data: {
      admin_id,
      privilage,
    },
    success: function (res) {
      if (res === true) {
        location.reload();
      } else {
        alert("Something went wrong, try again later...");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
    },
  });
});
