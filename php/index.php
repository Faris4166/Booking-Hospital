<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ปฏิทินด้วย Day.js</title>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-5xl">
    
    <!-- ฝั่งปฏิทิน -->
    <div class="w-full">
      <div id="calendar" class="border rounded-lg shadow p-4">
        <!-- Header -->
        <div class="flex items-center justify-between bg-[#f0f7f2] p-3 rounded">
          <button id="prevBtn" class="text-[#31a35f] text-xl">&larr;</button>
          <h2 id="monthYear" class="text-[#31a35f] font-semibold text-lg"></h2>
          <button id="nextBtn" class="text-[#31a35f] text-xl">&rarr;</button>
        </div>
        
        <!-- Days of Week -->
        <div class="grid grid-cols-7 text-center mt-4 text-gray-500 font-medium">
          <div>อา</div><div>จ</div><div>อ</div><div>พ</div><div>พฤ</div><div>ศ</div><div>ส</div>
        </div>

        <!-- Days -->
        <div id="calendarDays" class="grid grid-cols-7 text-center mt-2 gap-1">
          <!-- เติมวันด้วย JS -->
        </div>
      </div>
    </div>

    <!-- ฝั่งว่าง -->
    <div class="w-full min-h-[400px] border border-dashed border-gray-300 rounded-lg"></div>
  </div>

  <script>
    const calendarDays = document.getElementById("calendarDays");
    const monthYear = document.getElementById("monthYear");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let currentDate = dayjs();

    function renderCalendar() {
      const startOfMonth = currentDate.startOf("month");
      const endOfMonth = currentDate.endOf("month");
      const startDay = startOfMonth.day(); // 0 = Sunday
      const totalDays = endOfMonth.date();

      // แสดงชื่อเดือนและปี
      monthYear.textContent = currentDate.format("MMMM YYYY");

      // เคลียร์ของเก่า
      calendarDays.innerHTML = "";

      // ช่องว่างก่อนวันที่ 1
      for (let i = 0; i < startDay; i++) {
        calendarDays.innerHTML += `<div></div>`;
      }

      // สร้างวันในเดือน
      for (let day = 1; day <= totalDays; day++) {
        const box = document.createElement("div");
        box.textContent = day;
        box.className =
          "p-2 rounded cursor-pointer hover:border hover:border-[#339e61] hover:text-[#339e61] transition";

        calendarDays.appendChild(box);
      }
    }

    prevBtn.addEventListener("click", () => {
      currentDate = currentDate.subtract(1, "month");
      renderCalendar();
    });

    nextBtn.addEventListener("click", () => {
      currentDate = currentDate.add(1, "month");
      renderCalendar();
    });

    renderCalendar();
  </script>
</body>
</html>
