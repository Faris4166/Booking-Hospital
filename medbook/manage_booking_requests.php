<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<link rel="stylesheet" href="../css/font.css">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include('../database/db.php');

// ดึงข้อมูลจาก room_tb
$sql = "SELECT * FROM room_tb";
$result = $conn->query($sql);

// รับพารามิเตอร์ success / error จาก URL
$success = isset($_GET['success']) ? $_GET['success'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;
?>

<div class="sm:ml-64 mt-10">
    <div class="w-full max-w-7xl bg-white rounded-xl shadow-lg p-6">
        <!-- หัวเรื่องและปุ่มเพิ่มห้อง -->
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">รายการจองห้อง</h1>
            <!-- ปุ่มเปิด modal -->
            <button onclick="openModal()" title="เพิ่มห้องใหม่"
                class="inline-flex items-center px-3 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                เพิ่มการจองห้อง
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 sticky top-0 z-10">
<tr>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Booking ID</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Room ID</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">User ID</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Topic</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Attendees</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Title</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Start Date</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">End Date</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Start Time</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">End Time</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Notes</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Create At</th>
        </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="px-2 py-2"><?= htmlspecialchars($row['room_id']) ?></td>
                            <td class="px-2 py-2"><?= htmlspecialchars($row['room_name']) ?></td>
                            <td class="px-2 py-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?= $row['room_status'] === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= htmlspecialchars($row['room_status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-2"><?= htmlspecialchars($row['description']) ?></td>
                            <td class="px-6 py-2"><?= htmlspecialchars($row['capacity']) ?></td>
                            <td class="px-6 py-2"><?= htmlspecialchars($row['location']) ?></td>
                            <td class="px-6 py-2">
                                <div class="flex space-x-4">
                                    <!-- ปุ่มแก้ไข -->
                                    <!-- ปุ่มแก้ไข -->
                                    <button onclick='openEditModal(<?= json_encode($row) ?>)' title="แก้ไข" class="text-yellow-500 hover:text-yellow-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>

                                    <!-- ปุ่มลบ -->
                                    <button onclick="confirmDelete(<?= $row['room_id'] ?>)" title="ลบ" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal เพิ่มห้อง -->
<div id="addRoomModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-xl p-6 relative shadow-lg">
        <h2 class="text-xl font-semibold mb-4">เพิ่มห้องใหม่</h2>
        <form action="add_room.php" method="POST">
            <div class="grid grid-cols-1 gap-4">
                <input type="text" name="room_name" placeholder="ชื่อห้อง" required class="border p-2 rounded w-full">
                <select name="room_status" required class="border p-2 rounded w-full">
                    <option value="">-- สถานะ --</option>
                    <option value="available">available</option>
                    <option value="unavailable">occupied</option>
                    <option value="maintenance">maintenance</option>
                    <option value="closed">closed</option>
                </select>
                <textarea name="description" placeholder="คำอธิบาย" class="border p-2 rounded w-full"></textarea>
                <input type="number" name="capacity" placeholder="ความจุ" required class="border p-2 rounded w-full">
                <input type="text" name="location" placeholder="สถานที่" required class="border p-2 rounded w-full">
            </div>
            <div class="flex justify-end mt-6 space-x-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">ยกเลิก</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">บันทึก</button>
            </div>
        </form>
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500" title="ปิด">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>


<div id="editRoomModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-xl p-6 relative shadow-lg">
        <h2 class="text-xl font-semibold mb-4">แก้ไขข้อมูลห้อง</h2>
        <form id="editRoomForm" method="POST" action="update_room.php">
            <input type="hidden" name="room_id" id="edit_room_id">
            <div class="grid grid-cols-1 gap-4">
                <input type="text" name="room_name" id="edit_room_name" required class="border p-2 rounded w-full">
                <select name="room_status" id="edit_room_status" required class="border p-2 rounded w-full">
                    <option value="available">available</option>
                    <option value="unavailable">occupied</option>
                    <option value="maintenance">maintenance</option>
                    <option value="closed">closed</option>
                </select>
                <textarea name="description" id="edit_description" class="border p-2 rounded w-full"></textarea>
                <input type="number" name="capacity" id="edit_capacity" required class="border p-2 rounded w-full">
                <input type="text" name="location" id="edit_location" required class="border p-2 rounded w-full">
            </div>
            <div class="flex justify-end mt-6 space-x-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">ยกเลิก</button>
                <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">บันทึกการแก้ไข</button>
            </div>
        </form>
        <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<!-- JavaScript เปิด/ปิด Modal และ SweetAlert2 -->
<script>
    function openModal() {
        document.getElementById('addRoomModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addRoomModal').classList.add('hidden');
    }

    // SweetAlert2 confirm ลบ
    function confirmDelete(roomId) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "การลบนี้ไม่สามารถย้อนกลับได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "delete_room.php?id=" + roomId;
            }
        });
    }

    // แสดง SweetAlert2 จากพารามิเตอร์ success / error
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($success): ?>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: <?= json_encode($success) ?>,
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        <?php endif; ?>

        <?php if ($error): ?>
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: <?= json_encode($error) ?>,
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        <?php endif; ?>
    });

    function openEditModal(data) {
        document.getElementById('edit_room_id').value = data.room_id;
        document.getElementById('edit_room_name').value = data.room_name;
        document.getElementById('edit_room_status').value = data.room_status;
        document.getElementById('edit_description').value = data.description;
        document.getElementById('edit_capacity').value = data.capacity;
        document.getElementById('edit_location').value = data.location;

        document.getElementById('editRoomModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editRoomModal').classList.add('hidden');
    }
</script>

</html>