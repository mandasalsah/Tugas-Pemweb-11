<?php
include('koneksip.php');
$country = mysqli_query($koneksi,"select * from tb_covid");
while($row = mysqli_fetch_array($country)){
	$country_name [] = $row['namanegara'];
	
	$query = mysqli_query($koneksi,"SELECT newcases, newdeaths, newrecovered, totalcases, totaldeaths, totalrecovered FROM tb_covid WHERE id='".$row['id']."'");
	$row = $query->fetch_array();
    $new_cases[] = $row['newcases'];
    $new_deaths[] = $row['newdeaths'];
    $new_recovered[] = $row['newrecovered'];
	$total_cases[] = $row['totalcases'];
    $total_deaths[] = $row['totaldeaths'];
    $total_recovered[] = $row['totalrecovered'];
    
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 1500px;height: 1500px">
		<canvas id="myChart"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
                datasets: [{
                    label: 'New Cases',
                    data: <?php echo json_encode($new_cases); ?>,
                    backgroundColor: 'rgba(0, 172, 252, 0.2)',
                    borderWidth: 5
                },
                {
                    label: 'New Death',
                    data: <?php echo json_encode($new_deaths); ?>,
                    backgroundColor: 'rgba(74, 0, 2, 0.2)',
                    borderWidth: 5
                },
                {
                    label: 'New Recovered',
                    data: <?php echo json_encode($new_recovered); ?>,
                    backgroundColor: 'rgba(99, 255, 222)',
                    borderWidth: 5
                },
                {
                    label: 'Total Cases',
                    data: <?php echo json_encode($total_cases); ?>,
                    backgroundColor: 'rgba(60, 135, 60, 0.2)',
                    borderWidth: 5
                },
                {
                    label: 'Total Death',
                    data: <?php echo json_encode($total_deaths); ?>,
                    backgroundColor: 'rgba(128, 99, 105)',
                    borderWidth: 5
                },
                {
                    label: 'Total Recovered',
                    data: <?php echo json_encode($total_recovered); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 5
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