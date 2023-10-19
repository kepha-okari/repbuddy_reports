<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->

	<section id="sidebar"></section>
	<!-- JavaScript to load the navigation bar -->
	<script>
		var sidebar = document.getElementById("sidebar");

		fetch('sidebar.html')
			.then(response => response.text())
			.then(data => {
				sidebar.innerHTML = data;
			})
			.catch(error => {
				console.error('Error fetching sidebar:', error);
			});
	</script>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">

		<!-- NAVBAR -->
			<nav id="navbarContainer"></nav>
			<!-- JavaScript to load the navigation bar -->
			<script>
				var navbarContainer = document.getElementById("navbarContainer");

				fetch('navbar.html')
					.then(response => response.text())
					.then(data => {
						navbarContainer.innerHTML = data;
					})
					.catch(error => {
						console.error('Error fetching navigation bar:', error);
					});
			</script>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Products Report</h1>
					<ul class="breadcrumb">
						<li>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
					<h3 id="total-products"></h3>
					<p>Total Products Pushed</p>
					</span>
				</li>
				<!-- <li>
					<i class='bx bxs-group'></i>
					<span class="text">
					<h3 id="overall-adoption"></h3>
					<p>Total Completed</p>
					</span>
				</li> -->
		
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Products List Summary</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>PRODUCT NAME</th>
								<th>REPS</th>
								<th>VISITS</th>
								<th>ACTION</th>
							</tr>
						</thead>

						<tbody id="table-body">
							
						</tbody> 
					</table>




				<script>

					let allProducts = 0;
					let averageAdoption = 0;
					// Function to make a GET request and populate the product report table
					function fetchData() {
						const apiUrl = 'http://localhost/pharmacorp/backend/web/index.php/api/product-report';

						fetch(apiUrl)
							.then(response => response.json())
							.then(data => {
								if (data.status) {
									const productData = data.data.productData;
									const tableBody = document.getElementById('table-body');

									allProducts = productData.length; // Update the global variable
									// overallCompletionRate = (overallTotalCompleted/totalTasksCount * 100); // Update the global variable

									// Update the "Total Tasks" value in the box-info section
									document.getElementById('total-products').textContent = allProducts;
									// document.getElementById('overall-total-completed').textContent = overallTotalCompleted;
									// document.getElementById('overall-completion-rate').textContent = overallCompletionRate.toFixed(1)+"%";

									productData.forEach(product => {
										const row = document.createElement('tr');
										row.innerHTML = `
											<td>${product.product_name}</td>
											<td>${product.rep_count}</td>
											<td>${product.activity_count}</td>
											<td><i class='bx bx-dots-vertical-rounded' ></i></td>

										`;
										tableBody.appendChild(row);
									});
								}
							})
							.catch(error => {
								console.error('Error fetching data:', error);
							});
					}

					// Load data when the page is ready
					document.addEventListener('DOMContentLoaded', fetchData);
				</script>
					
				</div>
			
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>