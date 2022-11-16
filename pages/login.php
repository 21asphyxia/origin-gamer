<?php
include '../scripts.php';
if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
}
$pageTitle = 'Login';
include_once '../includes/header.php';
?>

<body id="loginPage" class="h-100 d-flex justify-content-center align-items-center">

<!-- ==================================================== -->
    <div id="loginBox" class=" p-2 w-75 shadow-5-strong  ">
        <h2 class="mt-3 text-center" id="pageTitle">Login</h2>
        <div id="logo" class="w-75 mx-auto d-flex justify-content-center mb-5">
            <img class="" src="../dist/img/logo.png" alt="Origin Gamer Logo">
        </div>
        <form action="../scripts.php" method="post">
            <div class="mb-3">
                <input class="w-75 p-1 d-block mx-auto rounded px-3 " type="text" name="email" id="email" placeholder= "&#xf0e0;   E-mail" style="font-family:poppins, FontAwesome" onkeyup="validateEmail()"/>
                <!-- email error -->
                <?php if (isset($_SESSION['emailError'])){
                    echo "<div class='w-75 mx-auto text-danger' role='alert'>".$_SESSION['emailError']."</div>"; 
                    unset($_SESSION['emailError']);
                } ?>
                <div id="emailError" class="w-75 mx-auto text-danger d-none">Please enter a valid E-mail</div>
            </div>
            <div class="mb-3">
                <input class="w-75 p-1 mb-3 d-block mx-auto rounded px-3" type="password" name="password" id="password" placeholder= "&#xf084;   Password" style="font-family:poppins, FontAwesome"/>
                <!-- password error -->
                <?php if (isset($_SESSION['passwordError'])){
                    echo "<div class='w-75 mx-auto text-danger' role='alert'>".$_SESSION['passwordError']."</div>"; 
                    unset($_SESSION['passwordError']);
                } ?>
            </div>
                <div class="w-75 mx-auto d-flex justify-content-between flex-wrap mb-5">
                <div>
                    <input class="mb-3" type="checkbox" name="remember" id="remember" />
                    <label class="d-inline loginOptions" for="remember">Remember me</label>
                </div>
                <div class="">
                    <a href="forgot_password.php" class="text-white loginOptions">Forgot your password?</a>
                </div>
            </div>
            

            <button class="d-flex justify-content-center mx-auto mb-3" type="submit" name="login" id="loginSubmit" onclick="validateEmail()">Login</button>
        </form>
    </div>
</body>
<!-- ================== BEGIN core-js ================== -->
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
	<script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/scripts.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- ================== END core-js ================== -->
	