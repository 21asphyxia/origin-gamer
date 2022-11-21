<?php
    require_once ($_SERVER['DOCUMENT_ROOT'].'/origin-gamer/vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/origin-gamer');
    $dotenv->load();

    $servername = $_ENV['DB_HOST'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];
    $db = $_ENV['DB_DATABASE'];
    //CONNECT TO MYSQL DATABASE USING MYSQLI
    
    // Create connection
    $conn =  mysqli_connect($servername,$username,$password,$db);
    // Check connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
     }
?>
