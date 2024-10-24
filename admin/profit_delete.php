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

// Check if deleteProfitDataId is set in POST request
if(isset($_POST['deleteProfitDataId'])) {
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['deleteProfitDataId']);
    
    // SQL query to delete data from profit_data table
    $sql = "DELETE FROM profit_data WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        // Data deleted successfully
        echo "<script> alert('Profit data deleted successfully!');</script>";
        echo "<script> window.location='index.html';</script>";
    } else {
        // Error deleting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Handle case where deleteProfitDataId is not set
    echo "Error: ID not provided";
}

// Close connection
$conn->close();
?>
