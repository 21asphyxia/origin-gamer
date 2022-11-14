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

    <div class="container col-6">

        <h1>Login</h1>
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
	