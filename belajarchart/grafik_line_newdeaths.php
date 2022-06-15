<?php
include('koneksip.php'); // Akses ke database

// Mengambil data tb_country
$country = mysqli_query($koneksi,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['namanegara'];
	
	// Mengambil data newdeaths pada tb_covid
	$query = mysqli_query($koneksi,"SELECT newdeaths FROM tb_covid WHERE id='".$row['id']."'");
	$row = $query->fetch_array();
	$new_deaths[] = $row['newdeaths'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Line Chart Covid New Deaths</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik New Deaths COVID-19',
					data: <?php echo json_encode($new_deaths); ?>,
					backgroundColor: 'rgba(74, 0, 2, 0.2)',
					borderColor: 'rgba(193,37,83,1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>