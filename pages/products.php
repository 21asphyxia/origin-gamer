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
                <button class="btn btn-primary rounded p-0 me-3">Add Product</button>
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
                        	</tr>';}}
						?>
                    </tbody>
                </table>
            </div>
        </div>
        <form class="modalshow " id="form" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Product</h5>
					<button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label for="taskTitle" class="col-form-label">Title</label>
						<input type="text" class="form-control" onkeyup="enableADD()" onCut="return false" id="taskTitle">
						<div id="msg"></div>
					</div>
					<div class="mb-3">
						<label class="col-form-label">Type</label>
						<div class="form-check ms-3">
							<input class="form-check-input" type="radio" value="Feature" name="type" id="feature" checked>
							<label class="form-check-label" for="feature">Feature</label>
						</div>
						<div class="form-check ms-3">
							<input class="form-check-input" type="radio" value="Bug" name="type" id="bug">
							<label class="form-check-label" for="bug">Bug</label>
						</div>
					</div>
					<div class="mb-3">
						<label for="Priority" class="col-form-label">Priority</label>
						<select class="form-select" aria-label="Default select example" id="priority">
							<option selected disabled hidden value="default">Please select</option>
							<option value="Low">Low</option>
							<option value="Medium">Medium</option>
							<option value="High">High</option>
							<option value="Critical">Critical</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="status" class="col-form-label">Status</label>
						<select id="status" class="form-select" aria-label="Default select example">
							<option selected disabled hidden value="default">Please select</option>
							<option value="to-do-tasks">To do</option>
							<option value="in-progress-tasks">In progress</option>
							<option value="done-tasks">Done</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="date" class="col-form-label">Date</label>
						<input type="date" class="form-control" id="date">
					</div>
					<div class="mb-3">
						<label for="description" class="col-form-label">Description</label>
						<textarea class="form-control" id="description"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light text-black border" data-bs-dismiss="modal" id="cancel-button">Cancel</button>
					<button type="button" onclick="deleteTask()" class="btn btn-outline-danger border" id="delete-button">Delete</button>
					<button type="button" onclick="saveTask()" id="save-button" class="btn btn-primary" disabled>Save</button>
					<button type="button" onclick="updateTask()" class="btn btn-primary" id="update-button">Update</button>
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