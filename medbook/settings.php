<?php include 'navbar.php'; ?>
<?php
// สมมติว่านี่คือข้อมูลผู้ใช้ที่ดึงมาจากฐานข้อมูล
// ในการใช้งานจริง คุณจะต้องดึงข้อมูลเหล่านี้จาก session หรือ database
$user = [
    'username' => 'สมชัย ใจดี',
    'email' => 'somchai.j@example.com',
    'role' => 'ผู้จัดการ', // หรือ 'สมาชิก', 'ผู้ใช้งานทั่วไป'
    'phone' => '081-234-5678',
    'line_id' => '@somchai_line',
    'gender' => 'male', // 'male', 'female', 'other'
];

// ข้อความสวัสดี
$greeting = "สวัสดี, " . htmlspecialchars($user['username']) . "!";

// สมมติว่ามีการประมวลผลข้อมูลฟอร์มที่ส่งมา (สำหรับการใช้งานจริง)
$statusMessage = '';
$statusType = ''; // 'success' or 'error'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ในส่วนนี้คุณจะประมวลผลข้อมูลที่ส่งมาจากฟอร์ม
    // ตัวอย่างการประมวลผล (คุณต้องเพิ่มโค้ดการบันทึกจริงลงฐานข้อมูล)
    // For demonstration purposes, we'll just show a success message
    $user['username'] = $_POST['username'] ?? $user['username'];
    $user['email'] = $_POST['email'] ?? $user['email'];
    // รหัสผ่านควรถูกแฮชก่อนบันทึก
    if (!empty($_POST['password'])) {
        // $user['password_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    $user['phone'] = $_POST['phone'] ?? $user['phone'];
    $user['line_id'] = $_POST['line_id'] ?? $user['line_id'];
    $user['gender'] = $_POST['gender'] ?? $user['gender'];

    $statusMessage = 'บันทึกข้อมูลสำเร็จแล้ว!';
    $statusType = 'success';
    // ในการใช้งานจริง: header('Location: settings.php?status=success'); exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าบัญชีของคุณ</title>
    <link rel="stylesheet" href="../css/font.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5', // Indigo-600
                        secondary: '#8B5CF6', // Violet-500
                        accent: '#EC4899', // Pink-500
                        light: '#F8FAFC', // Slate-50
                        dark: '#1E293B', // Slate-800
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom styles for better focus and aesthetics */
        .form-input {
            @apply block w-full px-4 py-2 text-gray-800 bg-white border border-gray-300 rounded-md shadow-sm
                   focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent;
        }
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-1;
        }
    </style>
</head>
<body class="pt-10 sm:pt-10 sm:ml-64 mt-10">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full space-y-8 bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900">การตั้งค่าบัญชี</h1>
                <p class="mt-2 text-lg text-gray-600"><?= $greeting; ?></p>
            </div>

            <?php if ($statusMessage): ?>
                <div class="p-3 rounded-md
                    <?php echo ($statusType == 'success') ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'; ?>
                    text-center text-sm font-medium">
                    <?= htmlspecialchars($statusMessage); ?>
                </div>
            <?php endif; ?>

            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-lg shadow-md text-white mb-8">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-16 w-16 rounded-full bg-blue-400 flex items-center justify-center text-3xl font-bold text-white shadow-inner">
                            <img src="../image/TheLegendsChickenJorkey.jpg" alt="">
                        </div>
                    </div>
                    <div>
                        <p class="text-2xl font-bold"><?= htmlspecialchars($user['username']); ?></p>
                        <p class="text-lg font-light opacity-90"><?= htmlspecialchars($user['role']); ?></p>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">อัปเดตข้อมูลส่วนตัว</h2>

            <form action="" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="username" class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" class="form-input" placeholder="ชื่อผู้ใช้ของคุณ" required>
                    </div>

                    <div>
                        <label for="email" class="form-label">อีเมล</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="form-input" placeholder="your@example.com" required>
                    </div>

                    <div>
                        <label for="password" class="form-label">รหัสผ่าน (เว้นว่างไว้หากไม่ต้องการเปลี่ยน)</label>
                        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••">
                        <p class="mt-1 text-xs text-gray-500">กรอกรหัสผ่านใหม่หากต้องการเปลี่ยน</p>
                    </div>

                    <div>
                        <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']); ?>" class="form-input" placeholder="08XXXXXXXX">
                    </div>

                    <div>
                        <label for="line_id" class="form-label">LINE ID</label>
                        <input type="text" id="line_id" name="line_id" value="<?= htmlspecialchars($user['line_id']); ?>" class="form-input" placeholder="@your_line_id">
                    </div>

                    <div>
                        <label for="gender" class="form-label">เพศ</label>
                        <select id="gender" name="gender" class="form-input">
                            <option value="male" <?= ($user['gender'] == 'male') ? 'selected' : ''; ?>>ชาย</option>
                            <option value="female" <?= ($user['gender'] == 'female') ? 'selected' : ''; ?>>หญิง</option>
                            <option value="other" <?= ($user['gender'] == 'other') ? 'selected' : ''; ?>>อื่น ๆ</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-300 ease-in-out">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-5 0V5a2 2 0 012-2h2a2 2 0 012 2v2M5 10h14m-7 4v4m0 0l-2-2m2 2l2-2"></path></svg>
                        บันทึกการเปลี่ยนแปลง
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>