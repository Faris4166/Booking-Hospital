<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MedBook</title>
    <link rel="icon" href="../image/logo.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css" />

    <style>
        .glass {
            background: rgba(255 255 255 / 0.6);
            backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-100 to-indigo-50 min-h-screen p-6" style="font-family: 'Kanit', sans-serif;">

    <div class="max-w-7xl mx-auto grid grid-cols-1 gap-6 mt-6">
        <!-- ปฏิทิน -->
        <div class="glass p-10 rounded-3xl shadow-xl ring-1 ring-white/30 w-full min-h-[500px]">
            <div class="flex justify-between items-center mb-6">
                <button id="prev-month" class="text-indigo-600 hover:text-indigo-800 text-2xl font-bold">&larr;</button>
                <div id="month-year" class="text-2xl font-semibold text-gray-800"></div>
                <button id="next-month" class="text-indigo-600 hover:text-indigo-800 text-2xl font-bold">&rarr;</button>
            </div>

            <div id="calendar-days" class="grid grid-cols-7 gap-2 text-center text-sm font-semibold text-gray-600 mb-2">
                <!-- วันในสัปดาห์ -->
            </div>
            <div id="calendar-dates" class="grid grid-cols-7 gap-2 text-center">
                <!-- วันที่ในเดือน -->
            </div>
        </div>

        <!-- การจองห้อง -->
        <div class="glass p-6 rounded-3xl shadow-xl ring-1 ring-white/30 w-full flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold text-indigo-700 mb-4">การจองห้อง</h2>
                <p id="booking-status" class="text-gray-700 text-base mb-6">ไม่มีการจองในวันนี้</p>
            </div>
            <button id="open-modal"
                class="w-full bg-indigo-600 text-white py-3 px-4 rounded-xl shadow-md hover:bg-indigo-700 transition text-lg">
                + จองห้อง
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div id="popup-modal" class="fixed inset-0 bg-black/40 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-2xl max-w-2xl w-full relative overflow-auto max-h-[90vh]">
            <button id="close-modal"
                class="absolute top-2 right-4 text-gray-600 text-2xl font-bold hover:text-black">&times;</button>
            <div id="modal-content">
                <form id="bookingForm" class="space-y-6" onsubmit="event.preventDefault(); submitBooking()">
                    <h3 class="text-xl font-semibold text-indigo-700 mb-4">ฟอร์มจองห้อง</h3>

                    <div>
                        <label for="roomName" class="block font-medium text-gray-700 mb-1">ชื่อห้อง</label>
                        <input type="text" id="roomName" name="roomName" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-indigo-500"
                            placeholder="เช่น ห้องประชุม 101" />
                    </div>

                    <div>
                        <label for="topic" class="block font-medium text-gray-700 mb-1">หัวข้อการจอง</label>
                        <input type="text" id="topic" name="topic" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-indigo-500"
                            placeholder="เช่น ประชุมคณะ" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="startDate" class="block font-medium text-gray-700 mb-1">วันที่เริ่ม</label>
                            <input type="text" id="startDate" name="startDate" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-indigo-500"
                                placeholder="เลือกวันที่เริ่ม" />
                        </div>

                        <div>
                            <label for="endDate" class="block font-medium text-gray-700 mb-1">วันที่สิ้นสุด</label>
                            <input type="text" id="endDate" name="endDate" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-indigo-500"
                                placeholder="เลือกวันที่สิ้นสุด" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="startTime" class="block font-medium text-gray-700 mb-1">เวลาเริ่ม</label>
                            <input type="text" id="startTime" name="startTime" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-indigo-500"
                                placeholder="เลือกเวลาเริ่ม" />
                        </div>

                        <div>
                            <label for="endTime" class="block font-medium text-gray-700 mb-1">เวลาสิ้นสุด</label>
                            <input type="text" id="endTime" name="endTime" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-indigo-500"
                                placeholder="เลือกเวลาสิ้นสุด" />
                        </div>
                    </div>

                    <div>
                        <label for="remark" class="block font-medium text-gray-700 mb-1">หมายเหตุ (ถ้ามี)</label>
                        <textarea id="remark" name="remark" rows="3" placeholder="เช่น ขอโปรเจคเตอร์"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-indigo-500"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                        ยืนยันการจอง
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>
    <script>
        const monthYear = document.getElementById('month-year');
        const calendarDays = document.getElementById('calendar-days');
        const calendarDates = document.getElementById('calendar-dates');
        const daysOfWeek = ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'];
        let currentDate = new Date();
        let selectedDate = null;

        function renderDays() {
            calendarDays.innerHTML = '';
            daysOfWeek.forEach((day, index) => {
                const dayElem = document.createElement('div');
                dayElem.textContent = day;
                dayElem.className = (index === 0 || index === 6) ? 'text-red-500' : '';
                calendarDays.appendChild(dayElem);
            });
        }

        function renderDates(date) {
            calendarDates.innerHTML = '';
            const year = date.getFullYear();
            const month = date.getMonth();
            const monthNames = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
            monthYear.textContent = `${monthNames[month]} ${year}`;
            const firstDay = new Date(year, month, 1);
            const firstWeekday = firstDay.getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            for (let i = 0; i < firstWeekday; i++) {
                calendarDates.appendChild(document.createElement('div'));
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateObj = new Date(year, month, day);
                const weekday = dateObj.getDay();
                const dateCell = document.createElement('div');
                dateCell.textContent = day;
                dateCell.className = `
          cursor-pointer py-3 rounded-xl transition-all duration-200
          ${weekday === 0 || weekday === 6 ? 'text-red-500' : 'text-gray-800'}
          hover:bg-indigo-100
        `;

                if (selectedDate &&
                    selectedDate.getFullYear() === year &&
                    selectedDate.getMonth() === month &&
                    selectedDate.getDate() === day) {
                    dateCell.classList.add('bg-indigo-600', 'text-white', 'font-bold', 'shadow-md');
                }

                dateCell.addEventListener('click', () => {
                    selectedDate = new Date(year, month, day);
                    document.getElementById('booking-status').textContent = `ไม่มีการจองในวันที่ ${day}/${month + 1}/${year}`;
                    renderDates(currentDate);
                });

                calendarDates.appendChild(dateCell);
            }
        }

        document.getElementById('prev-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderDates(currentDate);
        });

        document.getElementById('next-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderDates(currentDate);
        });

        renderDays();
        renderDates(currentDate);

        // Modal
        const openModalBtn = document.getElementById('open-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const modal = document.getElementById('popup-modal');

        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            flatpickr("#startDate", { dateFormat: "d/m/Y", locale: "th", allowInput: true, minDate: "today" });
            flatpickr("#endDate", { dateFormat: "d/m/Y", locale: "th", allowInput: true, minDate: "today" });
            flatpickr("#startTime", { enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true, locale: "th" });
            flatpickr("#endTime", { enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true, locale: "th" });
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });

        function submitBooking() {
            const roomName = document.getElementById('roomName').value;
            const topic = document.getElementById('topic').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const startTime = document.getElementById('startTime').value;
            const endTime = document.getElementById('endTime').value;
            const remark = document.getElementById('remark').value;

            alert(`จองห้อง: ${roomName}\nหัวข้อ: ${topic}\nวันที่: ${startDate} - ${endDate}\nเวลา: ${startTime} - ${endTime}\nหมายเหตุ: ${remark}`);
            modal.classList.add('hidden');
            document.getElementById('bookingForm').reset();
        }
    </script>
</body>

</html>
