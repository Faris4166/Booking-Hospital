<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>ปฏิทิน Day.js ภาษาไทย เลือกวันได้</title>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

<!-- Day.js -->
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/plugin/isSame.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/plugin/localeData.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/locale/th.js"></script>

<style>
  #calendarDays > div {
    min-height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
  }
</style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-5xl">

    <div class="w-full">
      <div id="calendar" class="border rounded-lg shadow p-4">
        <div class="flex items-center justify-between bg-[#f0f7f2] p-3 rounded">
          <button id="prevBtn" class="text-[#31a35f] text-2xl font-bold">&lt;</button>
          <h2 id="monthYear" class="text-[#31a35f] font-semibold text-xl"></h2>
          <button id="nextBtn" class="text-[#31a35f] text-2xl font-bold">&gt;</button>
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
  // ตั้งค่า Day.js
  dayjs.extend(dayjs_plugin_isSame);
  dayjs.extend(dayjs_plugin_localeData);
  dayjs.locale('th');

  const monthYear = document.getElementById('monthYear');
  const calendarDays = document.getElementById('calendarDays');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');

  let currentDate = dayjs();
  let selectedDate = null;

  function renderCalendar() {
    calendarDays.innerHTML = '';

    // แสดงชื่อเดือนปีเป็นภาษาไทย
    // ใช้ localeData เพื่อให้ชื่อเดือนออกมาเป็นภาษาไทย
    const localeData = currentDate.localeData();
    const monthName = localeData.months(currentDate);
    const year = currentDate.year() + 543; // ปีพ.ศ.
    monthYear.textContent = `${monthName} ${year}`;

    const startOfMonth = currentDate.startOf('month');
    const endOfMonth = currentDate.endOf('month');
    const startDay = startOfMonth.day(); // 0=อาทิตย์
    const totalDays = endOfMonth.date();

    // ช่องว่างก่อนวันแรกของเดือน
    for(let i=0; i < startDay; i++){
      calendarDays.appendChild(document.createElement('div'));
    }

    for(let day=1; day <= totalDays; day++){
      const thisDate = dayjs(currentDate).date(day);
      const dayDiv = document.createElement('div');
      dayDiv.textContent = day;
      dayDiv.className = `p-2 rounded cursor-pointer transition bg-white hover:border hover:border-[#339e61] hover:text-[#339e61]`;

      if(selectedDate && thisDate.isSame(selectedDate, 'day')){
        dayDiv.classList.add('border', 'border-[#339e61]', 'text-[#339e61]', 'font-semibold');
      }

      dayDiv.addEventListener('click', () => {
        selectedDate = thisDate;
        renderCalendar();
      });

      calendarDays.appendChild(dayDiv);
    }
  }

  prevBtn.addEventListener('click', () => {
    currentDate = currentDate.subtract(1, 'month');
    renderCalendar();
  });

  nextBtn.addEventListener('click', () => {
    currentDate = currentDate.add(1, 'month');
    renderCalendar();
  });

  renderCalendar();
</script>
</body>
</html>
