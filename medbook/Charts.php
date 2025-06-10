<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<body class="pt-10 sm:pt-10 sm:ml-64 mt-10">

  <canvas id="myChart" style="width:500px; height:300px;"></canvas>

  <script>
    var xValues = [
      "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
      "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
    ];
    var yValues = [
      60, 65, 75, 80, 70, 55, // ม.ค. - มิ.ย.
      95, 90, 50, 55, 60, 65  // ก.ค. - ธ.ค.
    ];
    var barColors = [
      // ฤดูหนาว (พ.ย. - ก.พ.)
      "#ADD8E6", // มกราคม (Light Blue)
      "#87CEEB", // กุมภาพันธ์ (Sky Blue)
      // ฤดูร้อน (มี.ค. - พ.ค.)
      "#FF6347", // มีนาคม (Tomato Red)
      "#FFA07A", // เมษายน (Light Salmon)
      "#FFD700", // พฤษภาคม (Gold)
      // ฤดูฝน (มิ.ย. - ต.ค.)
      "#3CB371", // มิถุนายน (Medium Sea Green)
      "#6A5ACD", // กรกฎาคม (Slate Blue)
      "#4682B4", // สิงหาคม (Steel Blue)
      "#20B2AA", // กันยายน (Light Sea Green)
      "#48D1CC", // ตุลาคม (Medium Turquoise)
      // ฤดูหนาว (พ.ย. - ก.พ.)
      "#9370DB", // พฤศจิกายน (Medium Purple)
      "#B0C4DE"  // ธันวาคม (Light Steel Blue)
    ];
    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: { display: false },
        title: {
          display: true,
          text: "บึนทึกประจำปี"
        }
      }
    });
  </script>

</body>

</html>