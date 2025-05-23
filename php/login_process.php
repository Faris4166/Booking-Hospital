<?php
session_start();
include('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ใช้ prepared statement ปลอดภัยจาก SQL injection
    $stmt = $conn->prepare("SELECT * FROM user_tb WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            // รหัสผ่านผิด
            header("Location: login.php?error=invalid_password");
            exit();
        }
    } else {
        // ไม่พบผู้ใช้
        header("Location: login.php?error=user_not_found");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
