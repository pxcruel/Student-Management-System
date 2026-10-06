<?php

session_start();

include("includes/config.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM students WHERE id='$id'"
    );
}

header("Location: dashboard.php");
exit();

?>