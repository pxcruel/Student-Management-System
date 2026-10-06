<?php

include("includes/config.php");

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    mysqli_query(
        $conn,
        "INSERT INTO users(username,email,password)
        VALUES('$username','$email','$password')"
    );
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Register - Student Management System</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Create Account</h1>

        <form method="POST">

            <input
                type="text"
                name="username"
                placeholder="Username"
                required
            >

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

            <button type="submit" name="register">
                Register
            </button>

        </form>

        <br>

        <a href="login.php">
            Already have an account? Login
        </a>

    </div>

</div>

</body>
</html>