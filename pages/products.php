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
    
    <main class="pt-3 mx-auto">
	<?php if (isset($_SESSION['message'])){
				echo "<div ";

				 if ($_SESSION['msg_type'] == "success") 
				{echo "class='alert alert-success alert-dismissible fade show mb-4' >
					<strong class='text-black'>Success! </strong>";}
				else { echo "class='alert alert-danger alert-dismissible fade show mb-4' >
					<strong class='text-black'>Failure! </strong>";}
					
						echo $_SESSION['message']; 
						unset($_SESSION['message']);
					
					echo '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></span>
				</div>';
				} ?>
        <div class="box py-4 list overflow-auto">
            <div class="d-flex justify-content-between">
                <span class="fw-bold ps-3">All Products</span>
                <button class="btn rounded px-3 me-3" id="addButton" onclick="createProduct()"><i class="fa fa-plus pe-3"></i>Add Product</button>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th class="text-secondary fs-7 text-center" scope="col">#</th>
                            <th class="text-secondary fs-7 text-center" scope="col"></th>
                            <th class="text-secondary fs-7 text-center" scope="col">Product Name</th>
                            <th class="text-secondary fs-7 text-center" scope="col">Brand</th>
                            <th class="text-secondary fs-7 text-center" scope="col">Category</th>
                            <th class="text-secondary fs-7 text-center" scope="col">Description</th>
                            <th class="text-secondary fs-7 text-center" scope="col">Stock</th>
                            <th class="text-secondary fs-7 text-center" scope="col">Price</th>
                            <th class="text-secondary fs-7 text-center" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$result = getProducts();
						var_dump($result);
    die;
						if(mysqli_num_rows($result) > 0)
						{
							//FETCH DATA AS ASSOCIATIVE ARRAY
							while($row = mysqli_fetch_assoc($result))
							{
							echo'
							<tr>
								<td class=" fs-7 text-center align-middle " scope="col">#'.$row["id"].'</td>
								<td class=" fs-7 text-center align-middle " scope="col"><img src="../';
								if($row["image"] == null)
								{
									echo 'dist/img/default.png';
								}
								else
								{
									echo $row["image"];
								}
								
								
								echo'" width="72" height="72"></td>
								<td class=" fs-7 text-center align-middle" scope="col">'.$row["name"].'</td>
								<td class=" fs-7 text-center align-middle" scope="col">'.$row["brand"].'</td>
								<td class=" fs-7 text-center align-middle" scope="col">'.$row["category_name"].'</td>
								<td class=" fs-7 text-center align-middle" scope="col">'.$row["description"].'</td>
								<td class=" fs-7 text-center align-middle" scope="col">'.$row["stock"].'</td>
								<td class=" fs-7 text-center align-middle" scope="col">'.$row["price"].'</td>
								<td class="actionsIcons d-flex justify-content-around align-items-center">
									<a href="products.php?editProduct='.$row["id"].'"><i class="bi fs-6 text-primary bi-pencil-square" ></i>
									</a>
									<a href="../scripts.php?deleteProduct='.$row["id"].'"><i class="bi bi-trash fs-6 text-danger"></i>
									</a>
								</td>
                        	</tr>';}}
						?>
                    </tbody>
                </table>
            </div>
        </div>
		<?php
		if(isset($_GET['editProduct'])){
			$inputs = getInputs();
			if(mysqli_num_rows($inputs) > 0)
			{
				//FETCH DATA AS ASSOCIATIVE ARRAY
				$row = mysqli_fetch_assoc($inputs);
			}
		}
		?>
        <form class="modal fade <?php if(isset($_GET['editProduct'])){echo 'show';}?>" id="form" tabindex="-1" action="../scripts.php" method="post" oninput="enableADD()" enctype="multipart/form-data">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header mb-3">
					<h5 class="modal-title"><?php if(isset($_GET['editProduct'])){echo 'Update';}	else { echo 'Add';}?> Product</h5>
					<button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				<input type="hidden" name="productId" id="product-id" value="<?php
						if(isset($row['id'])){
							echo $row['id'];
						}?>">
					<div class="mb-3">
						<input type="text" name="productName" class="form-control" id="productName" placeholder="Product Name" value="<?php
						if(isset($row['name'])){
							echo $row['name'];
						}?>">
						<?php if(isset($_SESSION['nameErr'])){
							echo '<div class="alert alert-danger mt-2" role="alert">'.$_SESSION['nameErr'].'</div>';
							unset($_SESSION['nameErr']);
						}?>
					</div>
					<div class="mb-3">
						<input type="text" name="brand" class="form-control" id="brandName" placeholder="Brand" value="<?php
						if(isset($row['brand'])){
							echo $row['brand'];
						}?>">
						<?php if(isset($_SESSION['brandErr'])){
							echo '<div class="alert alert-danger mt-2" role="alert">'.$_SESSION['brandErr'].'</div>';
							unset($_SESSION['brandErr']);
						}?>
					</div>
					<div class="mb-3">
						<select class="form-select" name="category" id="category" required>
							<option <?php if(!isset($row['category_name'])){
							echo "selected";}?> disabled hidden value="">Category</option>
							<option value="Processors" <?php if(isset($row['category_name'])){
							if($row['category_name'] == "Processors") echo "selected";}?>>Processors</option>
							<option value="Motherboards" <?php if(isset($row['category_name'])){
							if($row['category_name'] == "Motherboards") echo "selected";}?>>Motherboards</option>
							<option value="RAM" <?php if(isset($row['category_name'])){
							if($row['category_name'] == "RAM") echo "selected";}?>>RAM</option>
							<option value="Graphic Cards" <?php if(isset($row['category_name'])){
							if($row['category_name'] == "Graphic Cards") echo "selected";}?>>Graphic Cards</option>
							<option value="Keyboards" <?php if(isset($row['category_name'])){
							if($row['category_name'] == "Keyboards") echo "selected";}?>>Keyboards</option>
							<option value="Mice" <?php if(isset($row['category_name'])){
							if($row['category_name'] == "Mice") echo "selected";}?>>Mice</option>
							<option value="Headsets" <?php if(isset($row['category_name'])){
							if($row['category_name'] == "Headsets") echo "selected";}?>>Headsets</option>
							<option value="Mousepads" <?php if(isset($row['category_name'])){
							if($row['category_name'] == "Mousepads") echo "selected";}?>>Mousepads</option>
						</select>
						<?php if(isset($_SESSION['categoryErr'])){
							echo '<div class="alert alert-danger mt-2" role="alert">'.$_SESSION['categoryErr'].'</div>';
							unset($_SESSION['categoryErr']);
						}?>
					</div>
					<div class="mb-3">
						<input type="number" name="stock" class="form-control" id="stock" placeholder="Stock" value="<?php
						if(isset($row['stock'])){
							echo $row['stock'];
						}?>">
						<?php if(isset($_SESSION['stockErr'])){
							echo '<div class="alert alert-danger mt-2" role="alert">'.$_SESSION['stockErr'].'</div>';
							unset($_SESSION['stockErr']);
						}?>
					</div>
					<div class="mb-3">
						<input type="number" name="price" class="form-control" id="price" placeholder="Price" value="<?php
						if(isset($row['price'])){
							echo $row['price'];
						}?>">
						<?php if(isset($_SESSION['priceErr'])){
							echo '<div class="alert alert-danger mt-2" role="alert">'.$_SESSION['priceErr'].'</div>';
							unset($_SESSION['priceErr']);
						}?>
					</div>
					<div class="mb-3">
						<input type="file" name="productImage" class="form-control" id="image">
						<?php if(isset($_SESSION['imageError'])){
							echo '<div class="alert alert-danger mt-2" role="alert">'.$_SESSION['imageError'].'</div>';
							unset($_SESSION['imageError']);
						}?>
					</div>
					<div class="mb-3">
						<textarea class="form-control" name="description" id="description" placeholder="Description" ><?php
						if(isset($row['description'])){
							echo $row['description'];
						}?></textarea>
						<?php if(isset($_SESSION['descriptionErr'])){
							echo '<div class="alert alert-danger mt-2" role="alert">'.$_SESSION['descriptionErr'].'</div>';
							unset($_SESSION['descriptionErr']);
						}?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-bs-dismiss="modal" id="cancel-button">Cancel</button>
					<button type="button" name="delete" class="btn btn-outline-danger " id="delete-button">Delete</button>
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
	
<?php if(isset($_GET['editProduct'])){echo "<script type = text/javascript>
            document.getElementById('save-button').classList.add('d-none');
			
			$(document).ready(function() {
			  $('#form').modal('show');
		  }); </script>";}
		  
	if(isset($_SESSION['error'])){
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
?>