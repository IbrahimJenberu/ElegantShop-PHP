<?php
session_start(); // Start the session
include "connect.php"; // Include the database connection file

// Redirect if the user is not logged in as an admin
if (!(isset($_SESSION["username"]) && ($_SESSION["role"] == "admin"))) {
    header("Location: login_page.php");
    exit();
}

// Fetch transaction history from the database
$sql = "SELECT * FROM history2";
$result = mysqli_query($con, $sql);

// Check if the query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Start the table and add headers
    echo "<table class='transaction-table'>
          <tr>
              <th>Prod ID</th>
              <th>Username</th>
              <th>Full Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Product Size</th>
          </tr>";

    // Loop through each row and display the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
              <td>" . htmlspecialchars($row['id']) . "</td>
              <td>" . htmlspecialchars($row['username']) . "</td>
              <td>" . htmlspecialchars($row['full_name']) . "</td>
              <td>" . htmlspecialchars($row['phone']) . "</td>
              <td>" . htmlspecialchars($row['address']) . "</td>
              <td>" . htmlspecialchars($row['productName']) . "</td>
              <td>" . htmlspecialchars($row['quantity']) . "</td>
              <td>" . htmlspecialchars($row['price']) . "</td>
              <td>" . htmlspecialchars($row['product_size']) . "</td>
              </tr>";
    }

    echo "</table>"; // Close the table
} else {
    // Display a message if no records are found
    echo "<p style='text-align: center; color: red;'>No transaction history found.</p>";
}

mysqli_close($con); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <style>
        /* Table Styling */
        .transaction-table {
            margin: 20px auto;
            width: 70%;
            border-collapse: collapse;
            text-align: center;
        }

        .transaction-table th,
        .transaction-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .transaction-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .transaction-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .transaction-table tr:hover {
            background-color: #f1f1f1;
        }

        /* Error Message Styling */
        .error-message {
            text-align: center;
            color: red;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Transaction History</h1>
    <?php
    // The PHP code above will render the table or error message here
    ?>
</body>
</html>
