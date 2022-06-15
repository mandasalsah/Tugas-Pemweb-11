<?php
include('koneksip.php'); // Akses ke database

// Mengambil data tb_country
$country = mysqli_query($koneksi,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['namanegara'];
	
	// Mengambil data totaldeaths pada tb_covid
	$query = mysqli_query($koneksi,"SELECT totaldeaths FROM tb_covid WHERE id='".$row['id']."'");
	$row = $query->fetch_array();
	$total_deaths[] = $row['totaldeaths'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Line Chart Covid Total Death</title>
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
					label: 'Grafik Total Deaths COVID-19',
					data: <?php echo json_encode($total_deaths); ?>,
					backgroundColor: 'rgba(128, 99, 105)',
					borderColor: 'rgba(255,209,219)',
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