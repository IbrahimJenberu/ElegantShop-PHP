<?php
session_start();
include "connect.php";

// Redirect if user is not logged in as admin
if (!(isset($_SESSION["username"]) && ($_SESSION["role"] == "admin"))) {
    header("Location: login_page.php");
    exit();
}

// Handle search functionality
if (isset($_POST['submit'])) {
    $search = htmlspecialchars($_POST['search']);
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='0' cellpadding='10' cellspacing='0'>
              <tr><th>Id</th><th>Product_Name</th><th>Product_Price</th><th>Image</th><th>Operations</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                  <td>" . htmlspecialchars($row['id']) . "</td>
                  <td>" . htmlspecialchars($row['productName']) . "</td>
                  <td>" . htmlspecialchars($row['price']) . "</td>
                  <td>" . htmlspecialchars($row['image']) . "</td>
                  <td>
                      <a class='edit' href='editProduct.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a>
                      <a class='delete' onClick=\"javascript:return confirm('Are you sure you want to delete this product?');\" href='deleteProduct.php?id=" . htmlspecialchars($row['id']) . "'>Delete</a>
                  </td>
                  </tr>";
        }
        echo "</table>";
        exit();
    } else {
        echo "<script>alert('Product not found.');</script>";
    }
    mysqli_stmt_close($stmt);
}

// Fetch all products
$sql = "SELECT * FROM product";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='0' cellpadding='10' cellspacing='0'>
          <tr><th>Id</th><th>Product_Name</th><th>Product_Price</th><th>Image</th><th>Operations</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
              <td>" . htmlspecialchars($row['id']) . "</td>
              <td>" . htmlspecialchars($row['productName']) . "</td>
              <td>" . htmlspecialchars($row['price']) . "</td>
              <td>" . htmlspecialchars($row['image']) . "</td>
              <td>
                  <a class='edit' href='editProduct.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a>
                  <a class='delete' onClick=\"javascript:return confirm('Are you sure you want to delete this product?');\" href='deleteProduct.php?id=" . htmlspecialchars($row['id']) . "'>Delete</a>
              </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<script>alert('No products found.');</script>";
}

mysqli_close($con);
?>
