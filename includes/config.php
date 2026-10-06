<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "sms"
);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>