<?php
$host = "localhost";
$username = "root";
$password = ""; 
$database = "ceo_dashboard"; // 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT productId,quality,name,summary,review,reviewDate FROM productreview"; 

$result = $conn->query($query);

$reviewData = [];

while ($row = $result->fetch_assoc()) {
    $reviewData[] = $row;
}

header('Content-Type: application/json');
echo json_encode($reviewData);

$conn->close();
?>