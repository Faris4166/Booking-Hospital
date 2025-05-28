<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_raw = $_POST['password'];
    $tel = trim($_POST['tel']);
    $line_id = trim($_POST['LINE_ID']);
    $gender = $_POST['gender'];
    $role = $_POST['role'];

    // ตรวจสอบว่า email ซ้ำหรือไม่
    $check_stmt = $conn->prepare("SELECT user_id FROM user_tb WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Email ซ้ำ – redirect กลับพร้อม error query string
        $username = urlencode($username);
        $tel = urlencode($tel);
        $line_id = urlencode($line_id);
        $gender = urlencode($gender);
        $role = urlencode($role);
        header("Location: register.php?email_error=1&username=$username&tel=$tel&line_id=$line_id&gender=$gender&role=$role");
        exit();
    }

    // ถ้าไม่ซ้ำ ทำการเพิ่มข้อมูล
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user_tb (username, email, password, tel, line_id, gender, role) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssssss", $username, $email, $password_hashed, $tel, $line_id, $gender, $role);

        if ($stmt->execute()) {
            header("Location: register_success.php");
            exit();
        }

        $stmt->close();
    }

    // fallback หาก insert ไม่สำเร็จ
    header("Location: register.php");
    exit();
} else {
    header("Location: register.php");
    exit();
}
?>
