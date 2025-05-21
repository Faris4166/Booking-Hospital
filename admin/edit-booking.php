<?php
// ตัวอย่างข้อมูลจองห้องเก็บใน array สมมติ
$bookings = [
    ['id' => 1, 'room' => 'ห้องตรวจ A', 'date' => '2025-05-25', 'time' => '09:00-10:00', 'patient' => 'สมชาย'],
    ['id' => 2, 'room' => 'ห้องตรวจ B', 'date' => '2025-05-26', 'time' => '10:00-11:00', 'patient' => 'สมหญิง'],
];

// ถ้ามีการส่ง POST เพื่อแก้ไขข้อมูล (ตัวอย่างง่ายๆ)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // ในที่นี้จะไม่เชื่อม DB สมมติแก้ไขได้แค่แสดงข้อความว่าบันทึกแล้ว
    $updatedId = $_POST['id'];
    $updatedDate = $_POST['date'];
    $updatedTime = $_POST['time'];
    $updatedPatient = $_POST['patient'];

    echo "<p style='color:green;'>บันทึกข้อมูลการจองห้อง ID {$updatedId} เรียบร้อยแล้ว!</p>";
}
?>

<h2>แก้ไขตารางการจองห้อง</h2>

<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 700px;">
    <thead style="background-color: #a5d6a7;">
        <tr>
            <th>รหัส</th>
            <th>ห้อง</th>
            <th>วันที่</th>
            <th>เวลา</th>
            <th>ผู้จอง</th>
            <th>แก้ไข</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <form method="POST">
                    <td><?php echo $booking['id']; ?>
                        <input type="hidden" name="id" value="<?php echo $booking['id']; ?>" />
                    </td>
                    <td><?php echo htmlspecialchars($booking['room']); ?></td>
                    <td><input type="date" name="date" value="<?php echo $booking['date']; ?>" required /></td>
                    <td><input type="text" name="time" value="<?php echo $booking['time']; ?>" required /></td>
                    <td><input type="text" name="patient" value="<?php echo htmlspecialchars($booking['patient']); ?>" required /></td>
                    <td><button type="submit">บันทึก</button></td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
