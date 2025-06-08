<?php
include('../database/db.php');

// รับค่าจากฟอร์ม
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน
$tel = $_POST['tel'];
$line_id = $_POST['line_id'];
$gender = $_POST['gender'];
$role = $_POST['role'];
$is_verified = $_POST['is_verified'];
$created_at = date("Y-m-d H:i:s");

// ตรวจสอบอีเมลซ้ำ
$checkEmail = $conn->prepare("SELECT user_id FROM user_tb WHERE email = ?");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$checkEmail->store_result();

if ($checkEmail->num_rows > 0) {
    header("Location: manage_user_page.php?error=อีเมลนี้ถูกใช้ไปแล้ว");
    exit();
}

$stmt = $conn->prepare("INSERT INTO user_tb (username, email, password, tel, line_id, gender, role, is_verified, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssis", $username, $email, $password, $tel, $line_id, $gender, $role, $is_verified, $created_at);

if ($stmt->execute()) {
    header("Location: manage_user_page.php?success=เพิ่มผู้ใช้เรียบร้อยแล้ว");
} else {
    header("Location: manage_user_page.php?error=เกิดข้อผิดพลาดในการเพิ่ม");
}
?>
