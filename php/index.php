<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>หน้าหลัก</title>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Kanit', sans-serif; }
    #calendarDays > div { height: 65px; min-height: 65px; display: flex; justify-content: center; align-items: flex-start; font-weight: 500; user-select: none; border: 2px solid transparent; transition: border-color 0.3s ease; background-color: white; text-align: center; border-radius: 0.25rem; cursor: pointer; padding-top: 8px; }
    @media (max-width: 767px) {
      #calendarDays { gap: 0.125rem; }
      #calendarDays > div { height: 45px; min-height: 45px; font-size: 0.875rem; }
      #calendarDays > div.today { height: 45px !important; min-height: 45px !important; }
    }
    #calendarDays > div.saturday, #calendarDays > div.sunday { color: red; }
    #calendarDays > div:hover { border-color: #cbd5e0; }
    #calendarDays > div.other-month { color: #a0aec0; cursor: default; }
    #calendarDays > div.today { border: 2px solid black; }
    #calendarDays > div.selected { border-color: #cbd5e0 !important; background-color: white !important; color: inherit !important; font-weight: 500 !important; cursor: pointer; }
    .btn-add { position: absolute; bottom: 20px; right: 20px; width: 56px; height: 56px; background-color: white; border: 2px solid black; border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer; transition: background-color 0.3s ease, box-shadow 0.3s ease; user-select: none; }
    .btn-add:hover { background-color: #f3f4f6; }
    .btn-add svg { width: 32px; height: 32px; stroke: black; stroke-width: 3; }
  </style>
</head>
<body class="bg-white min-h-screen flex items-start justify-center p-4">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-6xl">
    <div class="w-full border border-gray-300 rounded-lg p-4">
      <div id="calendar">
        <div class="flex items-center justify-between bg-[#f0f7f2] p-3 rounded">
          <button id="prevBtn" class="text-[#31a35f] text-xl">&lt;</button>
          <h2 id="monthYear" class="text-[#31a35f] font-semibold text-lg"></h2>
          <button id="nextBtn" class="text-[#31a35f] text-xl">&gt;</button>
        </div>
        <div class="grid grid-cols-7 text-center mt-4 text-gray-500 font-medium">
          <div class="sunday">อา</div><div>จ</div><div>อ</div><div>พ</div><div>พฤ</div><div>ศ</div><div class="saturday">ส</div>
        </div>
        <div id="calendarDays" class="grid grid-cols-7 text-center mt-2 gap-1"></div>
      </div>
    </div>

    <div class="w-full border border-gray-300 rounded-lg p-4 relative bg-white flex flex-col justify-center items-center min-h-[400px]">
      <div class="btn-add" title="จองคิว" onclick="openModal()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
    </div>
  </div>


<!-- Modal ฟอร์มจอง (ไม่มี hover, focus ring ในช่องกรอก) -->
<div id="modalForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden p-4 overflow-auto">
  <div class="bg-white w-full max-w-2xl rounded-3xl shadow-xl p-8 space-y-4 border relative"
       style="max-height: 80vh; overflow-y: auto;">
    <button onclick="closeModal()" class="absolute top-2 right-4 text-gray-500 text-3xl font-bold">&times;</button>
    <h1 class="text-2xl font-bold text-black text-center">ฟอร์มจองห้องเรียน</h1>
    <div>
      <label class="block text-gray-700 font-medium mb-1">ชื่อ - นามสกุล</label>
      <input type="text" class="w-full border rounded-xl px-4 py-2 focus:outline-none" placeholder="กรอกชื่อ-นามสกุล" />
    </div>
    <div>
      <label class="block text-gray-700 font-medium mb-1">หัวข้อ</label>
      <input type="text" class="w-full border rounded-xl px-4 py-2 focus:outline-none" placeholder="เช่น การบรรยาย Anatomy" />
    </div>
    <div>
      <label class="block text-gray-700 font-medium mb-1">หมายเหตุ</label>
      <textarea rows="3" class="w-full border rounded-xl px-4 py-2 focus:outline-none" placeholder="รายละเอียดเพิ่มเติม (ถ้ามี)"></textarea>
    </div>
    <div>
      <label class="block text-gray-700 font-medium mb-1">เลือกวันที่</label>
      <input type="date" class="w-full border rounded-xl px-4 py-2 focus:outline-none" />
    </div>
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-gray-700 font-medium mb-1">เวลาเริ่มต้น</label>
        <input type="time" class="w-full border rounded-xl px-4 py-2 focus:outline-none" />
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-1">เวลาสิ้นสุด</label>
        <input type="time" class="w-full border rounded-xl px-4 py-2 focus:outline-none" />
      </div>
    </div>
    <div>
      <label class="block text-gray-700 font-medium mb-1">เลือกห้อง</label>
      <select class="w-full border rounded-xl px-4 py-2 ">
        <option>ห้อง 101</option>
        <option>ห้อง 102</option>
        <option disabled class="text-red-500">ห้อง 103 (ไม่ว่าง)</option>
        <option>ห้อง 104</option>
      </select>
    </div>
    <div class="text-center">
      <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-xl transition">ส่งคำขอจอง</button>
    </div>
  </div>
</div>




  <script>
    const calendarDays = document.getElementById("calendarDays");
    const monthYear = document.getElementById("monthYear");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const modal = document.getElementById("modalForm");

    function openModal() {
      modal.classList.remove("hidden");
    }

    function closeModal() {
      modal.classList.add("hidden");
    }

    const thaiMonths = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
    let currentDate = dayjs(); let selectedDayDiv = null;

    function renderCalendar() {
      const today = dayjs().startOf('day');
      const startOfMonth = currentDate.startOf("month"); const endOfMonth = currentDate.endOf("month");
      const startDay = startOfMonth.day(); const totalDays = endOfMonth.date();
      const prevMonth = currentDate.subtract(1,'month'); const endOfPrevMonth = prevMonth.endOf('month');
      const totalPrevDays = endOfPrevMonth.date(); const totalCells = 42;
      monthYear.textContent = `${thaiMonths[currentDate.month()]} ${currentDate.year()}`;
      calendarDays.innerHTML = "";
      for(let i=startDay-1;i>=0;i--){const div=document.createElement("div");div.textContent=totalPrevDays-i;div.classList.add("other-month");calendarDays.appendChild(div);}
      for(let day=1;day<=totalDays;day++){const div=document.createElement("div");div.textContent=day;div.classList.add("current-month");const dateObj=currentDate.date(day).startOf('day');if(day===today.date()&&currentDate.month()===today.month()&&currentDate.year()===today.year()){div.classList.add("today");}if(dateObj.day()===0)div.classList.add("sunday");if(dateObj.day()===6)div.classList.add("saturday");div.addEventListener("click",()=>{if(selectedDayDiv)selectedDayDiv.classList.remove("selected");div.classList.add("selected");selectedDayDiv=div;});calendarDays.appendChild(div);}
      const filledCells = calendarDays.children.length; const remainingCells = totalCells-filledCells; for(let i=1;i<=remainingCells;i++){const div=document.createElement("div");div.textContent=i;div.classList.add("other-month");calendarDays.appendChild(div);}
    }

    prevBtn.addEventListener("click",()=>{currentDate=currentDate.subtract(1,"month");selectedDayDiv=null;renderCalendar();});
    nextBtn.addEventListener("click",()=>{currentDate=currentDate.add(1,"month");selectedDayDiv=null;renderCalendar();});
    renderCalendar();
  </script>
</body>
</html>
