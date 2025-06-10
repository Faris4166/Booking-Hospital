<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'welcome.php'; ?>
<?php include 'FullCalendar.php'; ?>
<?php include 'forms.php'; ?>
