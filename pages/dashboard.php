<?php
include '../scripts.php';
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}
$pageTitle = 'Login';
include_once '../includes/header.php';
?>

<body id="dashboardPage">
<nav id="header" class="navbar navbar-expand-md d-flex border-bottom-2 ">
    <div class="navbar navbar-header flex-fill p-2">
        <a href="dashboard.php" class="">
            <img src="../dist/img/logo.png" alt="logo" width="250" class=""> 
        </a>
    </div>
    <button class="d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"><span class="navbar-toggler-icon navbar-dark "></span></button>
            
        <div class="ps-4 me-4 pt-1 flex-fill">
            <form action="#" method="GET" name="search">
                <div class="form-group">
                    <input type="text" class="searchBar border-0" name="keyword" placeholder="&#xf002;    Search" style="font-family:poppins, FontAwesome" >
                    <button type="submit" class="d-none"></button>
                </div>
            </form>
        </div>
        <div class="pt-1 pe-2 ">
            <a href="/profile">
                <img src="../dist/img/user1pfp.png"  width="42" alt="Profile Picture"> 
                <span class="d-none d-sm-inline username">Mouad El Amraoui
                </span>
            </a>
        </div>
</nav>
</body>

<!-- ================== BEGIN core-js ================== -->
    <script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/scripts.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- ================== END core-js ================== -->