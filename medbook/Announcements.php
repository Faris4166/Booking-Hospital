<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4 sm:ml-64 mt-10">
  <div class="w-full max-w-3xl p-6 space-y-4">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">การแจ้งเตือน</h1>

    <!-- การแจ้งเตือน: สำเร็จ -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between bg-green-100 border border-green-300 rounded-xl p-4 shadow">
      <div>
        <p class="text-lg font-semibold text-green-800">ชื่อห้อง: ห้องประชุม A</p>
        <p class="text-sm text-gray-700">วันที่: 10 มิถุนายน 2025</p>
        <p class="text-sm text-gray-700">หมายเหตุ: อนุมัติเรียบร้อย</p>
      </div>
      <div class="mt-2 md:mt-0 text-green-800 font-bold text-lg md:text-right">
         สำเร็จ
      </div>
    </div>

    <!-- การแจ้งเตือน: ไม่สำเร็จ -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between bg-red-100 border border-red-300 rounded-xl p-4 shadow">
      <div>
        <p class="text-lg font-semibold text-red-800">ชื่อห้อง: ห้องเรียน 202</p>
        <p class="text-sm text-gray-700">วันที่: 9 มิถุนายน 2025</p>
        <p class="text-sm text-gray-700">หมายเหตุ: ห้องไม่ว่างในวันเวลาดังกล่าว</p>
      </div>
      <div class="mt-2 md:mt-0 text-red-800 font-bold text-lg md:text-right">
         ไม่สำเร็จ
      </div>
    </div>
  </div>
</div>

</body>
</html>