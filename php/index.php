<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ปฏิทิน</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col items-center py-10">

    <div class="bg-white shadow-md rounded-xl p-6 w-full max-w-4xl">
        <h1 class="text-3xl font-bold text-center mb-6">📅 ปฏิทิน</h1>

        <div class="flex flex-wrap justify-center gap-4 mb-6">
            <select id="monthSelect" class="px-4 py-2 border rounded">
            </select>

            <select id="yearSelect" class="px-4 py-2 border rounded">
            </select>
        </div>

        <div id="calendar" class="grid grid-cols-7 gap-2 text-center text-sm">
        </div>
    </div>

    <script>
        const monthSelect = document.getElementById('monthSelect');
        const yearSelect = document.getElementById('yearSelect');
        const calendar = document.getElementById('calendar');

        const months = [
            "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];

        months.forEach((m, i) => {
            monthSelect.innerHTML += `<option value="${i}">${m}</option>`;
        });

        const currentYear = new Date().getFullYear();
        for (let y = currentYear - 10; y <= currentYear + 10; y++) {
            yearSelect.innerHTML += `<option value="${y}">${y}</option>`;
        }

        monthSelect.value = new Date().getMonth();
        yearSelect.value = currentYear;

        function renderCalendar(month, year) {
            calendar.innerHTML = "";

            const days = ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"];
            days.forEach((day, i) => {
                calendar.innerHTML += `<div class="font-bold ${i === 0 || i === 6 ? 'text-red-600' : ''}">${day}</div>`;
            });

            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            for (let i = 0; i < firstDay; i++) {
                calendar.innerHTML += `<div></div>`;
            }

            for (let d = 1; d <= lastDate; d++) {
                const thisDay = new Date(year, month, d).getDay();
                const isWeekend = thisDay === 0 || thisDay === 6;
                calendar.innerHTML += `
          <div class="py-2 rounded ${isWeekend ? 'text-red-600' : ''} hover:bg-blue-100 cursor-pointer">
            ${d}
          </div>`;
            }
        }

        renderCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));

        monthSelect.addEventListener("change", () => {
            renderCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
        });

        yearSelect.addEventListener("change", () => {
            renderCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
        });
    </script>
</body>

</html>