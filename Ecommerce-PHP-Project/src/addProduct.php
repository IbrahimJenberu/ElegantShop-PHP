<?php
session_start();
include "connect.php";

// Redirect if user is not logged in as admin
if (!(isset($_SESSION["username"]) && ($_SESSION["role"] == "admin"))) {
    header("Location: login_page.php");
    exit();
}

if (isset($_POST["submit"])) {
    $product_name = htmlspecialchars($_POST["name"]);
    $product_price = htmlspecialchars($_POST["price"]);
    $file_name = $_FILES["file"]['name'];
    $tmp_name = $_FILES["file"]['tmp_name'];
    $upload_dir = "uploads/"; // Directory to store uploaded files

    // Validate file type (only allow images)
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_types)) {
        echo "<script>alert('You can only upload JPG, JPEG, PNG, or GIF files.')</script>";
    } else {
        // Generate a unique file name to avoid conflicts
        $unique_file_name = uniqid() . "_" . basename($file_name);
        $target_file = $upload_dir . $unique_file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($tmp_name, $target_file)) {
            // Insert product details into the database
            $sql = "INSERT INTO product (productName, price, image) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $product_name, $product_price, $unique_file_name);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Product inserted successfully.')</script>";
            } else {
                echo "<script>alert('Failed to insert product.')</script>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Failed to upload file.')</script>";
        }
    }

    mysqli_close($con);
}
?>
