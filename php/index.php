<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ปฏิทิน 6 แถวตายตัวด้วย Day.js</title>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Kanit', sans-serif;
    }
    #calendarDays > div {
      height: 65px;
      min-height: 65px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-top: 4px;
      font-weight: 500;
      user-select: none;
      border: 2px solid transparent;
      transition: border-color 0.3s ease, color 0.3s ease, background-color 0.3s ease;
      background-color: white;
      text-align: center;
    }
    @media (max-width: 767px) {
      #calendarDays {
        gap: 0.125rem;
      }
      #calendarDays > div {
        height: 45px;
        min-height: 45px;
        font-size: 0.875rem;
      }
    }
    #calendarDays > div.saturday,
    #calendarDays > div.sunday {
      color: red;
    }
    #calendarDays > div.current-month:hover:not(.past-day) {
      border-color: #339e61;
      color: #339e61;
      cursor: pointer;
    }
    #calendarDays > div.today:hover {
      border-color: #2c8050;
      color: #2c8050;
      cursor: pointer;
    }
    #calendarDays > div.other-month:not(.past-day) {
      color: #a0aec0;
      cursor: default;
    }
    #calendarDays > div.other-month.past-day {
      color: #9ca3af;
      cursor: not-allowed;
      opacity: 0.6;
    }
    #calendarDays > div.today {
      color: #32a060;
      border-color: #32a060;
      background-color: white;
      font-weight: 500;
      cursor: pointer;
    }
    #calendarDays > div.past-day {
      color: #9ca3af;
      cursor: not-allowed;
      opacity: 0.6;
    }
    #calendarDays > div.selected {
      background-color: #d1fae5;
      border-color: #32a060;
      color: #32a060;
      font-weight: 700;
    }
  </style>
</head>
<body class="bg-white min-h-screen flex items-start justify-center p-4">
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
      const startDay = startOfMonth.day(); // 0=อาทิตย์
      const totalDays = endOfMonth.date();

      const prevMonth = currentDate.subtract(1, 'month');
      const endOfPrevMonth = prevMonth.endOf('month');
      const totalPrevDays = endOfPrevMonth.date();

      const totalCells = 42; // 6 แถว * 7 วัน = 42 ช่อง

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
        if (dateObj.isBefore(today)) div.classList.add("past-day");
        if (dateObj.day() === 0) div.classList.add("sunday");
        if (dateObj.day() === 6) div.classList.add("saturday");
        calendarDays.appendChild(div);
      }

      // เติมวันเดือนนี้
      for (let day = 1; day <= totalDays; day++) {
        const div = document.createElement("div");
        div.textContent = day;
        div.classList.add("current-month");
        const dateObj = currentDate.date(day).startOf('day');

        if (dateObj.isBefore(today)) div.classList.add("past-day");
        else {
          div.addEventListener("click", () => {
            if (selectedDayDiv) selectedDayDiv.classList.remove("selected");
            div.classList.add("selected");
            selectedDayDiv = div;
            alert(`เลือกวันที่: ${day} ${monthName} ${currentDate.year()}`);
          });
        }

        if (day === dayjs().date() && currentDate.month() === dayjs().month() && currentDate.year() === dayjs().year()) {
          div.classList.add("today");
        }

        if (dateObj.day() === 0) div.classList.add("sunday");
        if (dateObj.day() === 6) div.classList.add("saturday");

        calendarDays.appendChild(div);
      }

      // เติมวันเดือนถัดไป ให้ครบ 42 ช่อง (6 แถว)
      const filledCells = calendarDays.children.length;
      const remainingCells = totalCells - filledCells;

      for (let i = 1; i <= remainingCells; i++) {
        const dateObj = currentDate.add(1, 'month').date(i).startOf('day');
        const div = document.createElement("div");
        div.textContent = i;
        div.classList.add("other-month");
        if (dateObj.isBefore(today)) div.classList.add("past-day");
        if (dateObj.day() === 0) div.classList.add("sunday");
        if (dateObj.day() === 6) div.classList.add("saturday");
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
