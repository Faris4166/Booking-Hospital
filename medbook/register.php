<?php
include('../database/db.php');

// อ่านสถานะจาก query string
$emailError = isset($_GET['email_error']);
$success = isset($_GET['success']);
$insertFail = isset($_GET['error']) && $_GET['error'] === 'insert_fail';

// ฟังก์ชันช่วยรับค่าจาก query string แล้ว escape
function old($key)
{
  return isset($_GET[$key]) ? htmlspecialchars($_GET[$key]) : '';
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MedBook</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- เพิ่ม SweetAlert2 -->
  <link rel="stylesheet" href="../css/font.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="icon" href="../image/logo.ico">
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
  <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8 my-4">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">สมัครสมาชิก</h2>

    <form id="registerForm" action="insert_user.php" method="POST" class="space-y-5">
      <div>
        <label for="username" class="block text-gray-700 font-medium">ชื่อผู้ใช้</label>
        <input type="text" id="username" name="username" required placeholder="กรอกชื่อผู้ใช้"
          value="<?= old('username') ?>"
          class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none">
      </div>

      <div>
        <label for="email" class="block font-medium <?= $emailError ? 'text-red-600' : 'text-gray-700'; ?>">
          อีเมล
        </label>
        <input
          type="email"
          id="email"
          name="email"
          value="<?= old('email') ?>"
          required
          placeholder="<?= $emailError ? 'อีเมลนี้มีผู้ใช้แล้ว' : 'กรอกอีเมล'; ?>"
          class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none 
            <?= $emailError ? 'border-red-600 placeholder-red-400' : 'border-gray-300'; ?>">
      </div>

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
          <input type="password" id="confirmPassword" required placeholder="กรอกยืนยันรหัสผ่าน"
            class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none pr-10">
          <span class="material-icons absolute inset-y-0 right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500"
            onclick="togglePassword('confirmPassword', this)">visibility</span>
        </div>
      </div>

      <!-- ... ส่วนอื่นๆ เติมค่าจาก query string เช่นกัน ... -->

      <div>
        <label for="tel" class="block text-gray-700 font-medium">เบอร์โทร</label>
        <input type="tel" id="tel" name="tel" required placeholder="กรอกเบอร์โทร"
          value="<?= old('tel') ?>"
          class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none">
      </div>

      <div>
        <label for="LINE_ID" class="block text-gray-700 font-medium">LINE ID</label>
        <input type="text" id="LINE_ID" name="LINE_ID" required placeholder="กรอก LINE ID"
          value="<?= old('line_id') ?>"
          class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none">
      </div>

      <div>
        <label class="block text-gray-700 font-medium">เพศ</label>
        <select name="gender" required
          class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2">
          <option value="">-- เลือกเพศ --</option>
          <option value="Male" <?= old('gender') === 'Male' ? 'selected' : '' ?>>ชาย</option>
          <option value="Female" <?= old('gender') === 'Female' ? 'selected' : '' ?>>หญิง</option>
          <option value="Other" <?= old('gender') === 'Other' ? 'selected' : '' ?>>อื่น ๆ</option>
        </select>
      </div>

      <div>
        <label class="block text-gray-700 font-medium">สถานะ</label>
        <select name="role" required
          class="w-full mt-1 border border-gray-300 rounded-lg px-4 py-2">
          <option value="">-- เลือกสถานะ --</option>
          <option value="user" <?= old('role') === 'user' ? 'selected' : '' ?>>นักศึกษา</option>
          <option value="academic" <?= old('role') === 'academic' ? 'selected' : '' ?>>นักวิชาการ</option>
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
    // ฟังก์ชันแจ้งเตือน SweetAlert
    document.addEventListener("DOMContentLoaded", () => {
      <?php if ($emailError): ?>
        Swal.fire({
          icon: 'error',
          title: 'อีเมลนี้มีผู้ใช้แล้ว',
          text: 'กรุณาใช้ Email อื่นในการสมัคร',
          confirmButtonColor: '#2664eb',
        });
      <?php elseif ($success): ?>
        Swal.fire({
          icon: 'success',
          title: 'สมัครสมาชิกสำเร็จ',
          text: 'คุณสามารถเข้าสู่ระบบได้เลย',
          confirmButtonColor: '#2664eb',
        }).then(() => {
          // พอผู้ใช้กด OK ให้ไปหน้า login.php
          window.location.href = 'login.php';
        });
      <?php elseif ($insertFail): ?>
        Swal.fire({
          icon: 'error',
          title: 'เกิดข้อผิดพลาด',
          text: 'ไม่สามารถสมัครสมาชิกได้ กรุณาลองใหม่อีกครั้ง',
          confirmButtonColor: '#2664eb',
        });
      <?php endif; ?>

      // ฟังก์ชัน toggle password visibility
      window.togglePassword = function(id, icon) {
        const input = document.getElementById(id);
        if (input.type === "password") {
          input.type = "text";
          icon.textContent = "visibility_off";
        } else {
          input.type = "password";
          icon.textContent = "visibility";
        }
      }
    });
  </script>

  <!-- รหัส JS ตรวจสอบรหัสผ่าน (เดิม) -->
  <script>
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");

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

    password.addEventListener("input", validatePassword);
    confirmPassword.addEventListener("input", validatePassword);
  </script>
</body>

</html>