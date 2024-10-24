
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
<li class="active">
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
		<li>
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
							<a class="active" href="sales.html">Financial Metrices</a>
						</li>
					</ul>
				</div>
				
			</div>

<h2>Sales Data</h2>
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ceo_dashboard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve sales data
$sql = "SELECT month, sales FROM sales_data";
$result = $conn->query($sql);

// Display sales data table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Month</th><th>Sales</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["month"]."</td><td>".$row["sales"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

?>

<h2>Profit Data</h2>
<?php
// Query to retrieve profit data
$sql = "SELECT month, profit FROM profit_data";
$result = $conn->query($sql);

// Display profit data table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Month</th><th>Profit</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["month"]."</td><td>".$row["profit"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

?>

<h2>Financial Data</h2>
<?php
// Query to retrieve financial data
$sql = "SELECT month, revenue, expenses, profit FROM financial_data";
$result = $conn->query($sql);

// Display financial data table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Month</th><th>Revenue</th><th>Expenses</th><th>Profit</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["month"]."</td><td>".$row["revenue"]."</td><td>".$row["expenses"]."</td><td>".$row["profit"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

?>

<h2>Financial Ratios</h2>
<?php
// Query to retrieve financial ratios
$sql = "SELECT * FROM FinancialRatios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Company Name</th><th>Net Profit Margin</th><th>Return on Assets (ROA)</th><th>Current Ratio</th><th>Debt-to-Equity Ratio</th></tr>";

    // Loop through each row in the result set
    while($row = $result->fetch_assoc()) {
        $netProfitMargin = ($row["NetIncome"] / $row["Revenue"]) * 100; // Net Profit Margin (%)
        $roa = ($row["NetIncome"] / $row["TotalAssets"]) * 100; // Return on Assets (ROA) (%)
        $currentRatio = $row["CurrentAssets"] / $row["CurrentLiabilities"]; // Current Ratio
        $debtEquityRatio = $row["TotalLiabilities"] / $row["ShareholdersEquity"]; // Debt-to-Equity Ratio

        // Display each company's financial ratios
        echo "<tr><td>".$row["Companyname"]."</td><td>".$netProfitMargin."%</td><td>".$roa."%</td><td>".$currentRatio."</td><td>".$debtEquityRatio."</td></tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>



	</main>
	
</section>
  <script src="team.js"></script>
<script src="script.js"></script>
</body>
</html>