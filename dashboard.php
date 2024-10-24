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

function getOrdersThisMonth($conn) {
    $currentMonth = date('m');
    $sql = "SELECT * FROM orders WHERE MONTH(orderdate) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currentMonth);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows;
}

function getOrdersCountByStatus($conn, $status) {
    $currentMonth = date('m');
    $sql = "SELECT * FROM orders WHERE orderStatus = ? AND MONTH(orderdate) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $status, $currentMonth);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows;
}

function getProductsByOrderCount($conn, $order) {
    $sql = "SELECT orders.productid, products.productname, COUNT(orders.productid) as orderCount
            FROM orders
            INNER JOIN products ON orders.productid = products.id
            WHERE MONTH(orders.orderdate) = MONTH(CURRENT_DATE())
            GROUP BY orders.productid
            ORDER BY orderCount $order";

    $result = $conn->query($sql);

    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style.css">
<style>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}
.menu {
    margin-bottom: 20px;
}

.result {
    font-weight: bold;
}

.box {
    width: 300px;
    height: 50px;
    border: 1px solid black;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

	<title>CEO Dashboard</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="ecom/index.php" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Nila Marketing</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
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
				<a href="ecom/index.html">
					<i class='bx bxs-apple' ></i>
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



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			
			
			
			<a href="setting.html" class="profile">
				<img src="profile.jpg">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
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
							<a class="active" href="dashboard.html">Home</a>
						</li>
					</ul>
				</div>
				
			</div>

<br><br>

<h2>&nbsp&nbspDaily Reports </h2>
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3> <?php echo getOrdersThisMonth($conn); ?></h3>
						<p> Orders</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo getOrdersCountByStatus($conn, 'delivered'); ?></h3>
						<p>Delivered</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?php echo getOrdersCountByStatus($conn, 'in Process'); ?></h3>
						<p>In process</p>
					</span>
				</li>
			</ul>
				<br>

<br>
<h2>&nbsp&nbspDependencies </h2>
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>FedEx</h3>
						<p> Delivery Patners</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>11</h3>
						<p>Employees</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>6</h3>
						<p>Teams</p>
					</span>
				</li>
			</ul>

    <h2>&nbsp&nbspFinancial Report of last month</h2>
			<ul class="box-info">
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>4000000</h3>
						<p>Revenue</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>2700000</h3>
						<p>Expenses</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>1300000</h3>
						<p>Profit</p>
					</span>
				</li>
			</li>
</body>
</html>