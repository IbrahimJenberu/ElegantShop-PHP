<?php
session_start();

// Redirect to the appropriate page if the user is already logged in
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "admin") {
        header("Location: adminPage.php");
        exit();
    } elseif ($_SESSION["role"] == "customer") {
        header("Location: customerPage.php");
        exit();
    }
}

include "connect.php";

if (isset($_POST["submit"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"]; // Password is not sanitized to preserve special characters
    $role = htmlspecialchars($_POST["role"]);

    if ($role == "admin") {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Verify the password (assuming passwords are stored in plain text for admin)
            if ($password === $row['password']) {
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $role;
                echo "<script>window.location='adminPage.php';</script>";
                exit();
            } else {
                echo "<script>document.getElementById('demo').innerHTML='Invalid username or password.';</script>";
            }
        } else {
            echo "<script>document.getElementById('demo').innerHTML='Invalid username or password.';</script>";
        }
        mysqli_stmt_close($stmt);
    } elseif ($role == "customer") {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM customer WHERE username = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Verify the hashed password
            if (password_verify($password, $row['password'])) {
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $role;
                echo "<script>window.location='customerPage.php';</script>";
                exit();
            } else {
                echo "<script>document.getElementById('demo').innerHTML='Invalid username or password.';</script>";
            }
        } else {
            echo "<script>document.getElementById('demo').innerHTML='Invalid username or password.';</script>";
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($con);
?>

<?php
session_start();

// Redirect to the appropriate page if the user is already logged in
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "admin") {
        header("Location: adminPage.php");
        exit();
    } elseif ($_SESSION["role"] == "customer") {
        header("Location: customerPage.php");
        exit();
    }
}

include "connect.php";

if (isset($_POST["submit"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"]; // Password is not sanitized to preserve special characters
    $role = htmlspecialchars($_POST["role"]);

    if ($role == "admin") {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Verify the password (assuming passwords are stored in plain text for admin)
            if ($password === $row['password']) {
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $role;
                echo "<script>window.location='adminPage.php';</script>";
                exit();
            } else {
                echo "<script>document.getElementById('demo').innerHTML='Invalid username or password.';</script>";
            }
        } else {
            echo "<script>document.getElementById('demo').innerHTML='Invalid username or password.';</script>";
        }
        mysqli_stmt_close($stmt);
    } elseif ($role == "customer") {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM customer WHERE username = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Verify the hashed password
            if (password_verify($password, $row['password'])) {
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $role;
                echo "<script>window.location='customerPage.php';</script>";
                exit();
            } else {
                echo "<script>document.getElementById('demo').innerHTML='Invalid username or password.';</script>";
            }
        } else {
            echo "<script>document.getElementById('demo').innerHTML='Invalid username or password.';</script>";
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($con);
?>
