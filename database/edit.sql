CREATE TABLE IF NOT EXISTS room_reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_name VARCHAR(100) NOT NULL,
    reserver_name VARCHAR(100) NOT NULL,
    date_reserved DATE NOT NULL,
    time_reserved TIME NOT NULL,
    purpose TEXT
);

INSERT INTO room_reservations (room_name, reserver_name, date_reserved, time_reserved, purpose) VALUES
('ห้องประชุม A', 'นายทานุฑัต ทิพย์เสภา', '2025-05-23', '09:00:00', 'ประชุมชมรมวิชาชีพ'),
('ห้องคอมพิวเตอร์ 2', 'นางสาวณัฐชยา ดรุณวรรณ', '2025-05-24', '13:30:00', 'จัดกิจกรรมอบรม Excel'),
('ห้องประชุม B', 'นายสิรายุ เพชรานนท์', '2025-05-25', '10:00:00', 'วางแผนกิจกรรมวันวิชาการ');
