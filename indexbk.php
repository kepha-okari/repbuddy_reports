<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">


	<?php
		// PHP code goes here

		$url = "localhost:81/adminhub/app/backend/web/index.php/api/all-deposits";
	
		function getRequest($url) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	
			$result = curl_exec($curl);
			if (!$result) {
				die("Connection Failure");
			}
			curl_close($curl);
			return json_decode($result);
		}

		$response = getRequest($url);


	?>


	<!-- Google Charts -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		google.charts.load('current', {packages: ['corechart', 'line']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('date', 'Date');
		data.addColumn('number', 'Total Collection');
 
		data.addRows([
			<?php foreach ($response->sub_totals as $key=>$value): ?>
				[new Date('<?php echo $key; ?>'), <?php echo $value; ?>],
			<?php endforeach; ?>
		]);

		var options = {
			title: 'Total Collection for the Past 7 Days',
			curveType: 'function',
			legend: { position: 'bottom' },
			chartArea: { width: '80%' },
			hAxis: {
			title: 'Last 7 days',
			format: 'MMM d'
			},
			pointSize: 20,
			vAxis: {
			title: 'Total Collection',
			format: 'Kshs #,##0'
			}
		};

		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		chart.draw(data, options);
		}

	</script>
	
	<title>Paysol</title>
</head>


<body>


	<!-- SIDEBAR -->
	<section id="sidebar">

		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Paysol</span>
		</a>
		
		<ul class="side-menu top">
			<li class="active">
				<a href="index.php">
					<i class="bx bx-bar-chart" ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="transactions.php">
					<i class='bx bx-money' ></i>
					<span class="text">Transactions</span>
				</a>
			</li>

			<li>
				<a href="branches.php">
					<i class='bx bxs-buildings' ></i>
					<span class="text">Branches</span>
				</a>
			</li>
		</ul>

	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">


		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="index.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a> -->
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?=$response->total;?></h3>
						<p>Total Collections</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?=$response->settled;?></h3>
						<p>Total Settled</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?=$response->pending;?></h3>
						<p>Total Pending</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Collections Summary</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>

					<div id="chart_div" style="width: 100%; height: 500px;></div>
				</div>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>