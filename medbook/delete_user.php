<?php
include('../database/db.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM user_tb WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header("Location: manage_user_page.php?success=ลบผู้ใช้เรียบร้อยแล้ว");
    } else {
        header("Location: manage_user_page.php?error=เกิดข้อผิดพลาดในการลบ");
    }
} else {
    header("Location: manage_user_page.php?error=ไม่พบผู้ใช้ที่ต้องการลบ");
}
?>
