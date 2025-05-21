<?php
// ตัวอย่างข้อมูลจองห้อง (ในจริงควรดึงจากฐานข้อมูล)
$bookings = [
    ['id' => 1, 'room' => 'ห้องตรวจ A', 'date' => '2025-05-22', 'time' => '09:00 - 10:00', 'patient' => 'สมชาย ใจดี'],
    ['id' => 2, 'room' => 'ห้องตรวจ B', 'date' => '2025-05-22', 'time' => '10:00 - 11:00', 'patient' => 'สมหญิง สวยงาม'],
];

// ถ้ามีการส่งข้อมูลแก้ไขผ่าน POST (แบบง่ายๆ)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // ปกติจะอัพเดตฐานข้อมูลที่นี่
    // สมมติอัพเดตข้อมูลเรียบร้อย
    $message = "บันทึกการแก้ไขรหัสการจอง #" . intval($_POST['id']) . " เรียบร้อยแล้ว";
}

include 'header.php';
?>

<h2>แก้ไขตารางการจองห้อง</h2>

<?php if (!empty($message)): ?>
    <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #a5d6a7;">
        <tr>
            <th>รหัส</th>
            <th>ห้อง</th>
            <th>วันที่</th>
            <th>เวลา</th>
            <th>ชื่อผู้จอง</th>
            <th>แก้ไข</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookings as $booking): ?>
        <tr>
            <form method="post" action="">
                <td><?php echo $booking['id']; ?></td>
                <td><input type="text" name="room" value="<?php echo htmlspecialchars($booking['room']); ?>" required></td>
                <td><input type="date" name="date" value="<?php echo $booking['date']; ?>" required></td>
                <td><input type="text" name="time" value="<?php echo htmlspecialchars($booking['time']); ?>" required></td>
                <td><input type="text" name="patient" value="<?php echo htmlspecialchars($booking['patient']); ?>" required></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
                    <button type="submit" style="background-color:#2e7d32; color:white; border:none; padding:5px 10px; cursor:pointer;">บันทึก</button>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
