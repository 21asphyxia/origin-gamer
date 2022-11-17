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

<body id="productsPage">
    <!-- Navbar -->
    <?php include_once '../includes/navbar.php'; ?>
    <!-- End of Navbar -->
    <div id="wrapper">
    <!-- Sidebar -->
    <?php include_once '../includes/sidebar.php';?>
    <!-- End of Sidebar -->
    <main class="container pt-5">
    <div class="box table-responsive">
        <table class="table table-borderless">
                <thead>
                    <tr>
                        <th class="fw-bold"scope="col">All Products</th>
                    </tr>
                    <tr>
                        <th class="text-secondary fs-7 " scope="col">#</th>
                        <th class="text-secondary fs-7 " scope="col">Id Customer</th>
                        <th class="text-secondary fs-7 " scope="col">Customer Name</th>
                        <th class="text-secondary fs-7 " scope="col">City</th>
                        <th class="text-secondary fs-7 " scope="col">Order Date</th>
                        <th class="text-secondary fs-7 " scope="col">Status</th>
                        <th class="text-secondary fs-7 " scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
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