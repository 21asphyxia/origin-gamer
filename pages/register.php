<?php
include '../scripts.php';
if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
}
$pageTitle = 'Register';
include_once '../includes/header.php';
?>

<body id="loginRegisterPage" class="h-100 d-flex justify-content-center align-items-center">

<!-- ==================================================== -->
    <div id="loginRegisterBox" class=" p-2 w-75 shadow-5-strong  ">
        <h2 class="mt-3 text-center" id="pageTitle">Register</h2>
        <div id="logo" class="w-75 mx-auto d-flex justify-content-center mb-5">
            <img class="" src="../dist/img/logo.png" alt="Origin Gamer Logo">
        </div>
        <form action="../scripts.php" method="post">

            <div class="mb-3">
                <input class="w-75 d-block mx-auto rounded px-3 py-2 " type="text" name="fullName" id="fullName" placeholder= "&#xf007;   Full Name" oninput="validateName()">
                <!-- email error -->
                <?php 
                if (isset($_SESSION['emailError'])){
                    echo "<div class='w-75 mx-auto text-danger' role='alert'>".$_SESSION['emailError']."</div>"; 
                    unset($_SESSION['emailError']);} 
                    ?>
                <div id="nameError" class="w-75 mx-auto text-danger d-none">Please enter your name.</div>
            </div>

            <div class="mb-3">
                <input class="w-75 d-block mx-auto rounded px-3 py-2 " type="text" name="email" id="email" placeholder= "&#xf0e0;   E-mail" oninput="validateEmail()">
                <!-- email error -->
                <?php if (isset($_SESSION['emailError'])){
                    echo "<div class='w-75 mx-auto text-danger' role='alert'>".$_SESSION['emailError']."</div>"; 
                    unset($_SESSION['emailError']);
                } ?>
                <div id="emailError" class="w-75 mx-auto text-danger d-none">Please enter a valid E-mail.</div>
            </div>

            <div class="mb-3">
                <input class="w-75 d-block mx-auto rounded px-3 py-2" type="password" name="password" id="password" placeholder= "&#xf084;   Password" oninput="validatePassword()">
                <div id="passwordError" class="w-75 mx-auto text-danger d-none">Please enter a password.</div>
            </div>

            <div class="mb-5">
                <input class="w-75 d-block mx-auto rounded px-3 py-2" type="password" id="confirmPassword" placeholder= "&#xf084;   Confirm your password">
                <div id="confirmPasswordError" class="w-75 mx-auto text-danger d-none">Please confirm your password.</div>
            </div>

            <button class="d-flex justify-content-center mx-auto mb-5" type="submit" name="register" id="loginRegisterSubmit" onclick="validateRegister()">Register</button>
        </form>
        <div class="d-flex-column justify-content-center">
            <p class="text-center mb-2">Already have an account?</p> 
            <a class="d-block mx-auto" href="login.php"><button class="d-flex justify-content-center mx-auto mb-3" type="button">Login</button></a>

    </div>
</body>
<!-- ================== BEGIN core-js ================== -->
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
	<script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/scripts.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- ================== END core-js ================== -->
	