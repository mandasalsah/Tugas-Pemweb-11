<?php
include('koneksip.php'); // Akses ke database

// Mengambil data tb_covid
$country = mysqli_query($koneksi,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['namanegara'];
	
	// Mengambil data totalcases dari tb_covid
	$query = mysqli_query($koneksi,"SELECT sum(totalcases) AS totalcases FROM tb_covid WHERE id='".$row['id']."'");
	$row = $query->fetch_array();
	$total_cases[] = $row['totalcases'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart Covid Total Cases</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik Total Cases COVID-19',
					data: <?php echo json_encode($total_cases); ?>,
					backgroundColor: 'rgba(60, 135, 60, 0.2)',
					borderColor: 'rgba(99,255,222,1)',
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