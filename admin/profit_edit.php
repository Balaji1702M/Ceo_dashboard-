<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ceo_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['editProfitDataId'];
$month = $_POST['editProfitDataMonth'];
$profit = $_POST['editProfitDataProfit'];

$sql = "UPDATE profit_data SET month='$month', profit='$profit' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>  alert('Profit data updated successfully!');</script>";
    echo"<script> window.location='index.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
