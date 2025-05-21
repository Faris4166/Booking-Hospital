<?php
// เริ่ม session และบันทึกผู้เข้าชม
session_start();

// โหลด header (ภายใน header.php จะ include SiteStatistics และเรียก recordVisitor())
include_once 'header.php';

// โหลด component สำหรับแสดงสถิติ
include_once __DIR__ . '/components/site_statistics.php';

// ตรวจสอบและสร้างตารางที่จำเป็น (visitors, sessions, page_views)
createNecessaryTables($db);

// เตรียมข้อมูลสถิติสำหรับแสดงบน Dashboard
$stats               = new SiteStatistics($db);
$weekly_visitors     = $stats->getWeeklyVisitors();
$last_week_visitors  = $stats->getLastWeekVisitors();
$avg_session_time    = $stats->getAverageSessionTime();
$user_count          = $stats->getUserCount();

$weekly_change       = $stats->calculatePercentChange($weekly_visitors, $last_week_visitors);
$week_number         = $stats->getCurrentWeekNumber();
$current_year        = $stats->getCurrentYear();
$current_month       = $stats->getCurrentMonthName();

$weekly_change_icon  = $weekly_change >= 0 ? 'bi-arrow-up-short' : 'bi-arrow-down-short';
$weekly_change_text  = $weekly_change >= 0 ? 'เพิ่มขึ้น' : 'ลดลง';
$weekly_change_abs   = abs($weekly_change);

// เปอร์เซ็นต์สมมติสำหรับเวลาเฉลี่ยต่อเซสชัน (ปรับดึงจริงได้ตามต้องการ)
$session_change        = 12;
$session_change_icon   = $session_change >= 0 ? 'bi-arrow-up-short' : 'bi-arrow-down-short';
$session_change_text   = $session_change >= 0 ? 'เพิ่มขึ้น' : 'ลดลง';
$session_change_abs    = abs($session_change);

$current_date = date("d/m/Y");
$current_time = date("H:i:s");
?>

<style>

</style>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- ผู้เข้าชมสัปดาห์นี้ -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-gradient-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-white">ผู้เข้าชมสัปดาห์นี้</h5>
                            <h2 class="text-white"><?php echo number_format($weekly_visitors); ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-graph-up text-white fs-1 opacity-75"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-white">
                            <i class="bi <?php echo $weekly_change_icon; ?>"></i>
                            <?php echo $weekly_change_abs; ?>% <?php echo $weekly_change_text; ?>จากสัปดาห์ที่แล้ว
                        </span>
                        <div class="mt-2 small text-white-50">
                            สัปดาห์ที่ <?php echo $week_number; ?> ปี <?php echo $current_year; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- เวลาเฉลี่ยต่อเซสชัน -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-gradient-warning h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-white">เวลาเฉลี่ยต่อเซสชัน</h5>
                            <h2 class="text-white"><?php echo $avg_session_time; ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-clock text-white fs-1 opacity-75"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-white">
                            <i class="bi <?php echo $session_change_icon; ?>"></i>
                            <?php echo $session_change_abs; ?>% <?php echo $session_change_text; ?>จากเดือนที่แล้ว
                        </span>
                        <div class="mt-2 small text-white-50">
                            ข้อมูลสรุป <?php echo $current_month; ?> <?php echo $current_year; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- จำนวนบัญชีผู้ใช้ -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-gradient-danger h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-white">จำนวนบัญชีผู้ใช้</h5>
                            <h2 class="text-white"><?php echo number_format($user_count); ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-people text-white fs-1 opacity-75"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-white">จำนวนบัญชีในระบบ</span>
                        <div class="mt-2 small text-white-50">ข้อมูลที่อัปเดตล่าสุด</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- วันที่และเวลาปัจจุบัน -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card bg-gradient-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-white">วันที่และเวลาปัจจุบัน</h5>
                            <h2 class="text-white" id="current-time"><?php echo $current_time; ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-calendar-check text-white fs-1 opacity-75"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-white" id="current-date"><?php echo $current_date; ?></span>
                        <div class="mt-2 small text-white-50">เวลาประเทศไทย (GMT+7)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- แผนภูมิเปรียบเทียบ -->
    <div class="row">
        <div class="col-12">
            <div class="card rounded-4 text-white mb-4">
                <div class="card-header rounded-top-4">
                    <h5 class="card-title">เปรียบเทียบจำนวนผู้เข้าชม</h5>
                </div>
                <div class="card-body">
                    <canvas id="visitorsChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>