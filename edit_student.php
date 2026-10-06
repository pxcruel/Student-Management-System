<?php

session_start();

include("includes/config.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM students WHERE id='$id'"
);

$student = mysqli_fetch_assoc($query);

if(!$student){
    header("Location: dashboard.php");
    exit();
}

$message = "";

if(isset($_POST['update_student'])){

    $name = $_POST['name'];
    $course = $_POST['course'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $update = mysqli_query(
        $conn,
        "UPDATE students SET
        name='$name',
        course='$course',
        phone='$phone',
        email='$email'
        WHERE id='$id'"
    );

    if($update){

        $message = "Student updated successfully!";

        // Get updated data
        $query = mysqli_query(
            $conn,
            "SELECT * FROM students WHERE id='$id'"
        );

        $student = mysqli_fetch_assoc($query);

    }else{

        $message = "Something went wrong!";

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Student - Student Management System</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Edit Student</h1>

        <form method="POST">

            <input
                type="text"
                name="name"
                value="<?php echo htmlspecialchars($student['name']); ?>"
                placeholder="Student Name"
                required
            >

            <input
                type="text"
                name="course"
                value="<?php echo htmlspecialchars($student['course']); ?>"
                placeholder="Course"
                required
            >

            <input
                type="text"
                name="phone"
                value="<?php echo htmlspecialchars($student['phone']); ?>"
                placeholder="Phone Number"
                required
            >

            <input
                type="email"
                name="email"
                value="<?php echo htmlspecialchars($student['email']); ?>"
                placeholder="Email Address"
                required
            >

            <button type="submit" name="update_student">
                Update Student
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