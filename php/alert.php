<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Basic Modal with Tailwind</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

  <!-- ปุ่มเปิด Modal -->
  <button
    id="openModalBtn"
    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
  >
    เปิด Modal
  </button>

  <!-- Modal -->
  <div
    id="modal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
  >
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
      <!-- ปุ่มปิด -->
      <button
        id="closeModalBtn"
        class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
        aria-label="Close modal"
      >
        &times;
      </button>

      <h2 class="text-xl font-semibold mb-4">หัวข้อ Modal</h2>
      <p class="text-gray-700 mb-6">
        นี่คือตัวอย่าง modal แบบเรียบง่ายที่สร้างด้วย Tailwind CSS
      </p>
      <button
        id="closeModalBtn2"
        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition"
      >
        ปิด
      </button>
    </div>
  </div>

  <script>
    const modal = document.getElementById("modal");
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const closeModalBtn2 = document.getElementById("closeModalBtn2");

    function openModal() {
      modal.classList.remove("hidden");
    }

    function closeModal() {
      modal.classList.add("hidden");
    }

    openModalBtn.addEventListener("click", openModal);
    closeModalBtn.addEventListener("click", closeModal);
    closeModalBtn2.addEventListener("click", closeModal);

    // ปิด modal เมื่อคลิกรอบนอกกล่อง
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        closeModal();
      }
    });

    // ปิด modal เมื่อกดปุ่ม Esc
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !modal.classList.contains("hidden")) {
        closeModal();
      }
    });
  </script>

</body>
</html>
