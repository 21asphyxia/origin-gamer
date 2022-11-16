<?php
//INCLUDE DATABASE FILE
require('includes/database.php');
//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if(isset($_POST['login']))        login();
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
                    setcookie('id', $row['id'], time() + 60 * 60 * 24 * 7);
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
?>