<?php
session_start(); // Start the session
include "connect.php"; // Include the database connection file

// Redirect if the user is not logged in as an admin
if (!(isset($_SESSION["username"]) && ($_SESSION["role"] == "admin"))) {
    header("Location: login_page.php");
    exit();
}

// Pagination
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch transaction history from the database
$sql = "SELECT * FROM history2 LIMIT $limit OFFSET $offset";
$result = mysqli_query($con, $sql);

// Check if the query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

// Export to CSV
if (isset($_POST['export'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="transaction_history.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Prod ID', 'Username', 'Full Name', 'Phone', 'Address', 'Product Name', 'Quantity', 'Price', 'Product Size']);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
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

    // Pagination Links
    $total_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM history2"));
    $total_pages = ceil($total_records / $limit);
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='transaction_history.php?page=$i'>$i</a> ";
    }
    echo "</div>";
} else {
    // Display a message if no records are found
    echo "<p class='error-message'>No transaction history found.</p>";
}

mysqli_close($con); // Close the database connection
?>
