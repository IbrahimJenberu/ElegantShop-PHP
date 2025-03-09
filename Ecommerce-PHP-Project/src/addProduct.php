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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* Your existing CSS styles */
        * { padding: 0; margin: 0; box-sizing: border-box; }
        body { background-color: #343a40; }
        .header-container {
            width: 100%; height: 15vh; background-color: #1f2327;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
            display: flex; justify-content: space-between; align-items: center;
        }
        .logo-container img { width: 100%; height: 15vh; margin-left: 30px; }
        nav { width: 90%; height: 17vh; display: flex; justify-content: space-evenly; align-items: center; position: relative; left: 100px; }
        nav a { text-decoration: none; font-size: 1.6rem; color: #a58e7c; }
        nav a:hover { scale: 1.1; color: #E8F0FE; }
        .form {
            width: 27vw; height: 52vh; display: flex; padding-top: 0; background-color: #1f2327;
            flex-direction: column; justify-content: space-between; align-items: center; border-radius: 5px;
            margin: 50px auto; box-shadow: 0px 0px 5px 1px black;
        }
        .form div { width: 100%; flex-direction: column; display: flex; justify-content: space-between; }
        input { margin: auto; line-height: 2; padding: 8px 12px; background-color: #E8F0FE; border: none; font-size: 15px; width: 90%; border-radius: 5px; }
        input[type="file"] { margin-right: 41px; margin: auto; }
        input[type="submit"] { color: white; padding: 5px; background-color: #f21b3f; border: none; font-size: 20px; margin: auto; }
        label { color: #D4D4D4; font-size: 20px; margin: 10px 20px; }
        h1 { text-align: center; color: white; font-weight: bold; margin-top: 50px; }
        .back { padding: 8px 20px; text-decoration: none; color: white; text-align: center; background-color: #f21b3f; position: relative; top: 0px; left: 50px; }
        .logout { padding: 7px 30px; background-color: #f21b3f; color: white; border: none; }
        span { color: #f21b3f; }
    </style>
</head>
<body>
    <header class="header-container">
        <nav>
            <a href="customer_info.php"><span>*</span>CUSTOMER INFO</a>
            <a href="product_info.php"><span>*</span>PRODUCT INFO</a>
            <a href="view_transaction.php"><span>*</span>VIEW ORDER</a>
            <a href="view_feedback_history.php"><span>*</span>FEEDBACKS</a>
            <form action="adminPage.php" method="post">
                <button name="logout" class="logout">Log out</button>
            </form>
        </nav>
    </header>
    <h1>Add New Products</h1>
    <a href="product_info.php" class="back">Back</a>
    <form class="form" action="addProduct.php" method="post" enctype="multipart/form-data">
        <div>
            <label for=""><span>*</span>Item Name</label>
            <input type="text" name="name" placeholder="Enter Item Name" required>
        </div>
        <div>
            <label for=""><span>*</span>Item Price</label>
            <input type="text" name="price" placeholder="Enter Item Price" required>
        </div>
        <div>
            <label for=""><span>*</span>Item Image</label>
            <input type="file" name="file" required>
        </div>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>
