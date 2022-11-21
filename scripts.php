<?php
//INCLUDE DATABASE FILE
require('includes/database.php');
//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if(isset($_POST['login']))        login();
if(isset($_POST['save']))         saveProduct();
if(isset($_POST['update']))      updateTask();
if(isset($_POST['delete']))      deleteTask();



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
                // if remember me is checked
                if (isset($_POST['remember'])) {
                    // set cookie for 1 month
                    setcookie('id', $row['id'], time() + 60 * 60 * 24 * 7,"/");
                    setcookie('email', $row['email'], time() + 60 * 60 * 24 * 7);
                    setcookie('name', $row['name'], time() + 60 * 60 * 24 * 7);
                }
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
            $_SESSION['message'] = "Task has been added successfully !";
            $_SESSION['msg_type'] = "success";
            header('location: index.php');
        }
        else
        {
            $_SESSION['message'] = "Task has not been added !";
            $_SESSION['msg_type'] = "danger";
            header('location: index.php');
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
        createTask(); 
        document.getElementById('productName').value ='".$_POST['productName']."' ;
        document.getElementById('brandName').value = '".$_POST['brand']."';
        document.getElementById('category').value = '".$_POST['category']."';
        document.getElementById('stock').value = '".$_POST['stock']."';
        document.getElementById('price').value = '".$_POST['price']."';
        document.getElementById('description').value = '".$_POST['description']."';
        </script>";
        header('location: index.php');
    }
}






function updateTask()
    {
        //SQL update query
        $id = $_POST['taskId'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $task_datetime = $_POST['date'];
        $sql = "UPDATE tasks SET title = '$title', description = '$description', type_id = '$type', priority_id = '$priority', status_id = '$status', task_datetime = '$task_datetime' WHERE id = '$id'";
        mysqli_query($GLOBALS['conn'],$sql);

        $_SESSION['message'] = "Task has been updated successfully !";
        $_SESSION['msg_type'] = "success";
		header('location: index.php');
    }

    function deleteTask()
    {
        //SQL delete query
        $id = $_POST['taskId'];
        $sql = "DELETE FROM tasks WHERE id='$id'";
        mysqli_query($GLOBALS['conn'],$sql);
        
        $_SESSION['message'] = "Task has been deleted successfully !";
        $_SESSION['msg_type'] = "success";
		header('location: index.php');
    }
?>