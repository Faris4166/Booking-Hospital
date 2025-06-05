<?php
include('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_raw = $_POST['password'];
    $tel = trim($_POST['tel']);
    $line_id = trim($_POST['LINE_ID']);
    $gender = $_POST['gender'];
    $role = $_POST['role'];

    // ฟังก์ชันช่วย urlencode และสร้าง query string ของข้อมูลฟอร์ม
    function buildQuery($params)
    {
        return http_build_query(array_map('urlencode', $params));
    }

    // เก็บข้อมูลฟิลด์ที่จะส่งกลับ
    $formData = [
        'username' => $username,
        'email' => $email,
        'tel' => $tel,
        'line_id' => $line_id,
        'gender' => $gender,
        'role' => $role,
    ];

    // ตรวจสอบว่า email ซ้ำหรือไม่
    $check_stmt = $conn->prepare("SELECT user_id FROM user_tb WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Email ซ้ำ – redirect กลับพร้อม error query string
        $query = buildQuery($formData);
        header("Location: register.php?email_error=1&$query");
        exit();
    }

    // ถ้าไม่ซ้ำ ทำการเพิ่มข้อมูล
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user_tb (username, email, password, tel, line_id, gender, role) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssssss", $username, $email, $password_hashed, $tel, $line_id, $gender, $role);

        if ($stmt->execute()) {
            // สมัครสมาชิกสำเร็จ ส่งพารามิเตอร์ success=1 พร้อมข้อมูลกลับไปด้วย (ถ้าต้องการ)
            // แต่โดยปกติถ้าสำเร็จ มัก redirect ไปหน้าอื่น เช่น login.php หรือ welcome page
            // ตัวอย่างส่งกลับพร้อม success=1 และข้อมูลฟอร์ม (ถ้าอยากเก็บไว้)
            $query = buildQuery($formData);
            header("Location: register.php?success=1&$query");
            exit();
        }

        $stmt->close();
    }

    // fallback หาก insert ไม่สำเร็จ ส่งกลับพร้อม error=insert_fail
    $query = buildQuery($formData);
    header("Location: register.php?error=insert_fail&$query");
    exit();
} else {
    header("Location: register.php");
    exit();
}
