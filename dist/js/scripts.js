function validateEmail(){
    let email = document.getElementById('email');
    let emailError = document.getElementById('emailError');
    let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if(emailRegex.test(email.value)){
        email.style.border = "2px solid green";
        document.getElementById('loginSubmit').disabled = false;
        emailError.classList.add('d-none');
    }else{
        document.getElementById('email').style.border = "2px solid red";
        document.getElementById('loginSubmit').disabled = true;
        emailError.classList.remove('d-none');
    }
}