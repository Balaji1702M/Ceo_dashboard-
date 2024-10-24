<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ceo_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayOperationalData($conn) {
    $sql = "SELECT id, month, production_output, efficiency, inventory_levels, supply_chain_performance FROM operational_data";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Month</th>
                    <th>Production Output</th>
                    <th>Efficiency</th>
                    <th>Inventory Levels</th>
                    <th>Supply Chain Performance</th>
                </tr>
            </thead>
            <tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['month']}</td>
                    <td>{$row['production_output']}</td>
                    <td>{$row['efficiency']}</td>
                    <td>{$row['inventory_levels']}</td>
                    <td>{$row['supply_chain_performance']}</td>
                </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No records found";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Dashboard</title>
  <link rel="stylesheet" href="team.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style.css">


</head>
<body>
<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="ecom/index.php" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Nila Marketing</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Home</span>
				</a>
			</li>
			<li>
				<a href="analystics.html">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Analytics</span>
				</a>
			</li>
<li>
				<a href="sales.php">
					<i class='bx bxs-buildings' ></i>
					<span class="text">Financial Metrices</span>
				</a>
			</li>

<li>
				<a href="marketing.php">
					<i class='bx bxs-buildings' ></i>
					<span class="text">Sales and Marketing</span>
				</a>
			</li>
		<li class="active">
				<a href="operational.php">
					<i class='bx bxs-buildings' ></i>
					<span class="text">Operational Metrices</span>
				</a>
			</li>
			<li>
				<a href="email.html">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="team.html">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
<li>
				<a href="Buisness.html">
					<i class='bx bxs-buildings' ></i>
					<span class="text">Buisness Ideas</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
<li>
				<a href="ecom/index.php">
					<i class='bx bxs-buildings' ></i>
					<span class="text">Nila Marketing</span>
				</a>
			</li>
			<li>
				<a href="setting.html">
					<i class='bx bxs-cog' ></i>
					<span class="text">Profile</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			
			
			
			<a href="setting.html" class="profile">
				<img src="profile.jpg">
			</a>
		</nav>
		<!-- NAVBAR -->

<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="dashboard.html">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="team.html">Operational metrices</a>
						</li>
					</ul>
				</div>
				
			</div>
<br>
<!-- Operational Data Table -->
<h2>Operational Data</h2>
<br>
<div>
            <?php displayOperationalData($conn); ?>
        </div>
</body>
</html>




