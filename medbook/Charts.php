<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<body class="pt-10 sm:pt-10 sm:ml-64 mt-10">

<canvas id="myChart" style="width:500px; height:300px;"></canvas>

<script>
var xValues = ["ห้อง1", "ห้อง2", "ห้อง3", "ห้อง4", "ห้อง5", "ห้อง6", "ห้อง7", "ห้อง8"];
var yValues = [55, 49, 44, 24, 50, 35, 50, 40]; // เพิ่มข้อมูลครบ 8 ห้อง
var barColors = ["red", "green", "blue", "orange", "brown", "purple", "cyan", "magenta"]; // เพิ่มสีครบ 8

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
      text: "World Wine Production 2018"
    }
  }
});
</script>

</body>
</html>
