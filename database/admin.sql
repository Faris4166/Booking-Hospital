CREATE DATABASE IF NOT EXISTS admin_system;
USE admin_system;

-- ตารางเก็บสถิติผู้เข้าชม
CREATE TABLE IF NOT EXISTS visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45),
    visit_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ตารางจองห้อง
CREATE TABLE IF NOT EXISTS room_reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_name VARCHAR(100),
    reserver_name VARCHAR(100),
    date_reserved DATE,
    time_reserved TIME,
    purpose TEXT
);

-- รายชื่อผู้ใช้ในระบบ
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    username VARCHAR(50) UNIQUE,
    role VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- เพิ่มผู้ใช้จำลอง
INSERT INTO users (name, username, role) VALUES
('สิรายุ เพชรานนท์', 'admin001', 'ผู้ดูแล'),
('ฟาริส อาธาน', 'user002', 'เจ้าหน้าที่'),
('ณัฐพล ทองย้อย', 'user003', 'บุคลากร');
