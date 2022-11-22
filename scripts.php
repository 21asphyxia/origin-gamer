<?php
//INCLUDE DATABASE FILE
require('includes/database.php');
//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if(isset($_POST['login']))        login();
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

function saveProduct(){
    //form validation
    $errors = array();
    //Check if all fields are filled
    if(empty($_POST['productName']))        $errors['productName'] = "Product Name is required";
    if(empty($_POST['brand']))              $errors['brand'] = "Brand is required";
    if(empty($_POST['category']))           $errors['category'] = "Category is required";
    if(empty($_POST['stock']))              $errors['stock'] = "Stock is required";
    if(empty($_POST['price']))              $errors['price'] = "Price is required";
    if(empty($_POST['image']))              $errors['image'] = "Image is required";
    if(empty($_POST['description']))        $errors['description'] = "Description is required";
    
    //Check if there are errors
    if (count($errors) == 0)
    {
        //SQL insert query if there are no errors
        $sql = "INSERT INTO products (name, brand, category, stock, price, image, description) VALUES ('$_POST[productName]', '$_POST[brand]', '$_POST[category]', '$_POST[stock]', '$_POST[price]', '$_POST[image]', '$_POST[description]')";
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
        //If there are errors, redirect to index.php with errors
        //Empty fields alerts
        $_SESSION['nameErr'] = $errors['productName'];
        $_SESSION['brandErr'] = $errors['brand'];
        $_SESSION['categoryErr'] = $errors['category'];
        $_SESSION['stockErr'] = $errors['stock'];
        $_SESSION['priceErr'] = $errors['price'];
        $_SESSION['imageErr'] = $errors['image'];
        $_SESSION['descriptionErr'] = $errors['brand'];
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
    $image = $_POST['image'];
    $description = $_POST['description'];
    $sql = "UPDATE products SET name = '$productName',  brand = '$brand', category = '$category', stock = '$stock', price='$price',image = '$image',description = '$description' WHERE id = '$id'";
    mysqli_query($GLOBALS['conn'],$sql);

    $_SESSION['message'] = "Product has been updated successfully !";
    $_SESSION['msg_type'] = "success";
    header('location: pages/products.php');
}

function deleteProduct(){
    //SQL delete query
    $id = $_GET['productId'];
    $sql = "DELETE FROM products WHERE id='$id'";
    mysqli_query($GLOBALS['conn'],$sql);
    
    $_SESSION['message'] = "Product has been deleted successfully !";
    $_SESSION['msg_type'] = "success";
    header('location: pages/products.php');
}

function deleteProductbyButton(){
    //SQL delete query
    $id = $_GET['deleteProduct'];
    $sql = "DELETE FROM products WHERE id='$id'";
    mysqli_query($GLOBALS['conn'],$sql);

    $_SESSION['message'] = "Product has been deleted successfully !";
    $_SESSION['msg_type'] = "success";
    header('location: pages/products.php');
}
?>