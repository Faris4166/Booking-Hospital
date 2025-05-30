<?php
session_start(); // เริ่ม session

// ลบข้อมูลทั้งหมดใน session
$_SESSION = array();

// ถ้ามีการใช้ session cookie ให้ลบทิ้งด้วย
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// ทำลาย session
session_destroy();

// ส่งผู้ใช้กลับไปยังหน้า login หรือหน้าหลัก
header("Location: login.php");
exit;
