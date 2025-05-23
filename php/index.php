<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MedBook</title>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="icon" href="../image/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="../css/font.css">

  <style>
    #calendarDays>div {
      height: 65px;
      min-height: 65px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: 500;
      user-select: none;
      border: 2px solid transparent;
      transition: border-color 0.3s ease, color 0.3s ease, background-color 0.3s ease;
      background-color: white;
    }

    /* hover สำหรับวันเดือนนี้ที่เลือกได้ */
    #calendarDays>div.current-month:hover:not(.past-day) {
      border-color: #339e61;
      color: #339e61;
      cursor: pointer;
    }

    /* hover สำหรับวันปัจจุบัน */
    #calendarDays>div.today:hover {
      border-color: #2c8050;
      color: #2c8050;
      cursor: pointer;
    }

    /* วันเดือนอื่นสีเทา */
    #calendarDays>div.other-month:not(.past-day) {
      color: #a0aec0;
      cursor: default;
    }

    /* วันเดือนอื่นที่เป็นวันก่อนวันนี้ */
    #calendarDays>div.other-month.past-day {
      color: #9ca3af;
      cursor: not-allowed;
      opacity: 0.6;
    }

    /* วันปัจจุบัน */
    #calendarDays>div.today {
      color: #32a060;
      border-color: #32a060;
      background-color: white;
      font-weight: 500;
      cursor: pointer;
    }

    /* วันก่อนวันนี้ */
    #calendarDays>div.past-day {
      color: #9ca3af;
      /* สีเทาอ่อน */
      cursor: not-allowed;
      opacity: 0.6;
    }

    /* วันที่เลือก */
    #calendarDays>div.selected {
      background-color: #d1fae5;
      border-color: #32a060;
      color: #32a060;
      font-weight: 700;
    }
  </style>
</head>

<body>

  <nav class="bg-white shadow px-4 py-3">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <div class="text-xl font-bold text-indigo-600">Med Book</div>

      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="focus:outline-none">
          <img src="../image/1.jpg" class="w-10 h-10 rounded-full border-2 border-indigo-600">
        </button>

        <div x-show="open" x-transition @click.outside="open = false"
          class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50" style="display: none;">
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 no-underline hover:no-underline">⚙
            ตั้งค่า</a>
          <form action="logout.php" method="POST">
            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
              🚪 ลงชื่อออก
            </button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div class="bg-white flex justify-center pt-6 pb-4 px-2">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-6xl">

      <!-- ปฏิทิน -->
      <div class="w-full">
        <div id="calendar" class="border rounded-lg shadow p-4">
          <!-- ส่วนหัว -->
          <div class="flex items-center justify-between bg-[#f0f7f2] p-3 rounded">
            <button id="prevBtn" class="text-[#31a35f] text-xl">&lt;</button>
            <h2 id="monthYear" class="text-[#31a35f] font-semibold text-base sm:text-lg"></h2>
            <button id="nextBtn" class="text-[#31a35f] text-xl">&gt;</button>
          </div>

          <!-- หัวตารางวัน -->
          <div class="grid grid-cols-7 text-center mt-4 text-gray-500 font-medium text-sm sm:text-base">
            <div>อา</div>
            <div>จ</div>
            <div>อ</div>
            <div>พ</div>
            <div>พฤ</div>
            <div>ศ</div>
            <div>ส</div>
          </div>

          <!-- วันต่างๆ -->
          <div id="calendarDays" class="grid grid-cols-7 text-center mt-2 gap-1 text-sm sm:text-base"></div>
        </div>
      </div>

    <div class="w-full">
      <div class="border rounded-lg shadow p-4 h-full flex flex-col relative">
        <div class="bg-[#f0f7f2] p-3 rounded">
          <h2 class="text-[#31a35f] font-semibold text-lg">การจองใช้งานห้องเรียน</h2>
        </div>

          <!-- เนื้อหา -->
          <div
            class="flex-1 flex items-center justify-center text-gray-400 italic text-sm sm:text-base text-center px-2">
            ยังไม่มีข้อมูลการจอง
          </div>

          <!-- ปุ่มเพิ่ม -->
          <button
            class="absolute bottom-4 right-4 bg-[#31a35f] text-black rounded-full w-12 h-12 shadow-md hover:bg-[#279151] transition duration-200 text-2xl flex items-center justify-center"
            title="เพิ่มการจอง">+</button>
        </div>
      </div>

    </div>

    <!-- Calendar script -->
    <script>
      const calendarDays = document.getElementById("calendarDays");
      const monthYear = document.getElementById("monthYear");
      const prevBtn = document.getElementById("prevBtn");
      const nextBtn = document.getElementById("nextBtn");

      const thaiMonths = [
        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
        "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม",
        "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
      ];

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
        const monthName = thaiMonths[currentDate.month()];
        monthYear.textContent = `${monthName} ${currentDate.year()}`;

        calendarDays.innerHTML = "";

        for (let i = startDay - 1; i >= 0; i--) {
          const dayNum = totalPrevDays - i;
          const dateObj = prevMonth.date(dayNum).startOf('day');
          const div = document.createElement("div");
          div.textContent = dayNum;
          div.classList.add("other-month", "text-gray-400");
          if (dateObj.isBefore(today)) div.classList.add("past-day");
          calendarDays.appendChild(div);
        }

        let todayDiv = null;
        for (let day = 1; day <= totalDays; day++) {
          const div = document.createElement("div");
          div.textContent = day;
          div.classList.add("current-month", "cursor-pointer", "rounded", "hover:bg-[#d6f5e3]", "transition", "duration-200");

          const dateObj = currentDate.date(day).startOf('day');

          if (dateObj.isBefore(today)) {
            div.classList.add("text-gray-400", "cursor-default", "hover:bg-transparent");
          } else {
            div.addEventListener("click", () => {
              if (selectedDayDiv) selectedDayDiv.classList.remove("bg-[#32a060]", "text-white");
              div.classList.add("bg-[#32a060]", "text-white");
              selectedDayDiv = div;
              alert(`เลือกวันที่: ${day} ${monthName} ${currentDate.year()}`);
            });
          }

          if (
            day === dayjs().date() &&
            currentDate.month() === dayjs().month() &&
            currentDate.year() === dayjs().year()
          ) {
            div.classList.add("border", "border-[#32a060]", "rounded");
            todayDiv = div;
          }

          calendarDays.appendChild(div);
        }

        const remainingCells = totalCells - calendarDays.children.length;
        const nextMonth = currentDate.add(1, 'month');

        for (let i = 1; i <= remainingCells; i++) {
          const dateObj = nextMonth.date(i).startOf('day');
          const div = document.createElement("div");
          div.textContent = i;
          div.classList.add("other-month", "text-gray-400");
          if (dateObj.isBefore(today)) div.classList.add("past-day");
          calendarDays.appendChild(div);
        }

        Array.from(calendarDays.children).forEach(dayDiv => {
          if (dayDiv !== todayDiv) {
            dayDiv.addEventListener("mouseenter", () => {
              if (todayDiv) {
                todayDiv.style.borderColor = "transparent";
                todayDiv.style.color = "#000000";
                todayDiv.style.cursor = "default";
              }
            });
            dayDiv.addEventListener("mouseleave", () => {
              if (todayDiv) {
                todayDiv.style.borderColor = "#32a060";
                todayDiv.style.color = "#32a060";
                todayDiv.style.cursor = "pointer";
              }
            });
          }
        });
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

    <!-- Bootstrap (ถ้าใช้ร่วม) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
      crossorigin="anonymous"></script>
  </div>

</body>

</html>