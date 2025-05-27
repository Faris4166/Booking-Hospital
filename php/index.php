<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ปฏิทินด้วย Day.js</title>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="icon" href="../image/logo.ico">

  <style>
    #calendarDays > div {
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
    #calendarDays > div.current-month:hover:not(.past-day) {
      border-color: #339e61;
      color: #339e61;
      cursor: pointer;
    }

    /* hover สำหรับวันปัจจุบัน */
    #calendarDays > div.today:hover {
      border-color: #2c8050;
      color: #2c8050;
      cursor: pointer;
    }

    /* วันเดือนอื่นสีเทา */
    #calendarDays > div.other-month:not(.past-day) {
      color: #a0aec0;
      cursor: default;
    }

    /* วันเดือนอื่นที่เป็นวันก่อนวันนี้ */
    #calendarDays > div.other-month.past-day {
      color: #9ca3af;
      cursor: not-allowed;
      opacity: 0.6;
    }

    /* วันปัจจุบัน */
    #calendarDays > div.today {
      color: #32a060;
      border-color: #32a060;
      background-color: white;
      font-weight: 500;
      cursor: pointer;
    }

    /* วันก่อนวันนี้ */
    #calendarDays > div.past-day {
      color: #9ca3af; /* สีเทาอ่อน */
      cursor: not-allowed;
      opacity: 0.6;
    }

    /* วันที่เลือก */
    #calendarDays > div.selected {
      background-color: #d1fae5;
      border-color: #32a060;
      color: #32a060;
      font-weight: 700;
    }
  </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-6xl">
    
    <div class="w-full">
      <div id="calendar" class="border rounded-lg shadow p-4">
        <div class="flex items-center justify-between bg-[#f0f7f2] p-3 rounded">
          <button id="prevBtn" class="text-[#31a35f] text-xl">&lt;</button>
          <h2 id="monthYear" class="text-[#31a35f] font-semibold text-lg"></h2>
          <button id="nextBtn" class="text-[#31a35f] text-xl">&gt;</button>
        </div>
        
        <div class="grid grid-cols-7 text-center mt-4 text-gray-500 font-medium">
          <div>อา</div><div>จ</div><div>อ</div><div>พ</div><div>พฤ</div><div>ศ</div><div>ส</div>
        </div>

        <div id="calendarDays" class="grid grid-cols-7 text-center mt-2 gap-1"></div>
      </div>
    </div>

    <div class="w-full min-h-[400px] border border-dashed border-gray-300 rounded-lg"></div>
  </div>

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

      // เติมวันเดือนก่อนหน้า
      for (let i = startDay - 1; i >= 0; i--) {
        const dayNum = totalPrevDays - i;
        const dateObj = prevMonth.date(dayNum).startOf('day');
        const div = document.createElement("div");
        div.textContent = dayNum;
        div.classList.add("other-month");
        if (dateObj.isBefore(today)) {
          div.classList.add("past-day");
        }
        calendarDays.appendChild(div);
      }

      let todayDiv = null;

      // เติมวันเดือนนี้
      for (let day = 1; day <= totalDays; day++) {
        const div = document.createElement("div");
        div.textContent = day;
        div.classList.add("current-month");

        const dateObj = currentDate.date(day).startOf('day');

        if (dateObj.isBefore(today)) {
          div.classList.add("past-day");
        } else {
          div.addEventListener("click", () => {
            if (selectedDayDiv) {
              selectedDayDiv.classList.remove("selected");
            }
            div.classList.add("selected");
            selectedDayDiv = div;
            alert(`เลือกวันที่: ${day} ${monthName} ${currentDate.year()}`);
          });
        }

        if (
          day === dayjs().date() &&
          currentDate.month() === dayjs().month() &&
          currentDate.year() === dayjs().year()
        ) {
          div.classList.add("today");
          todayDiv = div;
        }

        calendarDays.appendChild(div);
      }

      // เติมวันเดือนถัดไปให้เต็ม 42 ช่อง
      const remainingCells = totalCells - calendarDays.children.length;
      const nextMonth = currentDate.add(1, 'month');

      for (let i = 1; i <= remainingCells; i++) {
        const dateObj = nextMonth.date(i).startOf('day');
        const div = document.createElement("div");
        div.textContent = i;
        div.classList.add("other-month");
        if (dateObj.isBefore(today)) {
          div.classList.add("past-day");
        }
        calendarDays.appendChild(div);
      }

      // จัดการ hover ปลด hover วันนี้เมื่อ hover วันอื่น
      Array.from(calendarDays.children).forEach(dayDiv => {
        if (dayDiv === todayDiv) {
          // วันปัจจุบัน ไม่ต้องเปลี่ยนอะไร
        } else {
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
</body>
</html>
