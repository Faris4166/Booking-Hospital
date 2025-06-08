<?php
include('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['room_id'];
    $name = $_POST['room_name'];
    $status = $_POST['room_status'];
    $desc = $_POST['description'];
    $capacity = $_POST['capacity'];
    $location = $_POST['location'];

    $stmt = $conn->prepare("UPDATE room_tb SET room_name=?, room_status=?, description=?, capacity=?, location=? WHERE room_id=?");
    $stmt->bind_param("sssssi", $name, $status, $desc, $capacity, $location, $id);

    if ($stmt->execute()) {
        header("Location: manage_room_page.php?success=อัปเดตข้อมูลห้องสำเร็จ");
    } else {
        header("Location: manage_room_page.php?error=เกิดข้อผิดพลาดในการอัปเดต");
    }
}
?>
