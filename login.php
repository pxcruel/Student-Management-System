<?php

session_start();

include("includes/config.php");

$message = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($query) == 1){

        $row = mysqli_fetch_assoc($query);

        if(password_verify($password, $row['password'])){

            $_SESSION['user'] = $row['username'];

            header("Location: dashboard.php");
            exit();

        }else{

            $message = "Incorrect password!";

        }

    }else{

        $message = "Email not registered!";

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Login - Student Management System</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Student Management System</h1>

        <form method="POST">

            <input
                type="email"
                name="email"
                placeholder="Email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
            >

            <button type="submit" name="login">
                Login
            </button>

        </form>

        <br>

        <?php
        if($message != ""){
            echo "<p>$message</p>";
        }
        ?>

        <br>

        <a href="register.php">
            Create Account
        </a>

    </div>

</div>

</body>

</html>