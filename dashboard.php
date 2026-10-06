<?php

session_start();
include("includes/config.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$total_students = mysqli_query($conn,"SELECT * FROM students");
$total = mysqli_num_rows($total_students);

$search="";

if(isset($_GET['search'])){
    $search=mysqli_real_escape_string($conn,$_GET['search']);
}

$students=mysqli_query(
$conn,
"SELECT * FROM students
WHERE name LIKE '%$search%'
OR course LIKE '%$search%'
OR phone LIKE '%$search%'
OR email LIKE '%$search%'
ORDER BY id DESC"
);












?>

<!DOCTYPE html>
<html>
<head>

<title>Student Management System</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="dashboard">

    <div class="sidebar">

        <h2>SMS</h2>

        <ul>

            <li>
                <a href="dashboard.php">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="add_student.php">
                    Add Student
                </a>
            </li>

            <li>
                <a href="logout.php">
                    Logout
                </a>
            </li>

        </ul>

    </div>

    <div class="main">

        <div class="topbar">

            <h1>
                Welcome,
                <?php echo $_SESSION['user']; ?> 👋
            </h1>

        </div>

        <div class="stats">

            <div class="card stat-card">

                <h3>Total Students</h3>

                <h1>
                    <?php echo $total; ?>
                </h1>

            </div>

        </div>

        <div class="card">

            <h2>Student List</h2>

            <form method="GET">

                <input
                    type="text"
                    name="search"
                    placeholder="Search student..."
                    value="<?php echo htmlspecialchars($search); ?>"
                >

                <button type="submit">
                    Search
                </button>

            </form>

            <table>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>

                <?php while($row=mysqli_fetch_assoc($students)){ ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['name']; ?></td>

                    <td><?php echo $row['course']; ?></td>

                    <td><?php echo $row['phone']; ?></td>

                    <td><?php echo $row['email']; ?></td>

                    <td>

                        <a
                        class="btn-edit"
                        href="edit_student.php?id=<?php echo $row['id']; ?>">
                        Edit
                        </a>

                        <a
                        class="btn-delete"
                        href="delete_student.php?id=<?php echo $row['id']; ?>"
                        onclick="return confirm('Delete student?')">
                        Delete
                        </a>

                    </td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>