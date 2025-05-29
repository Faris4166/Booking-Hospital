<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
  <title>MedBook</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/font.css">
  <link rel="icon" href="../image/logo.ico">

  <!-- ✅ Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- ✅ Flatpickr ภาษาไทย -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
  <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md w-full max-w-xl">
    <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center text-blue-600">ฟอร์มจองห้องพัก</h2>
    <form action="#" method="POST" class="space-y-4">

      <!-- ชื่อ-นามสกุล -->
      <div>
        <label for="fullName" class="block text-sm font-medium text-gray-700">ชื่อ-นามสกุล</label>
        <input type="text" id="fullName" name="fullName" required
          class="mt-1 block w-full max-w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- เบอร์โทรศัพท์ -->
      <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์</label>
        <input type="tel" id="phone" name="phone" required
          class="mt-1 block w-full max-w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- หัวข้อ -->
      <div>
        <label for="text" class="block text-sm font-medium text-gray-700">หัวข้อ</label>
        <input type="text" id="text" name="text" required
          class="mt-1 block w-full max-w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- ✅ ช่วงวันที่ -->
      <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
        <div class="w-full">
          <label for="startDate" class="block text-sm font-medium text-gray-700">วันที่เริ่ม</label>
          <input type="text" id="startDate" name="startDate" required
            class="mt-1 block w-full max-w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="เลือกวันที่เริ่ม" />
        </div>
        <div class="w-full">
          <label for="endDate" class="block text-sm font-medium text-gray-700">วันที่สิ้นสุด</label>
          <input type="text" id="endDate" name="endDate" required
            class="mt-1 block w-full max-w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="เลือกวันที่สิ้นสุด" />
        </div>
      </div>

      <!-- ช่วงเวลา -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="startTime" class="block text-sm font-medium text-gray-700">เวลาเริ่ม</label>
          <input type="text" id="startTime" name="startTime" placeholder="เลือกเวลาเริ่ม" required
            class="mt-1 block w-full max-w-full rounded-md border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500" />
        </div>
        <div>
          <label for="endTime" class="block text-sm font-medium text-gray-700">เวลาสิ้นสุด</label>
          <input type="text" id="endTime" name="endTime" placeholder="เลือกเวลาสิ้นสุด" required
            class="mt-1 block w-full max-w-full rounded-md border border-gray-300 p-2 focus:ring-2 focus:ring-indigo-500" />
        </div>
      </div>

      <!-- หมายเหตุ -->
      <div>
        <label for="notes" class="block text-sm font-medium text-gray-700">หมายเหตุเพิ่มเติม</label>
        <textarea id="notes" name="notes" rows="3"
          class="mt-1 block w-full max-w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- ปุ่มยืนยัน -->
      <div>
        <button type="submit"
          class="w-full bg-blue-600 text-white text-base sm:text-lg py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
          ยืนยันการจอง
        </button>
      </div>

    </form>
  </div>

  <!-- ✅ Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr("#startDate", {
      dateFormat: "d/m/Y",
      locale: "th",
      allowInput: true
    });

    flatpickr("#endDate", {
      dateFormat: "d/m/Y",
      locale: "th",
      allowInput: true
    });

    flatpickr("#startTime", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: true,
      locale: "th"
    });

    flatpickr("#endTime", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: true,
      locale: "th"
    });
  </script>
</body>

</html>
