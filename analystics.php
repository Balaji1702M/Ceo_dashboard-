<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ceo_dashboard";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$querySales = "SELECT month, sales FROM sales_data";
$queryProfit = "SELECT month, profit FROM profit_data";
$queryFinancial = "SELECT month, revenue, expenses, profit FROM financial_data";
$queryOperational = "SELECT month, production_output, efficiency, inventory_levels, supply_chain_performance FROM operational_data";
$yearlyRevenueQuery = "SELECT year, revenue FROM yearly_revenue";
$yearlyRevenueResult = mysqli_query($conn, $yearlyRevenueQuery);

$resultSales = $conn->query($querySales);
$resultProfit = $conn->query($queryProfit);
$resultFinancial = $conn->query($queryFinancial);
$resultOperational = $conn->query($queryOperational);


$salesData = [];
while ($row = $resultSales->fetch_assoc()) {
    $salesData[] = $row;
}


$profitData = [];
while ($row = $resultProfit->fetch_assoc()) {
    $profitData[] = $row;
}

$financialData = [];
while ($row = $resultFinancial->fetch_assoc()) {
    $financialData[] = $row;
}


$operationalData = [];
while ($row = $resultOperational->fetch_assoc()) {
    $operationalData[] = $row;
}

$yearlyRevenueData = [];
while ($row = mysqli_fetch_assoc($yearlyRevenueResult)) {
    $yearlyRevenueData[] = $row;
}

// Fetch product-wise sales data
$productSalesQuery = "SELECT p.productName, SUM(o.quantity) as totalQuantity FROM products p JOIN orders o ON p.id=o.productId GROUP BY p.id, p.productName";
$productSalesResult = mysqli_query($conn, $productSalesQuery);

$productSalesData = [];
while ($row = mysqli_fetch_assoc($productSalesResult)) {
    $productSalesData[] = $row;
}


$responseData = [
    'salesData' => $salesData,
    'profitData' => $profitData,
    'financialData' => $financialData,
    'operationalData' => $operationalData,
    'yearlyRevenueData' => $yearlyRevenueData,
    'productSalesData' => $productSalesData,
];
header('Content-Type: application/json');
echo json_encode($responseData);

?>