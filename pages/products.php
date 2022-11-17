<?php
include '../scripts.php';
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}
$pageTitle = 'Products';
include_once '../includes/header.php';
echo'<link rel="stylesheet" href="../dist/css/vendor.min.css">
<link rel="stylesheet" href="../dist/css/style.css">';
?>

<body id="dashboardPage">
    <!-- Navbar -->
    <?php include_once '../includes/navbar.php'; ?>
    <!-- End of Navbar -->
    <div id="wrapper">
    <!-- Sidebar -->
    <?php include_once '../includes/sidebar.php';?>
    <!-- End of Sidebar -->
    <main class="container">