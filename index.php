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
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
					<h3 id="total-tasks"></h3>
					<p>Total Tasks</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">
					<h3 id="overall-total-completed"></h3>
					<p>Total Completed</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
					<h3 id="overall-completion-rate"></h3>
					<p>Completion Rate</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Active Reps</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>NAME</th>
								<th>TASKS</th>
								<th>PENDING</th>
								<th>COMPLETED</th>
								<th>RESCHEDULED</th>
								<th>CANCELLED</th>
								<th>COMPLETION RATE %</th>
								<th>ACTION</th>
							</tr>
						</thead>

						<tbody id="table-body">
							
						</tbody> 
					</table>


					<script>
						let totalTasksCount = 0;
						// Define and initialize other variables
						let overallTotalCompleted = 0;
						let overallCompletionRate = 0;
						// Function to make a GET request and populate the table
						function fetchData() {
							// Replace with your API URL
							const apiUrl = 'http://localhost/pharmacorp/backend/web/index.php/api/filter-task-status?start_date=2023-04-24';

							const currentDate = new Date();

					
							fetch(apiUrl)
								.then(response => response.json())
								.then(data => {
									if (data.status) {
										const activities = data.data.activities;

										const completedTasks = activities.filter(activity => activity.status === '2');


										// Group activities by user name
										const groupedActivities = groupActivitiesByUserName(activities);
										

										const tableBody = document.getElementById('table-body');

										// Loop through grouped activities
										for (const userName in groupedActivities) {
											if (groupedActivities.hasOwnProperty(userName)) {
												const userActivities = groupedActivities[userName];

												const row = document.createElement('tr');

												const pendingCount = userActivities.filter(activity => activity.status === '1').length;
												const completedCount = userActivities.filter(activity => activity.status === '2').length;
												const rescheduledCount = userActivities.filter(activity => activity.status === '3').length;
												const cancelledCount = userActivities.filter(activity => activity.status === '4').length;

												totalTasksCount = activities.length; // Update the global variable
												overallTotalCompleted = completedTasks.length; // Update the global variable
												overallCompletionRate = (overallTotalCompleted/totalTasksCount * 100); // Update the global variable

												// Update the "Total Tasks" value in the box-info section
												document.getElementById('total-tasks').textContent = totalTasksCount;
												document.getElementById('overall-total-completed').textContent = overallTotalCompleted;
												document.getElementById('overall-completion-rate').textContent = overallCompletionRate.toFixed(1)+"%";

												
												const rate = (completedCount/userActivities.length * 100);
												row.innerHTML = `
													<td>
														<img src="img/people.png">
														<p>${userName}</p>
													</td>
													<td>${userActivities.length}</td>
													<td>${pendingCount}</td>
													<td>${completedCount}</td>
													<td>${rescheduledCount}</td>
													<td>${cancelledCount}</td>
													<td>${rate.toFixed(1)}</td>
													<i class='bx bx-dots-vertical-rounded' ></i>
												`;
												tableBody.appendChild(row);
											}
										}
									}
								})
								.catch(error => {
									console.error('Error fetching data:', error);
								});
						}


						// Helper function to group activities by user name
						function groupActivitiesByUserName(activities) {
							const groupedActivities = {};

							activities.forEach(activity => {
								if (activity.names in groupedActivities) {
									groupedActivities[activity.names].push(activity);
								} else {
									groupedActivities[activity.names] = [activity];
								}
							});

							return groupedActivities;
						}

						// Load data when the page is ready
						document.addEventListener('DOMContentLoaded', () => {
							fetchData();
						});
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