<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ปฏิทินเรียบๆ 2 ฝั่ง</title>

  <!-- ฟอนต์ Kanit จาก Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // กำหนดฟอนต์ใน Tailwind ให้ใช้ Kanit
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Kanit', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet" />

  <style>
    .fc .fc-button {
      background-color: #e5e7eb;
      border: none;
      color: #111827;
      font-weight: normal;
      padding: 0.25rem 0.5rem;
      border-radius: 0.375rem;
    }

    .fc .fc-button:hover {
      background-color: #d1d5db;
    }

    .fc .fc-toolbar-title {
      font-size: 1.25rem;
      font-weight: 500;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- ฝั่งซ้าย: ปฏิทิน -->
    <div class="bg-white rounded-xl shadow p-4">
      <div id="calendar"></div>
    </div>

    <!-- ฝั่งขวา: ปุ่ม -->
    <div class="bg-white rounded-xl shadow p-4">
      <h2 class="text-xl font-semibold mb-4">การจอง</h2>
      <div class="flex flex-wrap gap-2">
        <!-- ใส่ปุ่มหรือ UI อื่นๆ ที่นี่ -->
      </div>
    </div>
  </div>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'th',
        headerToolbar: {
          left: 'prev,next',
          center: 'title',
          right: ''
        },
        events: [
          {
            title: 'กิจกรรมตัวอย่าง',
            start: '2025-05-24',
            color: '#facc15'
          }
        ]
      });
      calendar.render();
    });
  </script>

</body>
</html>
