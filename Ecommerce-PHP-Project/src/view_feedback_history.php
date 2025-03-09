<?php
session_start();
include "connect.php";

// Redirect if user is not logged in as admin
if (!(isset($_SESSION["username"]) && ($_SESSION["role"] == "admin"))) {
    header("Location: login_page.php");
    exit();
}

// Fetch feedback data from the database
$sql = "SELECT * FROM feedback";
$result = mysqli_query($con, $sql);

// Clear feedback history if the form is submitted
if (isset($_POST['submit'])) {
    $sql1 = "DELETE FROM feedback";
    if (mysqli_query($con, $sql1)) {
        echo "<script>alert('Feedback history deleted.'); window.location='adminPage.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to delete feedback history.');</script>";
    }
}
?>
