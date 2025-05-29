<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ฟอร์มจองห้องเรียน - MedBook</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://unpkg.com/@headlessui/vue@latest/dist/headlessui.umd.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" />
  <style>
    body {
      font-family: 'Kanit', sans-serif;
    }

    .modal-enter-active,
    .modal-leave-active {
      transition: all 0.3s ease;
    }

    .modal-enter-from,
    .modal-leave-to {
      opacity: 0;
      transform: scale(0.95);
    }
  </style>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center p-6">
  <div class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl p-10 space-y-6" x-data="formBooking()">
    <h1 class="text-4xl font-bold text-center text-indigo-700 mb-4">ฟอร์มจองห้องเรียน</h1>

    <!-- ชื่อ -->
    <div>
      <label class="block text-gray-700 font-medium mb-1">👤 ชื่อ - นามสกุล</label>
      <input type="text" x-model="fullName"
        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 outline-none"
        placeholder="ชื่อ - นามสกุล">
    </div>

    <!-- หัวข้อ -->
    <div>
      <label class="block text-gray-700 font-medium mb-1">📌 หัวข้อ</label>
      <input type="text" x-model="topic"
        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 outline-none"
        placeholder="หัวข้อการจอง">
    </div>

    <!-- วันและเวลา -->
    <div class="space-y-4">
      <template x-for="(entry, index) in bookingEntries" :key="index">
        <div class="border p-4 rounded-2xl bg-gray-50 space-y-3 relative">
          <button class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-sm"
            @click="removeEntry(index)">ลบ</button>

          <div>
            <label class="block text-gray-700 font-medium mb-1">📅 วันที่</label>
            <input type="date" x-model="entry.date"
              class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400 outline-none" />
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-700 font-medium mb-1">⏰ เวลาเริ่ม</label>
              <input type="time" step="60" x-model="entry.startTime"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400 outline-none" />
            </div>
            <div>
              <label class="block text-gray-700 font-medium mb-1">⏳ เวลาสิ้นสุด</label>
              <input type="time" step="60" x-model="entry.endTime"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400 outline-none" />
            </div>
          </div>
        </div>
      </template>
    </div>

    <!-- ปุ่มเพิ่มช่วงเวลา -->
    <div class="text-center">
      <button @click="addEntry()"
        class="mt-2 px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl transition duration-200">
        ➕ เพิ่มวัน/เวลา
      </button>
    </div>

    <!-- เลือกห้อง -->
    <div>
      <label class="block text-gray-700 font-medium mb-1">🏫 เลือกห้อง</label>
      <select x-model="room"
        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-400 outline-none">
        <option value="">-- เลือกห้อง --</option>
        <option>ห้อง 101</option>
        <option>ห้อง 102</option>
        <option disabled class="text-red-500">ห้อง 103 (ไม่ว่าง)</option>
        <option>ห้อง 104</option>
      </select>
    </div>

    <!-- ปุ่มส่ง -->
    <div class="text-center pt-6">
      <button
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl text-lg shadow-md transition"
        @click="submitForm">
        📤 ส่งคำขอจอง
      </button>
    </div>

    <!-- Popup ยืนยัน -->
    <div x-show="showConfirm"
      class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 transition" x-transition>
      <div class="bg-white p-6 rounded-2xl shadow-xl space-y-4 max-w-sm text-center w-full mx-4">
        <h2 class="text-lg font-semibold text-indigo-700">ยืนยันการจอง</h2>
        <p class="text-gray-600">คุณต้องการยืนยันการจองห้องใช่หรือไม่?</p>
        <div class="flex justify-center gap-4 pt-2">
          <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded" @click="showConfirm = false">ยกเลิก</button>
          <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
            @click="confirmBooking">ยืนยัน</button>
        </div>
      </div>
    </div>

    <!-- Popup สำเร็จ -->
    <div x-show="showSuccess"
      class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 transition" x-transition>
      <div class="bg-white p-6 rounded-2xl shadow-xl space-y-4 max-w-sm text-center w-full mx-4">
        <h2 class="text-green-600 font-semibold text-xl">✅ จองห้องสำเร็จ!</h2>
        <p class="text-gray-600">ระบบได้บันทึกคำขอของคุณแล้ว</p>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded mt-2"
          @click="showSuccess = false">ปิด</button>
      </div>
    </div>
  </div>

  <script>
    function formBooking() {
      return {
        fullName: '',
        topic: '',
        room: '',
        bookingEntries: [
          { date: '', startTime: '', endTime: '' }
        ],
        showConfirm: false,
        showSuccess: false,

        addEntry() {
          this.bookingEntries.push({ date: '', startTime: '', endTime: '' });
        },
        removeEntry(index) {
          this.bookingEntries.splice(index, 1);
        },
        submitForm() {
          if (!this.fullName || !this.topic || !this.room) {
            alert('❗ กรุณากรอกข้อมูลให้ครบทุกช่อง');
            return;
          }

          for (let entry of this.bookingEntries) {
            if (!entry.date || !entry.startTime || !entry.endTime) {
              alert('❗ กรุณากรอกวันที่และเวลาให้ครบทุกช่วง');
              return;
            }
          }

          this.showConfirm = true;
        },
        confirmBooking() {
          this.showConfirm = false;
          this.showSuccess = true;
          console.log('📅 ข้อมูลที่ส่ง:', {
            ชื่อ: this.fullName,
            หัวข้อ: this.topic,
            ห้อง: this.room,
            รายการจอง: this.bookingEntries
          });
        }
      };
    }
  </script>
</body>

</html>
