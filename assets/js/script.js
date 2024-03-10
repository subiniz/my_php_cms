function validatePassword() {
    // Get the password and change password fields
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm_password');

    // Verify if the password and change password fields have the same value
    if (passwordField.value === confirmPasswordField.value) {
        document.getElementById('password_success_msg').style.display = 'block';
        document.getElementById('password_error_msg').style.display = 'none';
        document.getElementById('register_btn').removeAttribute('disabled');
    } else {
        document.getElementById('password_error_msg').style.display = 'block';
        document.getElementById('password_success_msg').style.display = 'none';
        document.getElementById('register_btn').setAttribute('disabled', 'disabled');
    }
}
