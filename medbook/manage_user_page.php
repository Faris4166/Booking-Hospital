<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<link rel="stylesheet" href="../css/font.css">
<div class="sm:ml-64 mt-10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include('../database/db.php');

// ดึงข้อมูลผู้ใช้ทั้งหมด
$sql = "SELECT * FROM user_tb";
$result = $conn->query($sql);
?>

<div class="w-full max-w-7xl bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">จัดการผู้ใช้</h1>
        <button onclick="openAddUserModal()" class="flex items-center space-x-1 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>เพิ่มผู้ใช้</span>
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-200">
            <thead class="bg-gray-100 text-left text-gray-600">
                <tr>
                    <th class="px-4 py-2 text-xs font-medium uppercase">ID</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">Username</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">Email</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">เบอร์โทร</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">Line ID</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">เพศ</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">บทบาท</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">ยืนยันแล้ว</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">สร้างเมื่อ</th>
                    <th class="px-4 py-2 text-xs font-medium uppercase">การกระทำ</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="px-4 py-2"><?= $row['user_id'] ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($row['username']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($row['email']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($row['tel']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($row['line_id']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($row['gender']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($row['role']) ?></td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs font-medium rounded 
                            <?= $row['is_verified'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                            <?= $row['is_verified'] ? 'ใช่' : 'ไม่ใช่' ?>
                        </span>
                    </td>
                    <td class="px-4 py-2"><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
                    <td class="px-4 py-2">
                        <div class="flex items-center space-x-2">
                            <button onclick='openEditUserModal(<?= json_encode($row) ?>)' class="text-yellow-500 hover:text-yellow-700" title="แก้ไข">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M4 20h4.586a1 1 0 00.707-.293l10.586-10.586a1 1 0 000-1.414l-3.586-3.586a1 1 0 00-1.414 0L4 16.586V20z"/>
                                </svg>
                            </button>
                            <button onclick="confirmDeleteUser(<?= $row['user_id'] ?>)" class="text-red-500 hover:text-red-700" title="ลบ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="userModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-xl w-full max-w-xl p-6 shadow-xl relative">
            <h2 id="userModalTitle" class="text-xl font-bold mb-4">เพิ่มผู้ใช้</h2>
            <form id="userForm" action="add_user.php" method="POST">
                <input type="hidden" name="user_id" id="user_id">
                <div class="grid gap-4">
                    <input type="text" name="username" id="username" placeholder="Username" required class="border p-2 rounded w-full">
                    <input type="email" name="email" id="email" placeholder="Email" required class="border p-2 rounded w-full">
                    <input type="password" name="password" id="password" placeholder="Password" class="border p-2 rounded w-full">
                    <input type="text" name="tel" id="tel" placeholder="เบอร์โทร" class="border p-2 rounded w-full">
                    <input type="text" name="line_id" id="line_id" placeholder="Line ID" class="border p-2 rounded w-full">
                    <select name="gender" id="gender" required class="border p-2 rounded w-full">
                        <option value="">-- เพศ --</option>
                        <option value="male">ชาย</option>
                        <option value="female">หญิง</option>
                        <option value="other">อื่นๆ</option>
                    </select>
                    <select name="role" id="role" required class="border p-2 rounded w-full">
                        <option value="">-- บทบาท --</option>
                        <option value="admin">แอดมิน</option>
                        <option value="user">ผู้ใช้</option>
                    </select>
                    <select name="is_verified" id="is_verified" required class="border p-2 rounded w-full">
                        <option value="">-- ยืนยันตัวตน --</option>
                        <option value="1">ใช่</option>
                        <option value="0">ไม่ใช่</option>
                    </select>
                </div>
                <div class="flex justify-end mt-6 space-x-2">
                    <button type="button" onclick="closeUserModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">บันทึก</button>
                </div>
            </form>
            <button onclick="closeUserModal()" class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>
</div>ss

<script>
function openAddUserModal() {
    document.getElementById('userForm').reset();
    document.getElementById('userModalTitle').innerText = 'เพิ่มผู้ใช้';
    document.getElementById('userForm').action = 'add_user.php';
    document.getElementById('user_id').value = '';
    document.getElementById('password').required = true;
    document.getElementById('userModal').classList.remove('hidden');
}

function openEditUserModal(data) {
    document.getElementById('userForm').reset();
    document.getElementById('userModalTitle').innerText = 'แก้ไขผู้ใช้';
    document.getElementById('userForm').action = 'edit_user.php';
    document.getElementById('user_id').value = data.user_id;
    document.getElementById('username').value = data.username;
    document.getElementById('email').value = data.email;
    document.getElementById('tel').value = data.tel;
    document.getElementById('line_id').value = data.line_id;
    document.getElementById('gender').value = data.gender;
    document.getElementById('role').value = data.role;
    document.getElementById('is_verified').value = data.is_verified;
    document.getElementById('password').value = '';
    document.getElementById('password').required = false;
    document.getElementById('userModal').classList.remove('hidden');
}

function closeUserModal() {
    document.getElementById('userModal').classList.add('hidden');
}

function confirmDeleteUser(userId) {
    Swal.fire({
        title: 'แน่ใจหรือไม่?',
        text: "คุณต้องการลบผู้ใช้นี้?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete_user.php?id=' + userId;
        }
    });
}
</script>

<?php if (isset($_GET['success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ',
    text: <?= json_encode($_GET['success']) ?>,
    confirmButtonText: 'ตกลง'
});
</script>
<?php elseif (isset($_GET['error'])): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'เกิดข้อผิดพลาด',
    text: <?= json_encode($_GET['error']) ?>,
    confirmButtonText: 'ตกลง'
});
</script>
<?php endif; ?>