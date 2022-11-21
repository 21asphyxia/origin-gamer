<?php
include '../scripts.php';
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}
$pageTitle = 'Products';
include_once '../includes/header.php';
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
        <div class="box py-4">
            <div class="d-flex justify-content-between">
                <span class="fw-bold ps-3">All Products</span>
                <button class="btn rounded px-3 me-3" id="addButton" onclick="createTask()"><i class="fa fa-plus pe-3"></i>Add Product</button>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th class="text-secondary fs-7 " scope="col">#</th>
                            <th class="text-secondary fs-7 " scope="col">Product Name</th>
                            <th class="text-secondary fs-7 " scope="col">Brand</th>
                            <th class="text-secondary fs-7 " scope="col">Category</th>
                            <th class="text-secondary fs-7 " scope="col">Description</th>
                            <th class="text-secondary fs-7 " scope="col">Stock</th>
                            <th class="text-secondary fs-7 " scope="col">Price</th>
                            <th class="text-secondary fs-7 " scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$result = getProducts();
						if(mysqli_num_rows($result) > 0)
						{
							//FETCH DATA AS ASSOCIATIVE ARRAY
							while($row = mysqli_fetch_assoc($result))
							{
							echo'
							<tr>
								<td class=" fs-7 " scope="col">'.$row["id"].'</td>
								<td class=" fs-7 " scope="col">'.$row["name"].'</td>
								<td class=" fs-7 " scope="col">'.$row["brand"].'</td>
								<td class=" fs-7 " scope="col">'.$row["category"].'</td>
								<td class=" fs-7 " scope="col">'.$row["description"].'</td>
								<td class=" fs-7 " scope="col">'.$row["stock"].'</td>
								<td class=" fs-7 " scope="col">'.$row["price"].'</td>
								<td class="d-flex justify-content-around" style="visibility: hidden;" ><a href="update.php?showmodal=" ><i class="bi fs-6 text-primary bi-pencil-square" ></i></a><i class="bi fs-6 text-danger bi-x-square"></i></td>
                        	</tr>';}}
						?>
                    </tbody>
                </table>
            </div>
        </div>
        <form class="modal fade " id="form" tabindex="-1" action="../scripts.php" method="post" oninput="enableADD()">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header mb-3">
					<h5 class="modal-title">Add Product</h5>
					<button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<input type="text" name="productName" class="form-control" id="productName" placeholder="Product Name">
						<?php if(isset($_SESSION['titleErr'])){
							echo '<div class="alert alert-red mt-2" role="alert">'.$_SESSION['titleErr'].'</div>';
							unset($_SESSION['titleErr']);
						}?>
					</div>
					<div class="mb-3">
						<input type="text" name="brand" class="form-control" id="brandName" placeholder="Brand">
					</div>
					<div class="mb-3">
						<select class="form-select" name="category" id="category" required>
							<option selected disabled hidden value="">Category</option>
							<option value="Processors">Processors</option>
							<option value="Motherboards">Motherboards</option>
							<option value="RAM">RAM</option>
							<option value="Graphic Cards">Graphic Cards</option>
							<option value="Keyboards">Keyboards</option>
							<option value="Mice">Mice</option>
							<option value="Headsets">Headsets</option>
							<option value="Mousepads">Mousepads</option>
						</select>
					</div>
					<div class="mb-3">
						<input type="number" name="stock" class="form-control" id="stock" placeholder="Stock">
					</div>
					<div class="mb-3">
						<input type="number" name="price" class="form-control" id="price" placeholder="Price">
					</div>
					<div class="mb-3">
						<input type="file" name="image" class="form-control" id="image">
					</div>
					<div class="mb-3">
						<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-bs-dismiss="modal" id="cancel-button">Cancel</button>
					<button type="button" name="delete" class="btn btn-outline-danger border" id="delete-button">Delete</button>
					<button type="submit" name="delete" class="d-none" id="hiddenDelete">Delete</button>
					<button type="submit" name="save" id="save-button" class="btn">Save</button>
					<button type="submit" name="update" class="btn" id="update-button">Update</button>
				</div>
			</div>
		</div>
	</form>
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