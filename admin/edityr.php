<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ceo_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$year = $_POST['editYear'];
$revenue = $_POST['editYearlyRevenue'];

$sql = "UPDATE yearly_revenue SET revenue='$revenue' WHERE year='$year'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Yearly revenue updated successfully!');</script>";
    echo "<script>window.location='index.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
