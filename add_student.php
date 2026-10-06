<?php

session_start();

include("includes/config.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['add_student'])){

    $name = $_POST['name'];
    $course = $_POST['course'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $query = mysqli_query(
        $conn,
        "INSERT INTO students(name, course, phone, email)
        VALUES('$name', '$course', '$phone', '$email')"
    );

    if($query){
        $message = "Student added successfully!";
    }else{
        $message = "Something went wrong!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Student - Student Management System</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Add Student</h1>

        <form method="POST">

            <input
                type="text"
                name="name"
                placeholder="Student Name"
                required
            >

            <input
                type="text"
                name="course"
                placeholder="Course"
                required
            >

            <input
                type="text"
                name="phone"
                placeholder="Phone Number"
                required
            >

            <input
                type="email"
                name="email"
                placeholder="Email Address"
                required
            >

            <button type="submit" name="add_student">
                Add Student
            </button>

        </form>

        <br>

        <?php

        if($message != ""){
            echo "<p>$message</p>";
        }

        ?>

        <br>

        <a href="dashboard.php">
            ← Back to Dashboard
        </a>

    </div>

</div>

</body>

</html>