<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>ปฏิทินกิจกรรม</title>

  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Kanit', sans-serif;
    }

    /* Adjust FullCalendar to fill container width */
    #calendar {
      max-width: 100%;
      margin: 0 auto;
    }

    /* Optional: Fine-tune FullCalendar header buttons for very small screens if needed */
    /* This targets the buttons within the header toolbar */
    .fc .fc-toolbar-chunk {
      display: flex;
      flex-wrap: wrap; /* Allows buttons to wrap to next line on small screens */
      justify-content: center; /* Centers buttons when wrapped */
      gap: 0.5rem; /* Adds a small gap between buttons */
    }

    /* Reduce font size for FullCalendar titles on very small screens if default is too large */
    @media (max-width: 639px) { /* Tailwind's 'sm' breakpoint is 640px, so this targets smaller */
      .fc .fc-toolbar-title {
        font-size: 1.25rem; /* Adjust as needed */
      }
      .fc .fc-button {
        padding: 0.3em 0.6em; /* Smaller padding for buttons */
        font-size: 0.75rem; /* Smaller font size for buttons */
      }
    }
  </style>
</head>

<body class="bg-gray-50">

  <div class=" max-w-7xl mx-auto">
    <div id="calendar"></div>
  </div>

  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative max-h-full overflow-y-auto mx-4 md:mx-auto">
      <button onclick="closeModal()"
        class="absolute top-3 right-3 p-2 rounded-full text-gray-500 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd" />
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
        initialView: 'dayGridMonth', // Default view
        locale: 'th', // Set language to Thai
        headerToolbar: {
          left: 'prev,next today', // Previous, next, today buttons
          center: 'title', // Calendar title (e.g., June 2025)
          right: 'dayGridMonth,timeGridWeek,listMonth' // View toggles
        },
        selectable: true, // Allows users to click on dates
        dateClick: function (info) {
          // When a date is clicked: Show the modal and load content from forms.php
          modal.classList.remove('hidden'); // Make the modal visible


          fetch(`forms2.php?date=${info.dateStr}`)
            .then(response => {
              if (!response.ok) {
                // Check for HTTP errors (e.g., 404, 500)
                throw new Error(`HTTP error! status: ${response.status}`);
              }
              return response.text(); // Convert the response to text (HTML)
            })
            .then(html => {
              modalContent.innerHTML = html; // Insert the fetched HTML into the modal
            })
            .catch(error => {
              // Handle errors during fetch
              modalContent.innerHTML = '<p class="text-red-500">เกิดข้อผิดพลาดในการโหลดข้อมูล. กรุณาลองอีกครั้ง.</p>';
              console.error('Error loading form:', error); // Log the error to console
            });
        },
        events: [ // Example events to display on the calendar
          {
            title: 'สอบกลางภาค', // Event title
            start: '2025-06-15', // Start date of the event
            color: '#EF4444' // Red color for the event
          },
          {
            title: 'วันหยุดราชการ',
            start: '2025-06-18',
            allDay: true, // Indicates it's an all-day event
            color: '#3B82F6' // Blue color for the event
          },
          {
            title: 'นำเสนอโปรเจค',
            start: '2025-06-20T10:00:00', // Event with specific time
            end: '2025-06-20T12:00:00',
            color: '#22C55E' // Green color
          }
        ]
      });

      calendar.render(); // Render the calendar
    });

    // Function to close the modal
    function closeModal() {
      document.getElementById('modal').classList.add('hidden'); // Hide the modal
      document.getElementById('modalContent').innerHTML = ''; // Clear content inside the modal
    }
  </script>
</body>

</html>