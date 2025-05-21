<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>สมัครสมาชิก</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/font.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="icon" href="../image/logo.ico">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
  <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8 my-4">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">สมัครสมาชิก</h2>
    
    <form id="registerForm" class="space-y-5">
      <div>
        <label for="username" class="block text-gray-700 font-medium">ชื่อผู้ใช้</label>
        <input type="text" id="username" name="username" required placeholder="กรอกชื่อผู้ใช้"
               class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-gray-700 font-medium">อีเมล</label>
        <input type="email" id="email" name="email" required placeholder="กรอกอีเมล"
               class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-gray-700 font-medium">รหัสผ่าน</label>
        <div class="relative">
          <input type="password" id="password" name="password" required placeholder="กรอกรหัสผ่าน"
                 class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none pr-10">
          <span class="material-icons absolute inset-y-0 right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500"
                onclick="togglePassword('password', this)">visibility</span>
        </div>
      </div>

      <div>
        <label for="confirmPassword" class="block text-gray-700 font-medium">ยืนยันรหัสผ่าน</label>
        <div class="relative">
          <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="กรอกยืนยันรหัสผ่าน"
                 class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none pr-10">
          <span class="material-icons absolute inset-y-0 right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500"
                onclick="togglePassword('confirmPassword', this)">visibility</span>
        </div>
      </div>

      <div class="text-sm text-gray-600 space-y-1">
        <p id="length"><span class="material-icons align-middle mr-1">cancel</span> ความยาวอย่างน้อย 8 ตัว</p>
        <p id="uppercase"><span class="material-icons align-middle mr-1">cancel</span> ตัวพิมพ์ใหญ่ ≥ 1 ตัว</p>
        <p id="lowercase"><span class="material-icons align-middle mr-1">cancel</span> ตัวพิมพ์เล็ก ≥ 1 ตัว</p>
        <p id="number"><span class="material-icons align-middle mr-1">cancel</span> ตัวเลข ≥ 1 ตัว</p>
        <p id="special"><span class="material-icons align-middle mr-1">cancel</span> สัญลักษณ์พิเศษ ≥ 1 ตัว</p>
        <p id="match"><span class="material-icons align-middle mr-1">cancel</span> รหัสผ่านตรงกัน</p>
      </div>

      <div>
        <label for="tel" class="block text-gray-700 font-medium">เบอร์โทร</label>
        <input type="tel" id="tel" name="tel" required placeholder="กรอกเบอร์โทร"
               class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none">
      </div>

      <div>
        <label for="LINE ID" class="block text-gray-700 font-medium">LINE ID</label>
        <input type="LINE ID" id="LINE ID" name="LINE ID" required placeholder="กรอก LINE ID"
               class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none">
      </div>

      <div>
        <label class="block text-gray-700 font-medium">เพศ</label>
        <select name="gender" required
                class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2">
          <option value="">-- เลือกเพศ --</option>
          <option value="male">ชาย</option>
          <option value="female">หญิง</option>
          <option value="other">อื่น ๆ</option>
        </select>
      </div>

      <div>
        <label class="block text-gray-700 font-medium">สถานะ</label>
        <select name="role" required
                class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2">
          <option value="">-- เลือกสถานะ --</option>
          <option value="student">นักศึกษา</option>
          <option value="teacher">ครู</option>
        </select>
      </div>

      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
        สมัครสมาชิก
      </button>

      <p class="mt-6 text-center text-sm text-gray-500">
        มีบัญชีใช่มั้ย? <a href="login.php" class="text-blue-600 hover:underline">เข้าสู่ระบบ</a>
      </p>
    </form>
  </div>

  <script>
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const registerForm = document.getElementById("registerForm");

    const conditions = {
      length: document.getElementById("length"),
      uppercase: document.getElementById("uppercase"),
      lowercase: document.getElementById("lowercase"),
      number: document.getElementById("number"),
      special: document.getElementById("special"),
      match: document.getElementById("match")
    };

    function updateCondition(el, passed) {
      const icon = el.querySelector(".material-icons");
      icon.textContent = passed ? "check_circle" : "cancel";
      icon.className = passed ? "material-icons text-green-600 align-middle mr-1" : "material-icons text-red-600 align-middle mr-1";
      el.className = passed ? "text-green-600" : "text-red-600";
    }

    function validatePassword() {
      const pass = password.value;
      const confirm = confirmPassword.value;

      updateCondition(conditions.length, pass.length >= 8);
      updateCondition(conditions.uppercase, /[A-Z]/.test(pass));
      updateCondition(conditions.lowercase, /[a-z]/.test(pass));
      updateCondition(conditions.number, /\d/.test(pass));
      updateCondition(conditions.special, /[!@#$%^&*(),.?":{}|<>]/.test(pass));
      updateCondition(conditions.match, pass && pass === confirm);
    }

    function togglePassword(id, icon) {
      const input = document.getElementById(id);
      if (input.type === "password") {
        input.type = "text";
        icon.textContent = "visibility_off";
      } else {
        input.type = "password";
        icon.textContent = "visibility";
      }
    }

    password.addEventListener("input", validatePassword);
    confirmPassword.addEventListener("input", validatePassword);

    registerForm.addEventListener("submit", function(e) {
      e.preventDefault();
      alert("กรุณารอเจ้าหน้าที่ในการยืนยันสิทธิ์");
      window.location.href = "login.php";
    });
  </script>
</body>
</html>
