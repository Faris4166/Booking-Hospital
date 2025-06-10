<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>

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

  <div class="p-4 sm:ml-64 sm:p-10 max-w-7xl mx-auto">
    <div id="calendar"></div>
  </div>

  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative max-h-full overflow-y-auto mx-4 md:mx-auto">
      <button onclick="closeModal()"
        class="absolute top-3 right-3 p-2 rounded-full text-gray-500 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
      <div id="modalContent"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

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
        selectable: true, // ทำให้สามารถเลือกวันที่ได้
        dateClick: function (info) {
          // เมื่อคลิกวันที่: แสดง Modal และโหลดเนื้อหาจาก forms.php
          modal.classList.remove('hidden'); // ทำให้ Modal ปรากฏ
          // ตรวจสอบเส้นทางของ forms.php ให้ถูกต้องตามโครงสร้างไฟล์ของคุณ
          fetch(`forms.php?date=${info.dateStr}`) // เรียก API ไปยัง forms.php พร้อมส่งวันที่
            .then(response => response.text()) // แปลง response เป็น text (HTML)
            .then(html => {
              modalContent.innerHTML = html; // นำ HTML ที่ได้มาใส่ใน Modal
            })
            .catch(error => {
              // หากเกิดข้อผิดพลาดในการโหลด
              modalContent.innerHTML = '<p class="text-red-500">เกิดข้อผิดพลาดในการโหลดข้อมูล</p>';
              console.error('Error loading form:', error); // แสดงข้อผิดพลาดใน console
            });
        },
        events: [ // ตัวอย่างกิจกรรมบนปฏิทิน
          {
            title: 'สอบกลางภาค',
            start: '2025-06-15',
            color: '#EF4444' // สีแดง
          },
          {
            title: 'วันหยุดราชการ',
            start: '2025-06-18',
            allDay: true,
            color: '#3B82F6' // สีน้ำเงิน
          }
        ]
      });

      calendar.render(); // แสดงผลปฏิทิน
    });

    // ฟังก์ชันสำหรับปิด Modal
    function closeModal() {
      document.getElementById('modal').classList.add('hidden'); // ซ่อน Modal
      document.getElementById('modalContent').innerHTML = ''; // ล้างเนื้อหาใน Modal
    }
  </script>
</body>

</html>