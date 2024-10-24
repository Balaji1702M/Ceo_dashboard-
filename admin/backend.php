<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ceo_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['action']) && $_POST['action'] == 'addFinancialRatio') {
    $companyId = $_POST['companyId'];
    $companyName = $_POST['companyName'];
    $revenue = $_POST['revenue'];
    $netIncome = $_POST['netIncome'];
    $currentAssets = $_POST['currentAssets'];
    $currentLiabilities = $_POST['currentLiabilities'];
    $totalAssets = $_POST['totalAssets'];
    $totalLiabilities = $_POST['totalLiabilities'];
    $shareholdersEquity = $_POST['shareholdersEquity'];

    $sql = "INSERT INTO financialratios (CompanyID, Companyname, Revenue, NetIncome, CurrentAssets, CurrentLiabilities, TotalAssets, TotalLiabilities, ShareholdersEquity)
            VALUES ('$companyId', '$companyName', '$revenue', '$netIncome', '$currentAssets', '$currentLiabilities', '$totalAssets', '$totalLiabilities', '$shareholdersEquity')";

    if ($conn->query($sql) === TRUE) {
        echo "Financial ratio added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'addFinancialData') {
    $month = $_POST['financialDataMonth'];
    $revenue = $_POST['financialDataRevenue'];
    $expenses = $_POST['financialDataExpenses'];
    $profit = $_POST['financialDataProfit'];

    $sql = "INSERT INTO financial_data (month, revenue, expenses, profit)
            VALUES ('$month', '$revenue', '$expenses', '$profit')";

    if ($conn->query($sql) === TRUE) {
        echo "Financial data added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_POST['profitDataMonth']) && isset($_POST['profitDataProfit'])) {
        // Add operation
        $month = $_POST['profitDataMonth'];
        $profit = $_POST['profitDataProfit'];
        
        // Assuming your table name is 'profit_data'
        $sql = "INSERT INTO profit_data (month, profit) VALUES ('$month', '$profit')";
        if (mysqli_query($conn, $sql)) {
            echo "Data added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['editProfitDataId']) && isset($_POST['editProfitDataMonth']) && isset($_POST['editProfitDataProfit'])) {
        // Edit operation
        $id = $_POST['editProfitDataId'];
        $month = $_POST['editProfitDataMonth'];
        $profit = $_POST['editProfitDataProfit'];
        
        $sql = "UPDATE profit_data SET month='$month', profit='$profit' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "Data updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['deleteProfitDataId'])) {
        // Delete operation
        $id = $_POST['deleteProfitDataId'];
        
        $sql = "DELETE FROM profit_data WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "Data deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
} 

if (isset($_POST['action']) && $_POST['action'] == 'addOperationaldata') {
    $month = $_POST['operationalDataMonth'];
    $productionoutput = $_POST['productionOutput'];
    $efficiency = $_POST['efficiency'];
    $inventoryLevels = $_POST['inventoryLevels'];
    $supplyChainPerformance = $_POST['supplyChainPerformance'];
   
    $sql = "INSERT INTO operational_data (month, production_output, efficiency,inventory_levels,supply_chain_performance)
            VALUES ('$month', '$productionoutput', '$efficiency', '$inventoryLevels','$supplyChainPerformance')";

    if ($conn->query($sql) === TRUE) {
        echo "Operational data added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'editFinancialRatio') {
    $companyId = $_POST['editCompanyId'];
    $companyName = $_POST['editCompanyName'];
    $revenue = $_POST['editRevenue'];
    $netIncome = $_POST['editNetIncome'];
    $currentAssets = $_POST['editCurrentAssets'];
    $currentLiabilities = $_POST['editCurrentLiabilities'];
    $totalAssets = $_POST['editTotalAssets'];
    $totalLiabilities = $_POST['editTotalLiabilities'];
    $shareholdersEquity = $_POST['editShareholdersEquity'];

    $sql = "UPDATE financialratios SET 
                CompanyID = '$companyId', 
                Companyname = '$companyName', 
                Revenue = '$revenue', 
                NetIncome = '$netIncome', 
                CurrentAssets = '$currentAssets', 
                CurrentLiabilities = '$currentLiabilities', 
                TotalAssets = '$totalAssets', 
                TotalLiabilities = '$totalLiabilities', 
                ShareholdersEquity = '$shareholdersEquity' 
            WHERE CompanyID = '$companyId'";

    if ($conn->query($sql) === TRUE) {
        echo "Financial ratio edited successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'editFinancialData') {
    $id = $_POST['editFinancialDataid'];
    $month = $_POST['editFinancialDataMonth'];
    $revenue = $_POST['editFinancialDataRevenue'];
    $expenses = $_POST['editFinancialDataExpenses'];
    $profit = $_POST['editFinancialDataProfit'];

    $sql = "UPDATE financial_data SET 
                month = '$month', 
                revenue = '$revenue', 
                expenses = '$expenses', 
                profit = '$profit' 
            WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Financial data edited successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'editOperationalData') {
    $id = $_POST['editOperationalDataId'];
    $month = $_POST['editOperationalDataMonth'];
    $ProductionOutput = $_POST['editProductionOutput'];
    $Efficiency = $_POST['editEfficiency'];
    $InventoryLevels = $_POST['editInventoryLevels'];
    $SupplyChainPerformance = $_POST['editSupplyChainPerformance'];

    $sql = "UPDATE operational_data SET 
                month = '$month', 
                production_output = '$ProductionOutput', 
                efficiency = '$Efficiency', 
                inventory_levels = '$InventoryLevels',                            
                supply_chain_performance  =  '$SupplyChainPerformance'
                WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Operational data edited successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'deleteFinancialRatio') {
    $financialRatioId = $_POST['deleteFinancialRatioId'];

    $sql = "DELETE FROM financialratios WHERE CompanyID = '$financialRatioId'";

    if ($conn->query($sql) === TRUE) {
        echo "Financial ratio deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'deleteFinancialData') {
    $financialDataId = $_POST['deleteFinancialDataId'];

    $sql = "DELETE FROM financial_data WHERE id = '$financialDataId'";

    if ($conn->query($sql) === TRUE) {
        echo "Financial data deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'deleteOperationalData') {
    $OperationalDataId = $_POST['deleteOperationalDataId'];

    $sql = "DELETE FROM operational_data WHERE id = '$OperationalDataId'";

    if ($conn->query($sql) === TRUE) {
        echo "Operational data deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
