<?php
include 'db.php';
include 'header.php';

$page = $_GET['page'] ?? 'visitors';

if ($page === 'rooms') {
    echo "<h2>ข้อมูลการจองห้อง</h2>";
    $result = $conn->query("SELECT * FROM room_reservations ORDER BY date_reserved DESC");
    echo "<table class='table table-bordered'><thead><tr><th>ชื่อห้อง</th><th>ผู้จอง</th><th>วันที่</th><th>เวลา</th><th>วัตถุประสงค์</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['room_name']}</td><td>{$row['reserver_name']}</td><td>{$row['date_reserved']}</td><td>{$row['time_reserved']}</td><td>{$row['purpose']}</td></tr>";
    }
    echo "</tbody></table>";

} elseif ($page === 'users') {
    echo "<h2>รายชื่อผู้ใช้</h2>";
    $result = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
    echo "<table class='table table-striped'><thead><tr><th>ชื่อ</th><th>ชื่อผู้ใช้</th><th>บทบาท</th><th>วันที่สร้าง</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td>{$row['username']}</td><td>{$row['role']}</td><td>{$row['created_at']}</td></tr>";
    }
    echo "</tbody></table>";

} else {
    echo "<h2>จำนวนผู้เข้าชมเว็บไซต์</h2>";
    $result = $conn->query("SELECT COUNT(*) AS total FROM visitors");
    $row = $result->fetch_assoc();
    echo "<p>มีผู้เข้าชมทั้งหมด: <strong>{$row['total']}</strong> ครั้ง</p>";

    echo "<h4 class='mt-4'>รายการผู้เข้าชมล่าสุด</h4>";
    $recent = $conn->query("SELECT * FROM visitors ORDER BY visit_time DESC LIMIT 10");
    echo "<ul class='list-group'>";
    while ($v = $recent->fetch_assoc()) {
        echo "<li class='list-group-item'>{$v['ip_address']} - {$v['visit_time']}</li>";
    }
    echo "</ul>";
}

include 'footer.php';
$conn->close();
?>
