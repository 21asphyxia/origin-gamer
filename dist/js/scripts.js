function validateEmail(){
    let email = document.getElementById('email');
    let emailError = document.getElementById('emailError');
    let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if(emailRegex.test(email.value)){
        email.style.border = "2px solid green";
        document.getElementById('loginRegisterSubmit').disabled = false;
        emailError.classList.add('d-none');
    }else{
        email.style.border = "2px solid red";
        document.getElementById('loginRegisterSubmit').disabled = true;
        emailError.classList.remove('d-none');
    }
}

function validateName(){
    let name = document.getElementById('fullName');    
    let nameError = document.getElementById('nameError');
    if(name.value.length > 0){
        name.style.border = "2px solid green";
        document.getElementById('loginRegisterSubmit').disabled = false;
        nameError.classList.add('d-none');
    }else{
        name.style.border = "2px solid red";
        document.getElementById('loginRegisterSubmit').disabled = true;
        nameError.classList.remove('d-none');
    }
}

function validatePassword(){
    let password = document.getElementById('password');
    let passwordError = document.getElementById('passwordError');
    let passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    if(passwordRegex.test(password.value)){
        password.style.border = "2px solid green";
        document.getElementById('loginRegisterSubmit').disabled = false;
        passwordError.classList.add('d-none');
    }else{
        password.style.border = "2px solid red";
        document.getElementById('loginRegisterSubmit').disabled = true;
        passwordError.classList.remove('d-none');
    }
}

function validateConfirmPassword(){
    let confirmPassword = document.getElementById('confirmPassword');
    let confirmPasswordError = document.getElementById('confirmPasswordError');
    if(confirmPassword.value == document.getElementById('password').value && confirmPassword.value.length > 0){
        confirmPassword.style.border = "2px solid green";
        document.getElementById('loginRegisterSubmit').disabled = false;
        confirmPasswordError.classList.add('d-none');
    }else{
        confirmPassword.style.border = "2px solid red";
        document.getElementById('loginRegisterSubmit').disabled = true;
        confirmPasswordError.classList.remove('d-none');
    }
}

function validateRegister(){
    validateName();
    validateEmail();
    validatePassword();
    validateConfirmPassword();
}