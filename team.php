<?php
$host = "localhost";
$username = "root";
$password = ""; 
$database = "ceo_dashboard"; // 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM employee"; 
$result = $conn->query($query);

$employeeData = [];

while ($row = $result->fetch_assoc()) {
    $employeeData[] = $row;
}

header('Content-Type: application/json');
echo json_encode($employeeData);

$conn->close();
?>