<?php
include('../database/db.php');

$user_id = $_POST['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password']; // ไม่บังคับกรอก
$tel = $_POST['tel'];
$line_id = $_POST['line_id'];
$gender = $_POST['gender'];
$role = $_POST['role'];
$is_verified = $_POST['is_verified'];

// ตรวจสอบว่าจะแก้รหัสผ่านไหม
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE user_tb SET username=?, email=?, password=?, tel=?, line_id=?, gender=?, role=?, is_verified=? WHERE user_id=?");
    $stmt->bind_param("sssssssii", $username, $email, $hashedPassword, $tel, $line_id, $gender, $role, $is_verified, $user_id);
} else {
    $stmt = $conn->prepare("UPDATE user_tb SET username=?, email=?, tel=?, line_id=?, gender=?, role=?, is_verified=? WHERE user_id=?");
    $stmt->bind_param("ssssssii", $username, $email, $tel, $line_id, $gender, $role, $is_verified, $user_id);
}

if ($stmt->execute()) {
    header("Location: manage_user_page.php?success=แก้ไขข้อมูลผู้ใช้เรียบร้อยแล้ว");
} else {
    header("Location: manage_user_page.php?error=เกิดข้อผิดพลาดในการแก้ไข");
}
?>
