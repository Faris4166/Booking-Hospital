<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ฟอร์มจองห้อง</title>
    <title>MedBook</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="../image/logo.ico">
    <link rel="stylesheet" href="../css/font.css">

</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-xl p-8 space-y-6" x-data="formBooking()">
        <h1 class="text-3xl font-bold text-center text-indigo-600">ฟอร์มจองห้องเรียน</h1>

        <!-- ชื่อ -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">ชื่อ - นามสกุล</label>
            <input type="text" class="w-full border rounded-xl px-4 py-2" placeholder="ชื่อ - นามสกุล">
        </div>

        <!-- หัวข้อ -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">หัวข้อ</label>
            <input type="text" class="w-full border rounded-xl px-4 py-2" placeholder="หัวข้อการจอง">
        </div>

        <!-- เลือกวันและเวลาแบบอิสระ -->
        <div class="space-y-4">
            <template x-for="(entry, index) in bookingEntries" :key="index">
                <div class="border p-4 rounded-xl bg-gray-50 space-y-2 relative">
                    <button class="absolute top-2 right-2 text-red-500 hover:text-red-700"
                        @click="removeEntry(index)">ลบ</button>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">วันที่</label>
                        <input type="date" x-model="entry.date" class="w-full border rounded-xl px-4 py-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">เวลาเริ่ม</label>
                            <input type="time" x-model="entry.startTime" class="w-full border rounded-xl px-4 py-2" />
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">เวลาสิ้นสุด</label>
                            <input type="time" x-model="entry.endTime" class="w-full border rounded-xl px-4 py-2" />
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- ปุ่มเพิ่มช่วงเวลา -->
        <div class="text-center">
            <button @click="addEntry()" class="mt-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl">
                + เพิ่มวัน/เวลา
            </button>
        </div>

        <!-- เลือกห้อง -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">เลือกห้อง</label>
            <select class="w-full px-4 py-2 rounded-xl border">
                <option>ห้อง 101</option>
                <option>ห้อง 102</option>
                <option disabled class="text-red-500">ห้อง 103 (ไม่ว่าง)</option>
                <option>ห้อง 104</option>
            </select>
        </div>

        <!-- ปุ่มส่ง -->
        <div class="text-center pt-4">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl transition"
                @click="submitForm">
                ส่งคำขอจอง
            </button>
        </div>
    </div>

    <script>
        function formBooking() {
            return {
                bookingEntries: [
                    { date: '', startTime: '', endTime: '' }
                ],
                addEntry() {
                    this.bookingEntries.push({ date: '', startTime: '', endTime: '' });
                },
                removeEntry(index) {
                    this.bookingEntries.splice(index, 1);
                },
                submitForm() {
                    console.log('📅 ข้อมูลที่ส่ง:', this.bookingEntries);
                    alert('ส่งคำขอเรียบร้อย! ตรวจสอบ Console สำหรับข้อมูล');
                }
            };
        }
    </script>
</body>

</html>