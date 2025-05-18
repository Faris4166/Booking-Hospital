<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สมัครสมาชิก</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <form class="bg-white p-8 rounded shadow-md w-full max-w-md" onsubmit="return validateForm()" method="POST" action="register_process.php">
    <h2 class="text-2xl font-bold mb-6 text-center">สมัครสมาชิก</h2>

    <label class="block mb-2">ชื่อ</label>
    <input type="text" name="name" required class="w-full px-4 py-2 mb-4 border rounded"/>

    <label class="block mb-2">อีเมล</label>
    <input type="email" name="email" required class="w-full px-4 py-2 mb-4 border rounded"/>

    <label class="block mb-2">รหัสผ่าน</label>
    <input type="password" id="password" name="password" required class="w-full px-4 py-2 mb-4 border rounded"/>

    <p id="passwordError" class="text-red-600 text-sm hidden mb-4">รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร</p>

    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
      สมัครสมาชิก
    </button>

    <p class="mt-4 text-center text-sm text-yellow-600">
      หลังสมัคร โปรดรอผู้ดูแลระบบยืนยันภายใน 24 ชั่วโมง
    </p>
  </form>

  <script>
    function validateForm() {
      const password = document.getElementById('password').value;
      const error = document.getElementById('passwordError');
      if (password.length < 8) {
        error.classList.remove('hidden');
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
