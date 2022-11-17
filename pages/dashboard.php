<?php
include '../scripts.php';
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}
$pageTitle = 'Login';
include_once '../includes/header.php';
echo'<link rel="stylesheet" href="../dist/css/vendor.min.css">
<link rel="stylesheet" href="../dist/css/style.css">';
?>

<body id="dashboardPage">
    <nav id="header" class="navbar navbar-expand-md d-flex border-bottom-2 ">
        <div class="navbar navbar-header flex-fill p-2">
            <a href="dashboard.php" class="">
                <img src="../dist/img/logo.png" alt="logo" width="250" class=""> 
            </a>
        </div>
        
        <div class="pt-1 pe-2 ">
            <a href="/profile">
                <img src="../dist/img/user1pfp.png"  width="42" alt="Profile Picture"> 
                <span class="d-none d-sm-inline username"><?= $_SESSION['name']?></span>
            </a>
        </div>
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    </nav>
<!-- Sidebar -->
<div id="wrapper">
    <ul class="navbar-nav sidebar md-sm-dis shadow" id="sidebar">
        <!-- dashboard button -->
        <li class="nav-item active mt-5">
            <a class="nav-link" href="../index.php">
                <button class="nav-btn p-5 d-flex">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></button></a>
        </li>

        <!-- Products button -->
        <li class="nav-item active mt-5">
            <a class="nav-link" href="../index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Products</span></a>
        </li>
        
        <li class="nav-item active mt-5">
            <a class="nav-link" href="../index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Profile</span></a>
        </li>

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <main>
        <div class="mt-5 d-flex justify-content-evenly w-100 h-50">
            <div class="px-5 box">
                <div class="">Total Income</div>
                <div>12,345 Dh</div>
            </div>
            <div class="px-5 box">
                <div>Total Income</div>
                <div>12,345 Dh</div>
            </div>
        </div>
        <div class="box ">
            <table>
                
            </table>
        </div>
    </main>
</div>
</body>

<!-- ================== BEGIN core-js ================== -->
    <script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/scripts.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../dist/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->