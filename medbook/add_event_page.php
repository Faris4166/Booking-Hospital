<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<div class="p-4 sm:ml-64 sm:p-10">
  <div class="text-gray-800">
    <div class="w-full max-w-3xl mx-auto mt-4 sm:mt-6 p-4 sm:p-6 border border-gray-200 rounded-xl shadow-lg bg-gray-50">
      
      <!-- ส่วนหัวของปฏิทิน -->
      <div class="flex justify-between items-center mb-4 sm:mb-6">
        <button id="prev" class="p-1 sm:p-2 hover:bg-gray-200 rounded-full transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <h2 id="monthYear" class="text-lg sm:text-xl font-bold text-gray-800"></h2>
        <button id="next" class="p-1 sm:p-2 hover:bg-gray-200 rounded-full transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>

      <!-- ชื่อวันในสัปดาห์ -->
      <div class="grid grid-cols-7 text-center font-medium text-gray-700 text-xs sm:text-sm mb-2">
        <div>อา.</div><div>จ.</div><div>อ.</div><div>พ.</div><div>พฤ.</div><div>ศ.</div><div>ส.</div>
      </div>

      <!-- ปฏิทิน -->
      <div id="calendar" class="grid grid-cols-7 gap-1 sm:gap-2 text-center"></div>
    </div>
  </div>
</div>

<!-- ✅ Modal -->
<div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
  <div class="bg-white rounded-lg w-full max-w-lg p-6 relative">
    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl font-bold">&times;</button>
    <div id="modalContent">
      <p class="text-center text-gray-500">กำลังโหลด...</p>
    </div>
  </div>
</div>

<!-- ✅ JavaScript -->
<script>
  dayjs.locale('th');
  dayjs.extend(dayjs_plugin_isoWeek);

  const calendarEl = document.getElementById('calendar');
  const monthYearEl = document.getElementById('monthYear');
  let currentMonth = dayjs();

  function renderCalendar() {
    calendarEl.innerHTML = '';
    const startOfMonth = currentMonth.startOf('month');
    const endOfMonth = currentMonth.endOf('month');
    const startDate = startOfMonth.startOf('week');
    const endDate = endOfMonth.endOf('week');

    monthYearEl.textContent = currentMonth.format('MMMM YYYY');

    let day = startDate;
    while (day.isBefore(endDate) || day.isSame(endDate, 'day')) {
      const isCurrentMonth = day.month() === currentMonth.month();
      const isWeekend = day.day() === 0 || day.day() === 6;

      const cell = document.createElement('div');
      cell.textContent = day.date();
      cell.className = `
        flex items-center justify-center
        border rounded-lg
        aspect-square min-h-[40px] sm:min-h-[60px]
        text-xs sm:text-sm font-semibold
        ${isCurrentMonth ? 'bg-white text-gray-800' : 'text-gray-400'}
        ${isWeekend ? 'text-red-500' : ''}
        hover:bg-blue-100 cursor-pointer transition
      `;

      // 👉 Event Click เพื่อเปิด Modal
      const selectedDate = day.format('YYYY-MM-DD');
      cell.addEventListener('click', () => openModal(selectedDate));

      calendarEl.appendChild(cell);
      day = day.add(1, 'day');
    }
  }

  function openModal(date) {
    document.getElementById('bookingModal').classList.remove('hidden');
    const modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = `<p class="text-center text-gray-500">กำลังโหลด...</p>`;

    fetch(`popupday.php?date=${date}`)
      .then(response => response.text())
      .then(data => {
        modalContent.innerHTML = data;
      })
      .catch(() => {
        modalContent.innerHTML = `<p class="text-red-500 text-center">เกิดข้อผิดพลาดในการโหลดข้อมูล</p>`;
      });
  }

  function closeModal() {
    document.getElementById('bookingModal').classList.add('hidden');
  }

  document.getElementById('prev').addEventListener('click', () => {
    currentMonth = currentMonth.subtract(1, 'month');
    renderCalendar();
  });

  document.getElementById('next').addEventListener('click', () => {
    currentMonth = currentMonth.add(1, 'month');
    renderCalendar();
  });

  renderCalendar();
</script>
