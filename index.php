<?php
include 'scripts.php';
if (isset($_SESSION['id'])) {
    header('Location: pages/dashboard.php');
}
else{
    header('Location: pages/login.php');
}
?>

	