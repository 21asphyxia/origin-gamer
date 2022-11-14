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
<body>

<!-- ==================================================== -->

    <div id="loginBox" class="container p-2 col-6 shadow-lg">

        <h2 id="pageTitle">Login</h2>
        <div id="logo" class="d-flex">
            <img class="align-self-center" src="../dist/logo.png" width="32" height="32" alt="Origin Gamer Logo">
            <h1 class="align-self-center">Origin Gamer</h1>
        </div>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" />
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" />
            <input type="submit" value="Login" />
        </form>
    </div>
</body>
<!-- ================== BEGIN core-js ================== -->
    <script src="/dist/js/bootstrap.bundle.min.js"></script>
	<script src="/dist/js/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- ================== END core-js ================== -->
	