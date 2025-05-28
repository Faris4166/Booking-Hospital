<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MedBook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../image/logo.ico">
    <link rel="stylesheet" href="../css/font.css">

</head>

<body class="bg-gradient-to-br from-indigo-100 to-white min-h-screen flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-2xl rounded-3xl shadow-xl p-8 space-y-6 border">
        <h1 class="text-3xl font-bold text-indigo-700 text-center">ฟอร์มจองห้องเรียน</h1>

        <!-- ชื่อ-นามสกุล -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">ชื่อ - นามสกุล</label>
            <input type="text" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400"
                placeholder="กรอกชื่อ-นามสกุล">
        </div>

        <!-- หัวข้อ -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">หัวข้อ</label>
            <input type="text" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400"
                placeholder="เช่น การบรรยาย Anatomy">
        </div>

        <!-- หมายเหตุ -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">หมายเหตุ</label>
            <textarea rows="3" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400"
                placeholder="รายละเอียดเพิ่มเติม (ถ้ามี)"></textarea>
        </div>

        <!-- วันที่ -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">เลือกวันที่</label>
            <input type="date" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400">
        </div>

        <!-- เลือกเวลาช่วงอิสระ -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">เวลาเริ่มต้น</label>
                <input type="time" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">เวลาสิ้นสุด</label>
                <input type="time" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400">
            </div>
        </div>

        <!-- เลือกห้อง -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">เลือกห้อง</label>
            <select class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400">
                <option>ห้อง 101</option>
                <option>ห้อง 102</option>
                <option disabled class="text-red-500">ห้อง 103 (ไม่ว่าง)</option>
                <option>ห้อง 104</option>
            </select>
        </div>

        <!-- ปุ่มส่ง -->
        <div class="text-center">
            <button
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-xl transition">ส่งคำขอจอง</button>
        </div>
    </div>
</body>

</html>