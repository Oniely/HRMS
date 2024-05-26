$(document).ready(() => {
    $('.password_visibility').on('click', (e) => {
        const target = $(e.target).attr('data-visibility');

        if (target === 'invisible') {
            $('.password_visibility[data-visibility="invisible"]').hide();
            $('.password_visibility[data-visibility="visible"]').show();
            $('#password').prop('type', 'text');
            $('#confirmPass').prop('type', 'text');
        } else {
            $('.password_visibility[data-visibility="invisible"]').show();
            $('.password_visibility[data-visibility="visible"]').hide();
            $('#password').prop('type', 'password');
            $('#confirmPass').prop('type', 'password');
        }
        $(e.target).siblings('input').focus();
    });
})

function containsOnlyNumbers(inputString) {
    return /^[0-9]+$/.test(inputString);
}

$('#signUpForm').on('submit', (e) => {
    let isValid = true;

    let fnameValue = $('#fname').val().trim();
    if (fnameValue.length < 2) {
        $('#fname').siblings('span').text("Name must be at least 2 characters in length").show();
        isValid = false;
    } else {
        $('#fname').siblings('span').hide();
    }

    let lnameValue = $('#lname').val().trim();
    if (lnameValue.length < 2) {
        $('#lname').siblings('span').text("Name must be at least 2 characters in length").show();
        isValid = false;
    } else {
        $('#lname').siblings('span').hide();
    }

    let contactValue = $('#contact').val().trim();
    if (!containsOnlyNumbers(contactValue)) {
        $('#contact').siblings('span').text("Contact Number must only contain numbers").show();
        isValid = false;
    } else if (contactValue.length < 11) {
        $('#contact').siblings('span').text("Contact Number must be 11 characters in length").show();
        isValid = false;
    } else {
        $('#contact').siblings('span').hide();
    }

    let usernameValue = $('#username').val().trim();
    if (usernameValue === "") {
        $('#username').siblings('span').text("Username must not be empty.").show();
        isValid = false;
    } else {
        $('#username').siblings('span').hide();
    }

    let passwordValue = $('#password').val().trim();
    let confirmPass = $('#confirmPass').val().trim();

    if (passwordValue.length < 8) {
        $('#password').siblings('span').text('Password must be at least 8 characters in length').show();
        isValid = false;
    } else if (passwordValue !== confirmPass) {
        $('#password').siblings('span').text('Passwords do not match.').show();
        $('#confirmPass').siblings('span').text('Passwords do not match.').show();
        isValid = false;
    } else {
        $('#password').siblings('span').hide();
        $('#confirmPass').siblings('span').hide();
    }

    if (isValid) {
        document.getElementById('signUpForm').submit();
    } else {
        e.preventDefault();
    }
});
