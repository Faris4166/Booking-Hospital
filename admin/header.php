<?php
// 1. เริ่ม session ก่อนอื่นเลย (ต้องอยู่ก่อนหน้า output ใดๆ)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. ตรวจสอบสิทธิ์ admin (ถ้าจำเป็น)
if (!isset($_SESSION['admin'])) {
    $_SESSION['access_denied'] = "คุณไม่มีสิทธิ์เข้าถึงหน้าแอดมิน";
    header("Location: ../index.php");
    exit;
}

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Primary Meta Tags -->
    <title>แผนกเทคโนโลยีสารสนเทศ — วิทยาลัยอาชีวศึกษานครศรีธรรมราช</title>
    <meta name="title" content="แผนกเทคโนโลยีสารสนเทศ  —  วิทยาลัยอาชีวศึกษานครศรีธรรมราช" />
    <meta name="description" content="สาขาวิชาเทคโนโลยีสารสนเทศ :  มุ่งเน้นไปที่การศึกษาและฝึกฝนทักษะที่จำเป็นในการออกแบบ พัฒนา จัดการ และประยุกต์ใช้เทคโนโลยีสารสนเทศเพื่อตอบสนองความต้องการขององค์กรและสังคม" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $urlz; ?>" />
    <meta property="og:title" content="แผนกเทคโนโลยีสารสนเทศ  —  วิทยาลัยอาชีวศึกษานครศรีธรรมราช" />
    <meta property="og:description" content="สาขาวิชาเทคโนโลยีสารสนเทศ :  มุ่งเน้นไปที่การศึกษาและฝึกฝนทักษะที่จำเป็นในการออกแบบ พัฒนา จัดการ และประยุกต์ใช้เทคโนโลยีสารสนเทศเพื่อตอบสนองความต้องการขององค์กรและสังคม" />
    <meta property="og:image" content="/image/assets/IT.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo $url; ?>" />
    <meta property="twitter:title" content="แผนกเทคโนโลยีสารสนเทศ  —  วิทยาลัยอาชีวศึกษานครศรีธรรมราช" />
    <meta property="twitter:description" content="สาขาวิชาเทคโนโลยีสารสนเทศ :  มุ่งเน้นไปที่การศึกษาและฝึกฝนทักษะที่จำเป็นในการออกแบบ พัฒนา จัดการ และประยุกต์ใช้เทคโนโลยีสารสนเทศเพื่อตอบสนองความต้องการขององค์กรและสังคม" />
    <meta property="twitter:image" content="https://metatags.io/images/meta-tags.png" />
    <!-- นำเข้าไฟล์ bootstrap css. -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <!-- icon website -->
    <link rel="shortcut icon" href="image/assets/logo-it.png" type="image/x-icon" />
    <!-- นำเข้าไฟล์ bootstrap icons. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- นำเข้าไฟล์ aos.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.css" rel="stylesheet" />
    <!-- นำเข้าไฟล์ font-awesome icon -->
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <!-- นำเข้าไฟล์ sweetalert2 icon -->
    <link rel="stylesheet" href="../sweetalert2/sweetalert2.min.css">
    <!-- นำเข้า Iconscout icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    <!-- นำเข้า Jquery -->
    <script src="js/jquery.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center">
            <h4 class="m-0 text-white ">Admin Dasboard <i class="bi bi-exclamation-circle"></i></h4>
            <button id="sidebarToggle" class="d-lg-none">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <a href="index" class="sidebar-item">
                <i class="bi bi-speedometer2"></i> หน้าหลัก
            </a>
            <a href="personal" class="sidebar-item">
                <i class="bi bi-person-arms-up"></i> จัดการข้อมูลบุคลากร
            </a>
            <a href="committee" class="sidebar-item">
                <i class="bi bi-people-fill"></i>จัดการข้อมูลคณะกรรมการ
            </a>
            
        </div>
    </div>

    <!-- Main Content -->
    <div class="content" id="content">
        <!-- Navbar -->
           <nav class="navbar navbar-expand-lg navbar-dark mb-4 rounded-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="index">
                <img src="../image/assets/Information Technology.png" width="85%" height="85%" alt="Logo" class="d-inline-block align-text-center object-fit-cover" />
            </a>
            <!-- ปุ่มสำหรับเปิด/ปิด Sidebar -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar"
                aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <?php if (!isset($_SESSION['login'])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white nav-link-hover" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                สมาชิก
                                <i class="fa-solid fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-center bg-navy animate slideIn dropdown-menu-dark" >
                                <li><a class="dropdown-item" href="../login.php"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;เข้าสู่ระบบ</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white nav-link-hover" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class='me-2 my-auto'><?= $_SESSION['username'] ?></span>
                                <span class="fa-solid fa-chevron-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-center bg-navy animate slideIn dropdown-menu-dark">
                                <li><a href="../logout" class="dropdown-item"><i class="fa-solid fa-power-off"></i>&nbsp;ออกจากระบบ</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>