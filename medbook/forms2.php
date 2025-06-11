<div class="flex flex-col items-center justify-center space-y-4">
  <h2 class="text-xl font-bold text-center text-gray-700">เลือกห้องเพื่อยืนยันการจอง</h2>

  <!-- กล่องห้องเรียน -->
  <div class="space-y-4 w-full">
    <!-- ห้อง 1 -->
    <div class="room-option border border-gray-300 rounded-lg p-4 hover:border-blue-500 cursor-pointer transition-all">
      <p class="font-semibold">ห้อง: 101</p>
      <p>หัวข้อ: เวชศาสตร์ครอบครัว</p>
      <p>วันที่: 12 มิถุนายน 2025</p>
      <p>เวลา: 09:00 - 12:00</p>
    </div>

    <!-- ห้อง 2 -->
    <div class="room-option border border-gray-300 rounded-lg p-4 hover:border-blue-500 cursor-pointer transition-all">
      <p class="font-semibold">ห้อง: 202</p>
      <p>หัวข้อ: อายุรศาสตร์</p>
      <p>วันที่: 12 มิถุนายน 2025</p>
      <p>เวลา: 13:00 - 16:00</p>
    </div>
  </div>

  <!-- ปุ่มยืนยัน -->
  <button id="confirmBtn"
    class="bg-blue-600 text-white px-6 py-2 rounded disabled:opacity-50 disabled:cursor-not-allowed" disabled>
    ยืนยันการจองห้อง
  </button>

  <!-- ข้อความหลังยืนยัน -->
  <div id="confirmationMessage" class="hidden text-green-600 font-medium text-center"></div>
</div>

<script>
  // ให้สคริปต์นี้อยู่ใน forms2.php
  document.addEventListener('DOMContentLoaded', function () {
    const confirmBtn = document.getElementById('confirmBtn');
    const confirmationMessage = document.getElementById('confirmationMessage');
    let selectedRoom = null;

    document.querySelectorAll('.room-option').forEach(room => {
      room.addEventListener('click', () => {
        document.querySelectorAll('.room-option').forEach(r => {
          r.classList.remove('border-blue-500', 'bg-blue-50');
        });

        room.classList.add('border-blue-500', 'bg-blue-50');
        selectedRoom = room;
        confirmBtn.disabled = false;
      });
    });

    confirmBtn.addEventListener('click', () => {
      if (!selectedRoom) return;

      const roomName = selectedRoom.querySelector('p').textContent;
      confirmationMessage.textContent = `${roomName} ได้รับการยืนยันเรียบร้อยแล้ว`;
      confirmationMessage.classList.remove('hidden');

      confirmBtn.disabled = true;
      selectedRoom.classList.add('border-green-500');
    });
  });
</script>