<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Origin Gamer | <?=$pageTitle?> </title>
    <link rel="stylesheet" href="../dist/css/reset/reset.css">
    <link rel="stylesheet" href="../dist/css/reset/normalize.css">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body id="loginPage" class="h-100 d-flex justify-content-center align-items-center">

<!-- ==================================================== -->
    <div id="loginBox" class=" p-2 w-75 shadow-5-strong  ">
        <h2 class="mt-3 text-center" id="pageTitle">Login</h2>
        <div id="logo" class="w-75 mx-auto d-flex justify-content-center mb-5">
            <img class="" src="../dist/logo.png" alt="Origin Gamer Logo">
        </div>
        <form action="login.php" method="post">
            <input class="w-75 p-1 mb-3 d-block mx-auto rounded px-3 " type="text" name="username" id="username" placeholder= "&#xF32F Email" />
            <input class="w-75 p-1 mb-3 d-block mx-auto rounded" type="password" name="password" id="password" />
            <div class="w-75 mx-auto d-flex justify-content-between flex-wrap mb-5">
                <div>
                    <input class="mb-3" type="checkbox" name="remember" id="remember" />
                    <label class="d-inline loginOptions" for="remember">Remember me</label>
                </div>
                <div class="">
                    <a href="forgot_password.php" class="text-white loginOptions">Forgot your password?</a>
                </div>
            </div>
            

            <button class="d-flex justify-content-center mx-auto mb-3" type="submit" value="login">Login</button>
        </form>
    </div>
</body>
<!-- ================== BEGIN core-js ================== -->
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
	<script src="../dist/js/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- ================== END core-js ================== -->
	