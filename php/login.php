<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เข้าสู่ระบบ</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <form class="bg-white p-8 rounded shadow-md w-full max-w-md" action="login_process.php" method="POST">
    <h2 class="text-2xl font-bold mb-6 text-center">เข้าสู่ระบบ</h2>

    <label class="block mb-2">อีเมล</label>
    <input type="email" name="email" required class="w-full px-4 py-2 mb-4 border rounded"/>

    <label class="block mb-2">รหัสผ่าน</label>
    <input type="password" name="password" required class="w-full px-4 py-2 mb-4 border rounded"/>

    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
      เข้าสู่ระบบ
    </button>

    <p class="mt-4 text-center text-sm">
      ยังไม่มีบัญชี? <a href="register.php" class="text-blue-600 underline">สมัครสมาชิก</a>
    </p>
  </form>

</body>
</html>
