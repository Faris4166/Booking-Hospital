<?php include 'header.php';?>
<?php include 'navbar.php';?>

<div class="p-4 sm:ml-64">
  <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-1">
    <body class="bg-white text-gray-800">
      <div class="w-full max-w-[800px] mx-auto mt-10 p-4 border rounded shadow">
        <div class="flex justify-between items-center mb-4">
          <button id="prev" class="p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <h2 id="monthYear" class="text-lg font-semibold"></h2>
          <button id="next" class="p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
        <div class="grid grid-cols-7 text-center font-medium">
          <div>อา.</div><div>จ.</div><div>อ.</div><div>พ.</div><div>พฤ.</div><div>ศ.</div><div>ส.</div>
        </div>
        <div id="calendar" class="grid grid-cols-7 gap-1 text-center mt-1"></div>
      </div>
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
              border rounded
              ${isCurrentMonth ? '' : 'text-gray-400'}
              ${isWeekend ? 'text-red-500' : ''}
              aspect-square min-h-[60px] 
            `;
            calendarEl.appendChild(cell);
            day = day.add(1, 'day');
          }
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
    </body>
  </div>
</div>
