<?php
// header.php
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - เว็บไซต์ทางการแพทย์</title>
    <!-- ฟอนต์ Kanit จาก Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: 'Kanit', sans-serif;
            background-color: #f9fdf9;
            color: #033d12;
        }
        header {
            background-color: #2e7d32; /* เขียวเข้ม */
            color: white;
            padding: 15px 20px;
            font-size: 24px;
            font-weight: 600;
        }
        .container {
            display: flex;
            height: calc(100vh - 60px);
        }
        nav {
            width: 220px;
            background-color: #a5d6a7; /* เขียวอ่อน */
            padding-top: 20px;
            box-sizing: border-box;
        }
        nav a {
            display: block;
            padding: 12px 20px;
            color: #033d12;
            text-decoration: none;
            font-weight: 500;
            border-left: 4px solid transparent;
            transition: background-color 0.3s, border-left-color 0.3s;
        }
        nav a:hover, nav a.active {
            background-color: #81c784;
            border-left-color: #2e7d32;
            color: #1b5e20;
        }
        main {
            flex-grow: 1;
            background-color: white;
            padding: 30px;
            box-sizing: border-box;
            overflow-y: auto;
        }
    </style>
</head>
<body>
<header>
    เว็บไซต์ทางการแพทย์ - แดชบอร์ดแก้ไขหลังบ้าน
</header>
<div class="container">
<nav>

