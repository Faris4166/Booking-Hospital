<?php // header.php ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>แดชบอร์ดผู้ดูแล</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Kanit', sans-serif; background: #f9f9f9; }
    .navbar { background-color: #2e7d32; }
    .navbar-brand { color: #fff; }
    .sidebar {
        height: 100vh;
        background-color: #43a047;
        padding: 0;
    }
    .sidebar a {
        display: block;
        color: white;
        padding: 15px 15px;
        text-decoration: none;
    }
    .sidebar a:hover {
        background-color: #66bb6a;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="container-fluid">
      <span class="navbar-brand">MEC Dashboard</span>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 sidebar">
        <a href="dashboard.php?page=visitors"><i class="bi bi-eye"></i> รายละเอียดเว็บไซต์</a>
        <a href="dashboard.php?page=rooms"><i class="bi bi-door-open"></i> แก้ไขข้อมูลการจองห้อง</a>
        <a href="dashboard.php?page=users"><i class="bi bi-people"></i> จำนวนผู้ใช้ในระบบ</a>
      </div>
      <div class="col-md-10 p-4">
