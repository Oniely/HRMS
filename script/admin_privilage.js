const adminModalContainer = $('#admin_modal_container');
const modalBtn = $('#modal_btn');

const editModal = $("#edit_privilage_modal");
const editPrivilageBtn = $('.edit_privilage_btn')

const showPasswordModal = $('#show_password_modal');
const showPasswordBtn = $('.show_password_btn');

modalBtn.on('click', function () {
    adminModalContainer.removeClass('hidden');
    adminModalContainer.addClass('flex');
});

editPrivilageBtn.on('click', function (e) {
    editModal.removeClass('hidden');
    editModal.addClass('flex');

    let admin_id = $(e.target).attr('data-admin-id');
    $('#editAccountBtn').attr('data-admin-id', admin_id);
    $('#editPrivilageForm').attr('data-admin-id', admin_id);
})

showPasswordBtn.on('click', function (e) {
    showPasswordModal.removeClass('hidden');
    showPasswordModal.addClass('flex');

    let admin_id = $(e.target).attr('data-admin-id');
    $('#showPassword').attr('data-admin-id', admin_id);
    $('#showPasswordForm').attr('data-admin-id', admin_id);
    $('#admin_password').focus();
    $('#showPassword').show();
});

$('#showPasswordForm').on('submit', function (e) {
    e.preventDefault();

    const admin_id = $('#showPasswordForm').attr('data-admin-id');
    const password = $('#admin_password').val();

    $.ajax({
        url: "/hr/functions/admin/show_password.php",
        method: "GET",
        data: {
            admin_id,
            password
        },
        success: (res) => {
            if (res === "FAILED") {
                $('#admin_password').val('');
                $('.close_btn').click();
                alert('Password Incorrect.');
                return;
            }
            let data = JSON.parse(res);
            $('#showed_username').text(data[0])
            $("#showed_password").text(data[1]);

            $('#showPassword').hide();
            $('#passwordContainer').show();

            $('#inputContainer').hide();

            let count = 10;
            const timer = setInterval(() => {
                $('#timer').text(count--)
            }, 1000);

            setTimeout(() => {
                showPasswordModal.addClass('hidden');
                showPasswordModal.removeClass('flex');

                $('#inputContainer').show();
                $('#admin_password').val("");

                $('#passwordContainer').hide();
                $('#timer').text("10");
                clearInterval(timer);
            }, 11000)
        }
    })
})

$('.close_btn').on('click', function () {
    adminModalContainer.addClass('hidden');
    adminModalContainer.removeClass('flex');

    editModal.addClass('hidden');
    editModal.removeClass('flex');

    showPasswordModal.addClass('hidden');
    showPasswordModal.removeClass('flex');
});

document.body.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        $('.close_btn').click();
    }
})

/* 
*
* Edit Admin Privilage Modal
*
*/

$('#editPrivilageForm').on('submit', (e) => {
    e.preventDefault();
    const admin_id = $('#editPrivilageForm').attr('data-admin-id');
    const privilage = $('#edit_privilage').val();

    if (!privilage) {
        alert('Please select an option.')
        return;
    }

    $.ajax({
        url: '/hr/functions/admin/edit_admin_privilage.php',
        method: 'POST',
        data: {
            admin_id,
            privilage
        },
        success: function (res) {
            if (res == true) {
                location.reload();
            } else {
                alert('Something went wrong try again later...')
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
});