const adminModalContainer = $('#admin_modal_container');
const modalBtn = $('#modal_btn');

const editModal = $("#edit_privilage_modal");
const editPrivilageBtn = $('.edit_privilage_btn')

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

$('.close_btn').on('click', function () {
    adminModalContainer.addClass('hidden');
    adminModalContainer.removeClass('flex');

    editModal.addClass('hidden');
    editModal.removeClass('flex');
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