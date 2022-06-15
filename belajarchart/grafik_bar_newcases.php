<?php
include('koneksip.php'); // Akses ke database

// Mengambil data tb_covid
$country = mysqli_query($koneksi,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['namanegara'];
	
	// Mengambil data newcases pada tb_covid
	$query = mysqli_query($koneksi,"SELECT newcases FROM tb_covid WHERE id='".$row['id']."'");
	$row = $query->fetch_array();
	$new_cases[] = $row['newcases'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart Covid Newcases</title>
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
					label: 'Grafik New Cases COVID-19',
					data: <?php echo json_encode($new_cases); ?>,
					backgroundColor: 'rgba(0, 172, 252, 0.2)',
					borderColor: 'rgba(0,180,175,1)',
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