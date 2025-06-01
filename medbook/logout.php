<?php
session_start(); // เริ่ม session

// ลบข้อมูล session ทั้งหมด
$_SESSION = [];

// ทำลาย session ทิ้ง
session_destroy();

// Redirect ไปหน้า login หรือหน้าอื่น ๆ
header("Location: login.php");
exit();
?>
