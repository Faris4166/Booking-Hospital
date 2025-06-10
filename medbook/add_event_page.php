<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

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
<div class="mt-20 p-4 sm:ml-64 sm:p-10 max-w-7xl mx-auto">
    <div id="calendar"></div>
  </div>
  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
      <button onclick="closeModal()"
        class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-xl">&times;</button>
      <div id="modalContent">กำลังโหลด...</div>
    </div>
  </div>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

  <!-- FullCalendar ตั้งค่า -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');
      const modal = document.getElementById('modal');
      const modalContent = document.getElementById('modalContent');

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
          // แสดง modal
          modal.classList.remove('hidden');
          // โหลดเนื้อหาจาก fonsts.php พร้อมส่งวันที่
          fetch(`forms.php?date=${info.dateStr}`)
            .then(response => response.text())
            .then(html => {
              modalContent.innerHTML = html;
            })
            .catch(error => {
              modalContent.innerHTML = '<p class="text-red-500">เกิดข้อผิดพลาดในการโหลดข้อมูล</p>';
            });
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

    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
      document.getElementById('modalContent').innerHTML = '';
    }
  </script>
</body>

</html>