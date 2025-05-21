<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Alert Cards with Tailwind</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/font.css"
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-6 space-y-6">

  <!-- ปุ่มเรียก Alert -->
  <div class="space-x-2">
    <button onclick="showAlert('success')" class="px-4 py-2 bg-teal-500 text-white rounded hover:bg-teal-600">สำเร็จ</button>
    <button onclick="showAlert('warning')" class="px-4 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500">คำเตือน</button>
    <button onclick="showAlert('error')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">ผิดพลาด</button>
    <button onclick="showAlert('info')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">ข้อมูล</button>
    <button onclick="showAlert('security')" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">ความปลอดภัย</button>
  </div>

  <!-- กล่อง Alerts -->
  <div id="alertContainer" class="space-y-4 w-full max-w-xl"></div>

  <script>
    function showAlert(type) {
      const container = document.getElementById("alertContainer");
      let alertHTML = "";

      const baseClass = "transition transform duration-300 ease-out scale-95 opacity-0 animate-popup";
      const popupClass = "scale-100 opacity-100";

      switch (type) {
        case "success":
          alertHTML = `
          <div class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4 ${baseClass}">
            <div class="flex">
              <div class="shrink-0">
                <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800">
                  <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m9 12 2 2 4-4" />
                  </svg>
                </span>
              </div>
              <div class="ms-3">
                <h3 class="text-gray-800 font-semibold">สำเร็จ</h3>
                <p class="text-sm text-gray-700">คุณได้ทำรายการเรียบร้อยแล้ว</p>
              </div>
            </div>
          </div>`;
          break;

        case "warning":
  alertHTML = `
  <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-lg p-4 ${baseClass}">
    <div class="flex">
      <div class="shrink-0">
        <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-yellow-100 bg-yellow-200 text-yellow-800">
          <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 9v4m0 4h.01" />
            <path d="M10.29 3.86L1.82 18a1 1 0 0 0 .86 1.5h18.64a1 1 0 0 0 .86-1.5L13.71 3.86a1 1 0 0 0-1.72 0z" />
          </svg>
        </span>
      </div>
      <div class="ms-3">
        <h3 class="text-gray-800 font-semibold">คำเตือน</h3>
        <p class="text-sm text-gray-700">โปรดตรวจสอบข้อมูลให้ถูกต้อง</p>
      </div>
    </div>
  </div>`;
  break;


        case "error":
          alertHTML = `
          <div class="bg-red-50 border-s-4 border-red-500 p-4 rounded-lg ${baseClass}">
            <div class="flex">
              <div class="shrink-0">
                <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800">
                  <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M18 6L6 18M6 6l12 12" />
                  </svg>
                </span>
              </div>
              <div class="ms-3">
                <h3 class="text-gray-800 font-semibold">เกิดข้อผิดพลาด</h3>
                <p class="text-sm text-gray-700">ไม่สามารถดำเนินการได้ กรุณาลองใหม่</p>
              </div>
            </div>
          </div>`;
          break;

        case "info":
  alertHTML = `
  <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg ${baseClass}">
    <div class="flex">
      <div class="shrink-0">
        <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-blue-100 bg-blue-200 text-blue-800">
          <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9.968 9.968 0 0112 15c2.21 0 4.245.714 5.879 1.904M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </span>
      </div>
      <div class="ms-3">
        <h3 class="text-gray-800 font-semibold">ข้อมูล</h3>
        <p class="text-sm text-gray-700">ระบบจะอัปเดตอัตโนมัติในทุกๆ 10 นาที</p>
      </div>
    </div>
  </div>`;
  break;



        case "security":
          alertHTML = `
          <div class="bg-indigo-50 border-s-4 border-indigo-500 p-4 rounded-lg ${baseClass}">
            <div class="flex">
              <div class="shrink-0">
                <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-indigo-100 bg-indigo-200 text-indigo-800">
                  <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 1l9 4v6c0 5-3.5 9.5-9 11-5.5-1.5-9-6-9-11V5l9-4z" />
                  </svg>
                </span>
              </div>
              <div class="ms-3">
                <h3 class="text-gray-800 font-semibold">ความปลอดภัย</h3>
                <p class="text-sm text-gray-700">คุณเข้าสู่ระบบจากอุปกรณ์ใหม่</p>
              </div>
            </div>
          </div>`;
          break;
      }

      const temp = document.createElement("div");
      temp.innerHTML = alertHTML.trim();
      const newAlert = temp.firstChild;
      container.appendChild(newAlert);

      setTimeout(() => {
        newAlert.classList.add("scale-100", "opacity-100");
        newAlert.classList.remove("scale-95", "opacity-0");
      }, 10);

      setTimeout(() => {
        newAlert.classList.remove("opacity-100");
        newAlert.classList.add("opacity-0");
        setTimeout(() => newAlert.remove(), 400);
      }, 4000);
    }
  </script>

  <style>
    @keyframes popup {
      0% {
        opacity: 0;
        transform: scale(0.95);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }
    .animate-popup {
      animation: popup 0.3s ease-out forwards;
    }
  </style>

</body>
</html>
