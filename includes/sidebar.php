<ul class="navbar-nav sidebar md-sm-dis toggled" id="sidebar">
        <li class="nav-item mt-5 d-flex-column">
                <div class="mx-auto username mb-3"><img class ="" src="../dist/img/user1pfp.png" alt="Profile Picture"></div> 
                <p class="username mx-auto"><?= $_SESSION['name']?></p>
        </li>
        <!-- dashboard button -->
        <li class="nav-item mt-5 mx-auto">
            <a class="" href="../index.php">
                <button class="nav-btn <?php if($pageTitle=='Dashboard'){echo "active";} ?>">
                <i class="bi bi-clipboard-data-fill"></i>
                <span>Dashboard</span></button></a>
        </li>

        <!-- Products button -->
        <li class="nav-item  mt-5 mx-auto">
            <a class="" href="products.php">
            <button class="nav-btn <?php if($pageTitle=='Products'){echo "active";} ?>">
                <i class="bi bi-controller"></i>
                <span>Products</span></button></a>
            
        </li>
        
        <li class="nav-item  mt-5 mx-auto">
            <a class="" href="../index.php">
                <button class="nav-btn <?php if($pageTitle=='Profile'){echo "active";} ?>">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span></button></a>
        </li>
    </ul>