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

<li  class="active">
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
							<a class="active" href="team.html">Sales and Markeing</a>
						</li>
					</ul>
				</div>
				
			</div>
<br>
  



        <h1><u>Sales and Marketing</u></h1>
<br>
<br>

        <div>
            <h2>Orders Placed This Month: &nbsp&nbsp&nbsp&nbsp<?php echo getOrdersThisMonth($conn); ?></h2>
        </div>
        <br><br>

        <div>
            <h2>Delivered Orders: &nbsp&nbsp&nbsp&nbsp<?php echo getOrdersCountByStatus($conn, 'delivered'); ?></h2>
<br><br>
            <h2>In-Process Orders:&nbsp&nbsp&nbsp&nbsp<?php echo getOrdersCountByStatus($conn, 'in process'); ?></h2>
        </div>
        <br>

        <div>
            <h2>Products with Maximum Orders</h2>
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Sales</th>
                </tr>
                <?php
                $maxOrderProducts = getProductsByOrderCount($conn, 'DESC');
                while ($row = $maxOrderProducts->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['productid']}</td>
                            <td>{$row['productname']}</td>
                            <td>{$row['orderCount']}</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
<br>
<h1> User login tracking </h1>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Email</th>
            <th>User IP</th>
            <th>Login Time</th>
            <th>Logout</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT id, userEmail, userip, loginTime, logout, status FROM userlog";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["userEmail"] . "</td>";
                echo "<td>" . $row["userip"] . "</td>";
                echo "<td>" . $row["loginTime"] . "</td>";
                echo "<td>" . $row["logout"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>
	</main>
	
</section>
  <script src="team.js"></script>
<script src="script.js"></script>
</body>
</html>