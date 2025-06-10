<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ฟอนต์ไทย Kanit -->
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Kanit', sans-serif;
    }

    /* ปรับ FullCalendar ให้เต็มความกว้าง container */
    #calendar {
      max-width: 100%;
      margin: 0 auto;
    }
  </style>
</head>

<body class="bg-gray-50">

  <!-- ส่วน container ปรับให้ responsive -->
  <div class="p-4 sm:ml-64 sm:p-10 max-w-7xl mx-auto">
    <div id="calendar"></div>
  </div>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

  <!-- FullCalendar ตั้งค่า -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'th',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,listMonth'
        },
        selectable: true,
        dateClick: function (info) {
          alert('คุณคลิกวันที่: ' + info.dateStr);
        },
        events: [
          {
            title: 'สอบกลางภาค',
            start: '2025-06-15',
            color: '#EF4444'
          },
          {
            title: 'วันหยุดราชการ',
            start: '2025-06-18',
            allDay: true,
            color: '#3B82F6'
          }
        ]
      });

      calendar.render();
    });
  </script>
</body>

</html>
