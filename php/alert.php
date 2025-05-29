<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ฟอร์มจองห้อง</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 flex justify-center items-start">
  <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-3xl space-y-6" x-data="bookingForm()">
    <h1 class="text-2xl font-bold text-indigo-700 text-center">ฟอร์มจองห้องเรียน</h1>

    <!-- ชื่อ -->
    <div>
      <label class="block font-medium text-gray-700 mb-1">ชื่อ - นามสกุล</label>
      <input type="text" x-model="fullName" class="w-full border px-4 py-2 rounded-xl" placeholder="ชื่อ - นามสกุล">
    </div>

    <!-- หัวข้อ -->
    <div>
      <label class="block font-medium text-gray-700 mb-1">หัวข้อ</label>
      <input type="text" x-model="subject" class="w-full border px-4 py-2 rounded-xl" placeholder="หัวข้อ">
    </div>

    <!-- หมายเหตุ -->
    <div>
      <label class="block font-medium text-gray-700 mb-1">หมายเหตุ</label>
      <textarea x-model="note" class="w-full border px-4 py-2 rounded-xl" placeholder="หมายเหตุเพิ่มเติม"></textarea>
    </div>

    <!-- จองหลายวัน -->
    <div>
      <h2 class="text-lg font-semibold text-indigo-600 mt-6 mb-2">📅 จองหลายวัน พร้อมช่วงเวลา</h2>

      <template x-for="(entry, index) in entries" :key="index">
        <div class="bg-gray-50 border rounded-xl p-4 relative space-y-4 mt-3">
          <button class="absolute top-2 right-2 text-red-500 hover:text-red-700" @click="removeEntry(index)">ลบ</button>

          <!-- วันที่ -->
          <div>
            <label class="block text-gray-700 font-medium mb-1">วันที่</label>
            <input type="date" x-model="entry.date" class="w-full border px-4 py-2 rounded-xl" />
          </div>

          <!-- เวลาเริ่ม -->
          <div>
            <label class="block text-gray-700 font-medium mb-1">เวลาเริ่ม</label>
            <input type="time" x-model="entry.startTime" class="w-full border px-4 py-2 rounded-xl" />
          </div>

          <!-- เวลาสิ้นสุด -->
          <div>
            <label class="block text-gray-700 font-medium mb-1">เวลาสิ้นสุด</label>
            <input type="time" x-model="entry.endTime" class="w-full border px-4 py-2 rounded-xl" />
          </div>
        </div>
      </template>

      <div class="text-center mt-4">
        <button @click="addEntry()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl">
          + เพิ่มวัน/เวลา
        </button>
      </div>
    </div>

    <!-- จองวันเดียว -->
    <div class="bg-blue-50 border rounded-xl p-4 space-y-4 mt-8">
      <h2 class="text-lg font-semibold text-blue-700">🗓️ จองแบบวันเดียว เวลาเดียว</h2>

      <!-- วันที่ -->
      <div>
        <label class="block text-gray-700 font-medium mb-1">วันที่</label>
        <input type="date" x-model="singleEntry.date" class="w-full border px-4 py-2 rounded-xl" />
      </div>

      <!-- เวลา -->
      <div>
        <label class="block text-gray-700 font-medium mb-1">เวลา</label>
        <input type="time" x-model="singleEntry.time" class="w-full border px-4 py-2 rounded-xl" />
      </div>
    </div>

    <!-- ปุ่มส่ง -->
    <div class="text-center mt-6">
      <button @click="submitForm()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl">
        ✅ ส่งคำขอจอง
      </button>
    </div>
  </div>

  <script>
    function bookingForm() {
      return {
        fullName: '',
        subject: '',
        note: '',
        entries: [
          { date: '', startTime: '08:00', endTime: '10:00' }
        ],
        singleEntry: {
          date: '',
          time: '08:00'
        },
        addEntry() {
          this.entries.push({ date: '', startTime: '08:00', endTime: '10:00' });
        },
        removeEntry(index) {
          this.entries.splice(index, 1);
        },
        submitForm() {
          console.log('👤 ชื่อ:', this.fullName);
          console.log('📝 หัวข้อ:', this.subject);
          console.log('🗒️ หมายเหตุ:', this.note);
          console.log('📅 จองหลายวัน:', this.entries);
          console.log('🗓️ จองแบบวันเดียว:', this.singleEntry);
          alert('✅ ส่งข้อมูลสำเร็จ! ดูข้อมูลใน Console (F12)');
        }
      }
    }
  </script>
</body>
</html>
