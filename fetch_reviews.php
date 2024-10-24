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

// Query to retrieve reviews from the productreviews table
$sql = "SELECT * FROM productreviews";
$result = $conn->query($sql);

// Fetch reviews as an associative array
$reviews = [];
while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

// Close connection
$conn->close();

// Return reviews as JSON
echo json_encode($reviews);
?>
