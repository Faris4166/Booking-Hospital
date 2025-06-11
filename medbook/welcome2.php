<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MedBook</title>
  <link rel="stylesheet" href="../css/font.css">
  <link rel="icon" href="../image/logoico">
</head>


<body>

  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="max-w-4xl w-full px-1 py-10 space-y-8">

      <!-- Section: Welcome -->
      <div class="text-center space-y-2">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800">ยินดีต้อนรับ</h1>
        <p class="text-lg text-gray-600">ชื่อผู้ใช้: <span class="font-semibold">นพ. ธนกร พงษ์พิทักษ์</span></p>
      </div>

      <!-- Section: Actions -->
      <div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0 justify-center">
        <!-- จองห้อง -->
        <a href="forms.php">
          <div
            class="flex-1 bg-blue-100 hover:bg-blue-200 transition rounded-2xl shadow p-6 text-center cursor-pointer max-w-md mx-auto">
            <h2 class="text-xl font-semibold text-blue-900">จองห้องเลยไหม?</h2>
            <p class="text-gray-700 mt-2">เริ่มจองห้องเรียนสำหรับกิจกรรมของคุณได้ทันที</p>
          </div>
        </a>

        <!-- ดูประวัติ -->
        <div
          class="flex-1 bg-green-100 hover:bg-green-200 transition rounded-2xl shadow p-6 text-center cursor-pointer max-w-md mx-auto">
          <h2 class="text-xl font-semibold text-green-900">ดูประวัติการจอง</h2>
          <p class="text-gray-700 mt-2">ดูข้อมูลห้องที่คุณเคยจองไว้</p>
        </div>
      </div>

    </div>
  </div>


</body>

</html>