<?php
//INCLUDE DATABASE FILE
require('includes/database.php');
//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if(isset($_POST['login']))        login();
if(isset($_POST['register']))        register();
if(isset($_POST['save']))         saveProduct();
if(isset($_POST['update']))      updateProduct();
if(isset($_POST['delete']))      deleteProduct();
if(isset($_GET['deleteProduct']))      deleteProductbyButton();



function login() {
    // Get the email and password
    $email = $_POST['email'];
    $password = $_POST['password'];
    // sanitize email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emailError']="Invalid email format";
    } else {
        // Check if the email exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if (mysqli_num_rows($result) == 1) {
            // Check if the password is correct
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['user_password'])) {
                // Set session variables
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
            } else {
                $_SESSION['passwordError']="Incorrect password";
            }
        } else {
            $_SESSION['emailError']="Email does not exist";
        }
        
    }
    // Redirect to the dashboard
    header('Location: index.php');
}

function register() {
    // Get the email and password
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['fullName'];
    // sanitize email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emailError']="Invalid email format";
        header('Location: register.php');
    } else {
        // Check if the email exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['emailError']="Email already exists";
            header('Location: register.php');
        } else {
            // password validation
            if (strlen($password) < 8) {
                $_SESSION['passwordError']="Password must be at least 8 characters";
                header('Location: register.php');
            } else {
            // Hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Insert the user into the database
            $sql = "INSERT INTO users (email, user_password, name) VALUES ('$email', '$password', '$name')";
            if (!mysqli_query($GLOBALS['conn'], $sql)) {
                $_SESSION['emailError']="Error creating user";
                header('Location: register.php');
            }
        }
    }
    // Redirect to the dashboard
    header('Location: index.php');}
}

function getProducts(){
    //SQL SELECT QUERY
    $sql = "SELECT * FROM products ORDER BY id";
    //PERFORM THE QUERY AND GET RESULT
    $result = mysqli_query($GLOBALS['conn'],$sql);
    return $result;
}

function getInputs(){
    //SQL SELECT QUERY
    $sql = "SELECT * FROM products where id = {$_GET['editProduct']}";
    //PERFORM THE QUERY AND GET RESULT
    $inputs = mysqli_query($GLOBALS['conn'],$sql);
    return $inputs;
}

function uploadImage(){
    $uploadFolder = "uploads/";
    $fileName = basename($_FILES["productImage"]["name"]);
    $uploadFile = $uploadFolder. $fileName;
    $imageFileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));
    // Check if it's an image or fake
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if($check == false)
    {
        $_SESSION['imageError'] = "File is not an image.";
        return false;
    }
    // Check file size
    if ($_FILES["productImage"]["size"] > 20000000) {
        $_SESSION['imageError'] = "Sorry, your file is too large.";
        return false;
    }
    // Allow JPG, JPEG, PNG, GIF
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $_SESSION['imageError'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        return false;
    }

    // Upload the file if everything is ok
    $uploadedFile = $uploadFolder.uniqid().$fileName;
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $uploadedFile)){ 
        return $uploadedFile;
    } else {
        $_SESSION['imageError'] = "Sorry, there was an error uploading your file.";
    }
}

function saveProduct(){
    //form validation
    $errors = array();
    //Check if all fields are filled
    if(empty($_POST['productName']))        $errors['productName'] = "Product Name is required";
    if(empty($_POST['brand']))              $errors['brand'] = "Brand is required";
    if(empty($_POST['category']))           $errors['category'] = "Category is required";
    if(empty($_POST['stock']))              $errors['stock'] = "Stock is required";
    if(empty($_POST['price']))              $errors['price'] = "Price is required";
    if(empty($_POST['description']))        $errors['description'] = "Description is required";
    
    //Get the image path
    if(!empty($_FILES['productImage']['name'])){
        $imagePath = uploadImage();
    } else{
        $imagePath = "1";
    }

    //Check if there are errors
    if (count($errors) == 0 && $imagePath != false) {
        //SQL insert query if there are no errors and image is uploaded
        if($imagePath != "1"){
            $sql = "INSERT INTO products (name, brand, category, stock, price, image, description) VALUES ('$_POST[productName]', '$_POST[brand]', '$_POST[category]', '$_POST[stock]', '$_POST[price]', '$imagePath', '$_POST[description]')";
        } else{
            $sql = "INSERT INTO products (name, brand, category, stock, price, description) VALUES ('$_POST[productName]', '$_POST[brand]', '$_POST[category]', '$_POST[stock]', '$_POST[price]', '$_POST[description]')";
        }
        
        if(mysqli_query($GLOBALS['conn'],$sql))
        {
            $_SESSION['message'] = "Product has been added successfully !";
            $_SESSION['msg_type'] = "success";
            header('location: pages/products.php');
        }
        else
        {
            $_SESSION['message'] = "Product has not been added !";
            $_SESSION['msg_type'] = "danger";
            header('location: pages/products.php');
        }
    }
    else
    {
        //If there are errors, redirect to products.php with errors
        //Empty fields alerts
        $_SESSION['nameErr'] = $errors['productName'];
        $_SESSION['brandErr'] = $errors['brand'];
        $_SESSION['categoryErr'] = $errors['category'];
        $_SESSION['stockErr'] = $errors['stock'];
        $_SESSION['priceErr'] = $errors['price'];
        $_SESSION['descriptionErr'] = $errors['description'];
        //launch js script to show already filled fields in modal
        $_SESSION['error'] = "<script type = text/javascript>
        createProduct(); 
        document.getElementById('productName').value ='".$_POST['productName']."' ;
        document.getElementById('brandName').value = '".$_POST['brand']."';
        document.getElementById('category').value = '".$_POST['category']."';
        document.getElementById('stock').value = '".$_POST['stock']."';
        document.getElementById('price').value = '".$_POST['price']."';
        document.getElementById('description').value = '".$_POST['description']."';
        </script>";
        header('location: pages/products.php');
    }
}

function updateProduct(){
    //SQL update query
    $id = $_POST['productId'];
    $productName = $_POST['productName'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    //form validation
    $errors = array();
    //Check if all fields are filled
    if(empty($_POST['productName']))        $errors['productName'] = "Product Name is required";
    if(empty($_POST['brand']))              $errors['brand'] = "Brand is required";
    if(empty($_POST['category']))           $errors['category'] = "Category is required";
    if(empty($_POST['stock']))              $errors['stock'] = "Stock is required";
    if(empty($_POST['price']))              $errors['price'] = "Price is required";
    if(empty($_POST['description']))        $errors['description'] = "Description is required";
    
    //Get the image path
    if(!empty($_FILES['productImage']['name'])){
        $imagePath = uploadImage();
        
    } else{
        $imagePath = "1";
    }

    //Check if there are errors
    if (count($errors) == 0 && $imagePath != false) {
        // Delete existing image from the uploads folder
        $sql = "SELECT image FROM products WHERE id = '$id'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['image'] != '' && $row['image'] != $imagePath) {
            unlink($row['image']);
        }
        //SQL insert query if there are no errors and image is uploaded
        if($imagePath != "1"){
            $sql = "UPDATE products SET name = '$productName',  brand = '$brand', category = '$category', stock = '$stock', price='$price',image = '$imagePath',description = '$description' WHERE id = '$id'";
        }else{
            $sql = "UPDATE products SET name = '$productName',  brand = '$brand', category = '$category', stock = '$stock', price='$price',description = '$description' WHERE id = '$id'";
        }

        if(mysqli_query($GLOBALS['conn'],$sql))
        {
            $_SESSION['message'] = "Product has been updated successfully !";
            $_SESSION['msg_type'] = "success";
            header('location: pages/products.php');
        }
        else
        {
            $_SESSION['message'] = "Product has not been updated !";
            $_SESSION['msg_type'] = "danger";
            header('location: pages/products.php');
        }
    }else{
        //If there are errors, redirect to products.php with errors
        //Empty fields alerts
        $_SESSION['nameErr'] = $errors['productName'];
        $_SESSION['brandErr'] = $errors['brand'];
        $_SESSION['categoryErr'] = $errors['category'];
        $_SESSION['stockErr'] = $errors['stock'];
        $_SESSION['priceErr'] = $errors['price'];
        $_SESSION['descriptionErr'] = $errors['description'];
        //launch js script to show already filled fields in modal
        $_SESSION['error'] = "<script type = text/javascript>
        createProduct(); 
        document.getElementById('productName').value ='".$_POST['productName']."' ;
        document.getElementById('brandName').value = '".$_POST['brand']."';
        document.getElementById('category').value = '".$_POST['category']."';
        document.getElementById('stock').value = '".$_POST['stock']."';
        document.getElementById('price').value = '".$_POST['price']."';
        document.getElementById('description').value = '".$_POST['description']."';
        document.getElementById('save-button').classList.add('d-none');
		document.getElementById('cancel-button').classList.add('d-none');
        document.getElementById('update-button').classList.remove('d-none');
        document.getElementById('delete-button').classList.remove('d-none');
        </script>";
        header('location: pages/products.php?editProduct='.$id);
    }
}

function deleteProduct(){
    // Delete existing image from the uploads folder
    $id = $_GET['productId'];
    $sql = "SELECT image FROM products WHERE id = '$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['image'] != '' ) {
        unlink($row['image']);
    }

    //SQL delete query
    $sql = "DELETE FROM products WHERE id='$id'";
    mysqli_query($GLOBALS['conn'],$sql);
    
    $_SESSION['message'] = "Product has been deleted successfully !";
    $_SESSION['msg_type'] = "success";
    header('location: pages/products.php');
}

function deleteProductbyButton(){
    // Delete existing image from the uploads folder
    $id = $_GET['deleteProduct'];
    $sql = "SELECT image FROM products WHERE id = '$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['image'] != '' ) {
        unlink($row['image']);
    }
    //SQL delete query
    $sql = "DELETE FROM products WHERE id='$id'";
    mysqli_query($GLOBALS['conn'],$sql);

    $_SESSION['message'] = "Product has been deleted successfully !";
    $_SESSION['msg_type'] = "success";
    header('location: pages/products.php');
}
?>