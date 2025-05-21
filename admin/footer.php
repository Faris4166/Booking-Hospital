<!-- End Plum -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // ดึงค่าจาก PHP
    const lastWeekVisitors = <?php echo json_encode($last_week_visitors); ?>;
    const thisWeekVisitors = <?php echo json_encode($weekly_visitors); ?>;

    // กำหนดข้อมูลสำหรับแผนภูมิ
    const data = {
        labels: ['สัปดาห์ที่แล้ว', 'สัปดาห์นี้'],
        datasets: [{
            label: 'จำนวนผู้เข้าชม',
            data: [lastWeekVisitors, thisWeekVisitors],
            backgroundColor: [
                'rgba(75, 192, 192, 0.6)',
                'rgba(54, 162, 235, 0.6)'
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    };

    // ตัวเลือกของแผนภูมิ
    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    };

    // แสดงแผนภูมิใน <canvas id="visitorsChart">
    const visitorsChart = new Chart(
        document.getElementById('visitorsChart'),
        config
    );
</script>

<!-- สคริปต์และไลบรารีอื่น ๆ -->
<script src="../admin/js/app.js"></script>
<script src="../js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="../fontawesome/js/all.min.js"></script>
<script src="../sweetalert2/sweetalert2.all.min.js"></script>
</body>
</html>
