<?php
include('../database/db.php');
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MedBook</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/font.css">
    <link rel="icon" href="../image/logo.ico">

</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 px-4 ">
  <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row transition-all duration-300 my-4">
    
    <div class="w-full md:w-1/2 h-[40vh] md:h-auto">
      <img src="https://images.pexels.com/photos/12585206/pexels-photo-12585206.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
           alt="Login Image"
           class="h-full w-full object-cover"/>
    </div>

    <div class="w-full md:w-1/2 p-8 md:p-12 flex items-center">
      <div class="w-full">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">เข้าสู่ระบบ</h2>

        <form action="login_process.php" method="POST" class="space-y-5">
          <div>
            <label for="email" class="block text-gray-700 font-medium">ชื่ออีเมล</label>
            <input
              type="text"
              id="email"
              name="email"
              required
              placeholder="กรอกชื่ออีเมลของคุณ"
              class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            />
          </div>

          <div>
            <label for="password" class="block text-gray-700 font-medium">รหัสผ่าน</label>
            <input
              type="password"
              id="password"
              name="password"
              required
              placeholder="กรอกรหัสผ่านของคุณ"
              class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            />
            <div class="text-right mt-1">
              <a href="#" class="text-sm text-blue-600 hover:underline">ลืมรหัสผ่าน?</a>
            </div>
          </div>

          <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition"
          >
            เข้าสู่ระบบ
          </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
          ยังไม่มีบัญชี? <a href="register.php" class="text-blue-600 hover:underline">สมัครสมาชิก</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
