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

		$url = "localhost/adminhub/app/backend/web/index.php/api/all-deposits";
	
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

		// data.addRows([
		// 	[new Date('2023-04-26'), 1200],
		// 	[new Date('2023-04-27'), 1900],
		// 	[new Date('2023-04-28'), 12000],
		// 	[new Date('2023-04-29'), 1000],
		// 	[new Date('2023-04-30'), 1500],
		// 	[new Date('2023-05-01'), 2000],
		// 	[new Date('2023-05-02'), 12500]
		// ]);

		data.addRows([
			<?php foreach ($resposne->data as $row): ?>
				[new Date('<?php echo $row->inserted_at; ?>'), <?php echo $row->amount; ?>],
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
			<li>
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>

			<li class="active">
				<a href="transactions.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Transactions</span>
				</a>
			</li>

			<li>
				<a href="transactions.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
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
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
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
						<h3>Recent Transactions</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Transaction Serial No.</th>
								<th>Amount</th>
								<th>Phone</th>
								<th>Date</th>
								<th>status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach( $response->data as $resp): ?>
								<tr>
									<td>
										<p><?=$resp->merchant_request_id;?></p>
									</td>
									<td><?=$resp->amount;?></td>
									<td><?=$resp->msisdn;?></td>
									<td><?=$resp->inserted_at;?></td>
									<td><span class="status completed">Completed</span></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>