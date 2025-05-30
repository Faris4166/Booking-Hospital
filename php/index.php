<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>หน้าหลัก</title>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Kanit', sans-serif;
    }
    /* ซ่อน scrollbar */
    div::-webkit-scrollbar {
      display: none;
    }
  </style>
</head>

<body class="bg-white min-h-screen flex items-start justify-center p-4 font-kanit">

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-6xl relative">
    <!-- ปฏิทิน -->
    <div class="w-full border border-gray-300 rounded-lg p-4 bg-white">
      <div id="calendar">
        <div class="flex items-center justify-between bg-[#f0f7f2] p-3 rounded">
          <button id="prevBtn" class="text-[#31a35f] text-xl select-none">&lt;</button>
          <h2 id="monthYear" class="text-[#31a35f] font-semibold text-lg"></h2>
          <button id="nextBtn" class="text-[#31a35f] text-xl select-none">&gt;</button>
        </div>
        <div class="grid grid-cols-7 text-center mt-4 text-gray-500 font-medium select-none">
          <div class="text-red-500">อา</div>
          <div>จ</div>
          <div>อ</div>
          <div>พ</div>
          <div>พฤ</div>
          <div>ศ</div>
          <div class="text-red-500">ส</div>
        </div>
        <div id="calendarDays" class="grid grid-cols-7 text-center mt-2 gap-1"></div>
      </div>
    </div>

    <!-- กล่องปุ่มจองคิว -->
    <div
      class="w-full border border-gray-300 rounded-lg p-4 bg-white flex flex-col justify-center items-center min-h-[400px] relative">

      <!-- ปุ่มจองคิว ใช้ fixed กึ่งกลางล่าง -->
      <div
  class="fixed bottom-5 left-1/2 transform -translate-x-1/2 w-14 h-14 bg-white border-2 border-black rounded-full flex items-center justify-center cursor-pointer select-none hover:bg-gray-100"
  title="จองคิว" onclick="openModal()">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
    class="w-8 h-8 stroke-black" stroke-width="2">
    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
  </svg>
</div>


    </div>
  </div>

  <!-- Modal ฟอร์มจอง -->
  <div id="modalForm"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center hidden p-4 overflow-auto">
    <div
      class="bg-white w-full max-w-2xl rounded-3xl shadow-xl p-8 space-y-4 border relative max-h-[80vh] overflow-y-auto font-kanit mt-8 md:mt-15">
      <button onclick="closeModal()" class="absolute top-2 right-4 text-gray-500 text-3xl font-bold select-none">&times;</button>

      <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center text-blue-600">ฟอร์มเพิ่มรายการจอง</h2>
      <form action="#" method="POST" class="space-y-4">

        <div>
          <label for="roomName" class="block text-sm font-medium text-gray-700">ชื่อห้อง</label>
          <input type="text" id="roomName" name="roomName" required
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
          <label for="topic" class="block text-sm font-medium text-gray-700">หัวข้อ</label>
          <input type="text" id="topic" name="topic" required
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
          <label for="attendees" class="block text-sm font-medium text-gray-700">จำนวนผู้เข้าร่วม</label>
          <input type="number" id="attendees" name="attendees" required min="0"
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">ชื่อผู้จอง</label>
          <input type="text" id="username" name="username" required
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
          <div class="w-full">
            <label for="startDate" class="block text-sm font-medium text-gray-700">วันที่เริ่ม</label>
            <input type="text" id="startDate" name="startDate" required
              class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
          <div class="w-full">
            <label for="endDate" class="block text-sm font-medium text-gray-700">วันที่สิ้นสุด</label>
            <input type="text" id="endDate" name="endDate" required
              class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="startTime" class="block text-sm font-medium text-gray-700">เวลาเริ่ม</label>
            <input type="text" id="startTime" name="startTime" required
              class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
          <div>
            <label for="endTime" class="block text-sm font-medium text-gray-700">เวลาสิ้นสุด</label>
            <input type="text" id="endTime" name="endTime" required
              class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
        </div>

        <div>
          <label for="notes" class="block text-sm font-medium text-gray-700">หมายเหตุเพิ่มเติม</label>
          <textarea id="notes" name="notes" rows="3"
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div>
          <button type="submit"
            class="w-full bg-blue-600 text-white text-base sm:text-lg py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            ยืนยันการจอง
          </button>
        </div>

      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>
  <script>
    const calendarDays = document.getElementById("calendarDays");
    const monthYear = document.getElementById("monthYear");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const modal = document.getElementById("modalForm");

    function openModal() {
      modal.classList.remove("hidden");
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
        allowInput: true
      });
      flatpickr("#endTime", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        allowInput: true
      });
    }

    function closeModal() {
      modal.classList.add("hidden");
    }

    const thaiMonths = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
    let currentDate = dayjs();
    let selectedDayDiv = null;

    function renderCalendar() {
      const today = dayjs().startOf('day');
      const startOfMonth = currentDate.startOf("month");
      const endOfMonth = currentDate.endOf("month");
      const startDay = startOfMonth.day();
      const totalDays = endOfMonth.date();
      const prevMonth = currentDate.subtract(1, 'month');
      const endOfPrevMonth = prevMonth.endOf('month');
      const totalPrevDays = endOfPrevMonth.date();
      const totalCells = 42;
      monthYear.textContent = `${thaiMonths[currentDate.month()]} ${currentDate.year()}`;
      calendarDays.innerHTML = "";

      // แสดงวันเดือนก่อนหน้า
      for (let i = startDay - 1; i >= 0; i--) {
        const div = document.createElement("div");
        div.textContent = totalPrevDays - i;
        div.classList.add("text-gray-400", "cursor-default", "h-16", "flex", "justify-center", "items-start", "pt-2", "font-medium", "rounded", "border-2", "border-transparent", "select-none");
        calendarDays.appendChild(div);
      }

      // แสดงวันในเดือนปัจจุบัน
      for (let day = 1; day <= totalDays; day++) {
        const div = document.createElement("div");
        div.textContent = day;
        div.classList.add("h-16", "flex", "justify-center", "items-start", "pt-2", "font-medium", "rounded", "border-2", "border-transparent", "cursor-pointer", "select-none", "bg-white");

        const dateObj = currentDate.date(day).startOf('day');
        if (day === today.date() && currentDate.month() === today.month() && currentDate.year() === today.year()) {
          div.classList.add("border-black");
        }
        if (dateObj.day() === 0) div.classList.add("text-red-500");
        if (dateObj.day() === 6) div.classList.add("text-red-500");

        div.addEventListener("mouseenter", () => {
          if (!div.classList.contains("selected")) div.classList.add("border-gray-300");
        });
        div.addEventListener("mouseleave", () => {
          if (!div.classList.contains("selected")) div.classList.remove("border-gray-300");
        });

        div.addEventListener("click", () => {
          if (selectedDayDiv) {
            selectedDayDiv.classList.remove("selected", "border-blue-500");
            selectedDayDiv.classList.add("border-transparent");
          }
          div.classList.add("selected", "border-blue-500");
          div.classList.remove("border-transparent");
          selectedDayDiv = div;
          alert(`คุณเลือกวันที่ ${day} ${thaiMonths[currentDate.month()]} ${currentDate.year()}`);
        });

        calendarDays.appendChild(div);
      }

      // เติมช่องว่างให้ครบ 42 ช่อง (6 สัปดาห์)
      const remainingCells = totalCells - (startDay + totalDays);
      for (let i = 1; i <= remainingCells; i++) {
        const div = document.createElement("div");
        div.textContent = i;
        div.classList.add("text-gray-400", "cursor-default", "h-16", "flex", "justify-center", "items-start", "pt-2", "font-medium", "rounded", "border-2", "border-transparent", "select-none");
        calendarDays.appendChild(div);
      }
    }

    prevBtn.addEventListener("click", () => {
      currentDate = currentDate.subtract(1, 'month');
      renderCalendar();
    });

    nextBtn.addEventListener("click", () => {
      currentDate = currentDate.add(1, 'month');
      renderCalendar();
    });

    renderCalendar();
  </script>
</body>

</html>
