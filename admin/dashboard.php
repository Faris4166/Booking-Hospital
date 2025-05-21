<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'page1';

function isActive($p) {
    global $page;
    return $page === $p ? 'active' : '';
}
?>

<?php include 'header.php'; ?>

<a href="?page=page1" class="<?php echo isActive('page1'); ?>">แก้ไขข้อมูลหน้า 1</a>
<a href="?page=page2" class="<?php echo isActive('page2'); ?>">แก้ไขข้อมูลหน้า 2</a>
<a href="?page=page3" class="<?php echo isActive('page3'); ?>">แก้ไขข้อมูลหน้า 3</a>

<?php include 'footer.php'; ?>

<?php
// โหลดเนื้อหาตามหน้า
switch($page) {
    case 'page1':
        include 'edit-booking.php';  // แก้ไขตารางจองห้อง
        break;
    case 'page2':
        echo "<h2>หน้าแก้ไขข้อมูล 2</h2><p>เนื้อหาสำหรับแก้ไขข้อมูลหน้า 2</p>";
        break;
    case 'page3':
        echo "<h2>หน้าแก้ไขข้อมูล 3</h2><p>เนื้อหาสำหรับแก้ไขข้อมูลหน้า 3</p>";
        break;
    default:
        echo "<h2>หน้าไม่พบ</h2>";
}
?>
