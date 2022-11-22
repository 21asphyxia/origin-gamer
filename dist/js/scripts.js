let form = document.getElementById("form");
let productName = document.getElementById("productName");
let brand = document.getElementById("brandName");
let category = document.getElementById("category");
let stock = document.getElementById("stock");
let price = document.getElementById("price");
let image = document.getElementById("image");
let description = document.getElementById("description");

// Enable save and update button when all inputs are filled
let enableADD = () => {
    if (productName.value != "" && brand.value != "" && category.value != "" && stock.value != "" && price.value != "" && description.value != "") {
        document.getElementById("save-button").disabled = false;
        document.getElementById("update-button").disabled=false;
    } else {
        document.getElementById("save-button").disabled=true;
        document.getElementById("update-button").disabled=true;
    }
}

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

function createProduct() {
    console.log("1");
    // initialiser task form
    initTaskForm();
    // Afficher le boutton save
    document.getElementById("save-button").classList.remove("d-none");
    document.getElementById("cancel-button").classList.remove("d-none");
    // Ouvrir modal form
    $(document).ready(function() {
      $('#form').modal('show');
  });
  }

function initTaskForm() {
    // Clear task form from data
    form.reset();
    document.getElementById("productName").value = "";
    document.getElementById("brandName").value = "";
    document.getElementById("category").value = "";
    document.getElementById("stock").value = "";
    document.getElementById("price").value = "";
    document.getElementById("image").value = "";
    document.getElementById("description").value = "";
    
    // Hide all action buttons
  
    document.getElementById("save-button").classList.add("d-none");
    document.getElementById("cancel-button").classList.add("d-none");
    document.getElementById("delete-button").classList.add("d-none");
    document.getElementById("update-button").classList.add("d-none");
  
    enableADD();
  }

  $(document).on('click', '#delete-button', function(e) {
    swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
          $('#hiddenDelete').click();
        // });
        
      }
    });
  });