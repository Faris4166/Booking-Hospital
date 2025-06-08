<?php
include('../database/db.php');
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM room_tb WHERE room_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manage_room_page.php"); // กลับไปหน้าหลักหลังลบ
    } else {
        echo "เกิดข้อผิดพลาดในการลบ";
    }
    $stmt->close();
}
?>
