<?php
session_start();
require "functions.php";

// Check user role and redirect accordingly
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role == "Admin") {
        header("Location: admin/home.php");
        exit;
    } else {
        header("Location: user/lapangan.php");
        exit;
    }
}

// Handle password reset request
if (isset($_POST['resetpass'])) {
    $email = $_POST['username'];
    $cek = mysqli_query($conn, "SELECT * FROM user_212279 WHERE 212279_email = '$email'");
    if (mysqli_num_rows($cek) > 0) {
        // Correct way to set a cookie
        setcookie('username', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
        header("Location: resetsandi.php");
        exit;
    } else {
        echo '<script>alert("Email Belum Terdaftar")</script>';
        header("Location: login.php");
        exit;
    }
}

// Handle new password update
if (isset($_POST['sandibaru'])) {
    $pass = $_POST['newpassword'];
    // Retrieve the email from the cookie
    if (isset($_COOKIE['username'])) {
        $email = $_COOKIE['username'];
        // Make sure to properly escape the password and email to prevent SQL injection
        $pass = mysqli_real_escape_string($conn, $pass);
        $email = mysqli_real_escape_string($conn, $email);
        // Use prepared statements to update the password securely
        $stmt = $conn->prepare("UPDATE user_212279 SET 212279_password = ? WHERE 212279_email = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $pass, $email);
            $stmt->execute();
            $stmt->close();
            header("Location: login.php");
            exit;
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo '<script>alert("Email not found in cookie")</script>';
        header("Location: login.php");
        exit;
    }
}
?>
