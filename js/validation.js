function validateForm() {
    let registrationErrorMsg = document.getElementById('registration-error');
    registrationErrorMsg.style.display = 'none';
    let email = document.forms["registration-form"]["email"].value;
    let password = document.forms["registration-form"]["password"].value;
    let password_repeat = document.forms["registration-form"]["password-repeat"].value;
    console.log(password.length)
    if (password.length <= 5) {
        registrationErrorMsg.style.display = 'inline-block';
        registrationErrorMsg.innerHTML = "Passwords will need to be at least 6 characters";
        return false;
    }

    if (password !== password_repeat) {
        registrationErrorMsg.style.display = 'inline-block';
        registrationErrorMsg.innerHTML = "Password and confirm password does not match";
        return false;
    }
}