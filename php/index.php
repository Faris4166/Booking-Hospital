<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>หน้าหลัก</title>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Kanit', sans-serif;
    }

    #calendarDays>div {
      height: 65px;
      min-height: 65px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      font-weight: 500;
      user-select: none;
      border: 2px solid transparent;
      transition: border-color 0.3s ease;
      background-color: white;
      text-align: center;
      border-radius: 0.25rem;
      cursor: pointer;
      padding-top: 8px;
    }

    @media (max-width: 767px) {
      #calendarDays {
        gap: 0.125rem;
      }

      #calendarDays>div {
        height: 45px;
        min-height: 45px;
        font-size: 0.875rem;
      }

      #calendarDays>div.today {
        height: 45px !important;
        min-height: 45px !important;
      }
    }

    #calendarDays>div.saturday,
    #calendarDays>div.sunday {
      color: red;
    }

    #calendarDays>div:hover {
      border-color: #cbd5e0;
    }

    #calendarDays>div.other-month {
      color: #a0aec0;
      cursor: default;
    }

    #calendarDays>div.today {
      border: 2px solid black;
    }

    #calendarDays>div.selected {
      border-color: #cbd5e0 !important;
      background-color: white !important;
      color: inherit !important;
      font-weight: 500 !important;
      cursor: pointer;
    }

    .btn-add {
      position: absolute;
      bottom: 20px;
      right: 20px;
      width: 56px;
      height: 56px;
      background-color: white;
      border: 2px solid black;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      user-select: none;
    }

    .btn-add:hover {
      background-color: #f3f4f6;
    }

    .btn-add svg {
      width: 32px;
      height: 32px;
      stroke: black;
      stroke-width: 3;
    }
  </style>
</head>

<body class="bg-white min-h-screen flex items-start justify-center p-4">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-6xl">
    <div class="w-full border border-gray-300 rounded-lg p-4">
      <div id="calendar">
        <div class="flex items-center justify-between bg-[#f0f7f2] p-3 rounded">
          <button id="prevBtn" class="text-[#31a35f] text-xl">&lt;</button>
          <h2 id="monthYear" class="text-[#31a35f] font-semibold text-lg"></h2>
          <button id="nextBtn" class="text-[#31a35f] text-xl">&gt;</button>
        </div>
        <div class="grid grid-cols-7 text-center mt-4 text-gray-500 font-medium">
          <div class="sunday">อา</div>
          <div>จ</div>
          <div>อ</div>
          <div>พ</div>
          <div>พฤ</div>
          <div>ศ</div>
          <div class="saturday">ส</div>
        </div>
        <div id="calendarDays" class="grid grid-cols-7 text-center mt-2 gap-1"></div>
      </div>
    </div>

    <div class="w-full border border-gray-300 rounded-lg p-4 relative bg-white flex flex-col justify-center items-center min-h-[400px]">
      <div class="btn-add" title="จองคิว" onclick="openModal()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
    </div>
  </div>


  <!-- Modal ฟอร์มจอง (ไม่มี hover, focus ring ในช่องกรอก) -->
  <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden p-4 overflow-auto">
    <div class="bg-white w-full max-w-2xl rounded-3xl shadow-xl p-8 space-y-4 border relative"
      style="max-height: 80vh; overflow-y: auto;">
      <button onclick="closeModal()" class="absolute top-2 right-4 text-gray-500 text-3xl font-bold">&times;</button>
         <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center text-blue-600">ฟอร์มจองห้องพัก</h2>
      <form action="#" method="POST" class="space-y-4">

      <!-- ชื่อ-ห้อง -->
        <div>
          <label for="roomName" class="block text-sm font-medium text-gray-700">ชื่อห้อง</label>
          <input type="text" id="roomName" name="roomName" required
            class="mt-1 block w-full max-w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

      <!-- หัวข้อ -->
        <div>
          <label for="topic" class="block text-sm font-medium text-gray-700">หัวข้อการใช้งาน</label>
          <input type="text" id="topic" name="topic" required
            class="mt-1 block w-full max-w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        
        <!-- จำนวนผู้เข้าร่วม -->
        <div>
          <label for="attendees" class="block text-sm font-medium text-gray-700">จำนวนผู้เข้าร่วม</label>
          <input type="number" id="attendees" name="attendees" min="1" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

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

        <!-- ใช้สำหรับ -->
        <div>
          <label for="use" class="block text-sm font-medium text-gray-700">ใช้สำหรับ</label>
          <input type="use" id="text" name="use" required
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

    



  <script>
    const calendarDays = document.getElementById("calendarDays");
    const monthYear = document.getElementById("monthYear");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const modal = document.getElementById("modalForm");

    function openModal() {
      modal.classList.remove("hidden");
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
      for (let i = startDay - 1; i >= 0; i--) {
        const div = document.createElement("div");
        div.textContent = totalPrevDays - i;
        div.classList.add("other-month");
        calendarDays.appendChild(div);
      }
      for (let day = 1; day <= totalDays; day++) {
        const div = document.createElement("div");
        div.textContent = day;
        div.classList.add("current-month");
        const dateObj = currentDate.date(day).startOf('day');
        if (day === today.date() && currentDate.month() === today.month() && currentDate.year() === today.year()) {
          div.classList.add("today");
        }
        if (dateObj.day() === 0) div.classList.add("sunday");
        if (dateObj.day() === 6) div.classList.add("saturday");
        div.addEventListener("click", () => {
          if (selectedDayDiv) selectedDayDiv.classList.remove("selected");
          div.classList.add("selected");
          selectedDayDiv = div;
        });
        calendarDays.appendChild(div);
      }
      const filledCells = calendarDays.children.length;
      const remainingCells = totalCells - filledCells;
      for (let i = 1; i <= remainingCells; i++) {
        const div = document.createElement("div");
        div.textContent = i;
        div.classList.add("other-month");
        calendarDays.appendChild(div);
      }
    }

    prevBtn.addEventListener("click", () => {
      currentDate = currentDate.subtract(1, "month");
      selectedDayDiv = null;
      renderCalendar();
    });
    nextBtn.addEventListener("click", () => {
      currentDate = currentDate.add(1, "month");
      selectedDayDiv = null;
      renderCalendar();
    });
    renderCalendar();

    
  </script>
</body>

</html>