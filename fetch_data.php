<?php
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

// Fetch data
$sql = "SELECT p.id, p.productName, SUM(o.quantity) as totalQuantity
        FROM products p
        JOIN orders o ON p.id = o.productId
        GROUP BY p.id, p.productName";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $productData = array();
    while ($row = $result->fetch_assoc()) {
        $productData[] = $row;
    }
} else {
    $productData = array();
}

$conn->close();

echo json_encode($productData);
?>