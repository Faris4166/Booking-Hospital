<?php
include('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $room_name = $conn->real_escape_string($_POST['room_name']);
    $room_status = $conn->real_escape_string($_POST['room_status']);
    $description = $conn->real_escape_string($_POST['description']);
    $capacity = (int)$_POST['capacity'];
    $location = $conn->real_escape_string($_POST['location']);

    // ตรวจสอบค่าว่างเบื้องต้น
    if (empty($room_name) || empty($room_status) || empty($capacity) || empty($location)) {
        header("Location: manage_room_page.php?error=กรุณากรอกข้อมูลให้ครบถ้วน");
        exit;
    }

    // ตรวจสอบชื่อห้องซ้ำ
    $checkSql = "SELECT room_id FROM room_tb WHERE room_name = '$room_name' LIMIT 1";
    $checkResult = $conn->query($checkSql);
    if ($checkResult->num_rows > 0) {
        header("Location: manage_room_page.php?error=ชื่อห้องนี้ถูกใช้งานแล้ว กรุณาใช้ชื่ออื่น");
        exit;
    }

    // เตรียมคำสั่ง SQL insert
    $sql = "INSERT INTO room_tb (room_name, room_status, description, capacity, location) 
            VALUES ('$room_name', '$room_status', '$description', $capacity, '$location')";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_room_page.php?success=เพิ่มห้องสำเร็จ");
        exit;
    } else {
        header("Location: manage_room_page.php?error=เกิดข้อผิดพลาดในการบันทึกข้อมูล");
        exit;
    }
} else {
    header("Location: manage_room_page.php");
    exit;
}
?>
