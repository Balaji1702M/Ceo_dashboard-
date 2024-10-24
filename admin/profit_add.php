<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ceo_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $month = $_POST['profitDataMonth'];
    $profit = $_POST['profitDataProfit'];

    $sql = "INSERT INTO profit_data (month, profit)
            VALUES ('$month', '$profit')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>  alert('Profit data added successfully!');</script>";
         echo"<script> window.location='index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
$conn->close();
?>