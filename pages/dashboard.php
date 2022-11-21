<?php
include '../scripts.php';
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}
$pageTitle = 'Dashboard';
include_once '../includes/header.php';
?>

<body id="dashboardPage">
    <!-- Navbar -->
    <?php include_once '../includes/navbar.php'; ?>
    <!-- End of Navbar -->
    <div id="wrapper">
    <!-- Sidebar -->
    <?php include_once '../includes/sidebar.php';?>
    <!-- End of Sidebar -->
    <main class="container mt-5">
        <div class="mt-5 d-flex justify-content-evenly w-100 mb-5">
            <div class="ps-3 pe-5 py-3 box">
                <div class="mb-5">Total Income</div>
                <div class="fw-bold">12,345 Dh</div>
            </div>
            <div class="ps-3 pe-5 py-3 box">
                <div class="mb-5">Total Orders</div>
                <div class="fw-bold">1234 Orders</div>
            </div>
        </div>
        <div class="box">
            <span class="fw-bold ps-3">Recent Orders</span>
            <div class="table-responsive mt-3">
                <table class="table table-borderless">
                    <thead>
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
                    <tr>
                            <td class=" fs-7 " scope="col">1</td>
                            <td class=" fs-7 " scope="col">25</td>
                            <td class=" fs-7 " scope="col">Mouad El Amraoui</td>
                            <td class=" fs-7 " scope="col">Kenitra</td>
                            <td class=" fs-7 " scope="col">Order Date</td>
                            <td class=" fs-7 " scope="col">Paid</td>
                            <td class=" fs-7 " scope="col">125DH</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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