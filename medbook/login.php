  <!DOCTYPE html>
  <html lang="th">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>เข้าสู่ระบบ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/font.css">
  </head>

  <body class="min-h-screen flex items-center justify-center bg-gray-100 px-4 ">
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row transition-all duration-300 my-4">

      <div class="w-full md:w-1/2 h-[40vh] md:h-auto">
        <img src="https://images.pexels.com/photos/12585206/pexels-photo-12585206.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
          alt="Login Image"
          class="h-full w-full object-cover" />
      </div>

      <div class="w-full md:w-1/2 p-8 md:p-12 flex items-center">
        <div class="w-full">
          <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">เข้าสู่ระบบ</h2>

          <form action="login_process.php" method="POST" class="space-y-5">
            <div>
              <label for="email" class="block text-gray-700 font-medium">อีเมล</label>
              <input
                type="text"
                id="email"
                name="email"
                required
                placeholder="กรอกอีเมลของคุณ"
                class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div>
              <label for="password" class="block text-gray-700 font-medium">รหัสผ่าน</label>
              <input
                type="password"
                id="password"
                name="password"
                required
                placeholder="กรอกรหัสผ่านของคุณ"
                class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
              <div class="text-right mt-1">
                <a href="#" class="text-sm text-blue-600 hover:underline">ลืมรหัสผ่าน?</a>
              </div>
            </div>

            <button
              type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
              เข้าสู่ระบบ
            </button>
          </form>

          <p class="mt-6 text-center text-sm text-gray-500">
            ยังไม่มีบัญชี? <a href="register.php" class="text-blue-600 hover:underline">สมัครสมาชิก</a>
          </p>
        </div>
      </div>
    </div>



  <?php if (isset($_GET['error']) || isset($_GET['success'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      <?php if (isset($_GET['error'])): ?>
        let error = "<?php echo htmlspecialchars($_GET['error']); ?>";
        let title = 'เกิดข้อผิดพลาด';
        let text = '';

        if (error === 'invalid_password') {
          text = 'รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง';
        } else if (error === 'user_not_found') {
          text = 'ไม่พบผู้ใช้งาน กรุณาตรวจสอบอีเมลอีกครั้ง';
        } else {
          text = 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง';
        }

        Swal.fire({
          icon: 'error',
          title: title,
          text: text,
          confirmButtonText: 'ตกลง',
          confirmButtonColor: '#2664eb'
        });
      <?php elseif (isset($_GET['success'])): ?>
        Swal.fire({
          icon: 'success',
          title: 'เข้าสู่ระบบสำเร็จ',
          text: 'กำลังพาคุณไปยังหน้าหลัก...',
          timer: 2000,
          timerProgressBar: true,
          showConfirmButton: false
        }).then(() => {
          window.location.href = 'index.php';
        });
      <?php endif; ?>
    });
  </script>
  <?php endif; ?>

  </body>

  </html>