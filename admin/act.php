<?php

// Database connection
function connectToDatabase() {
    $servername = "localhost";
    $username = "root"; 
    $password = "";
    $dbname = "ceo_dashboard";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Add Sales Data Function
function addSalesData($month, $sales) {
    $conn = connectToDatabase();

    $sql = "INSERT INTO sales_data (month, sales) VALUES ('$month', '$sales')";

    if ($conn->query($sql) === TRUE) {
        echo "Sales data added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Add Yearly Revenue Function
function addYearlyRevenue($revenue, $year) {
    $conn = connectToDatabase();

    $sql = "INSERT INTO yearly_revenue (revenue, year) VALUES ('$revenue', '$year')";

    if ($conn->query($sql) === TRUE) {
        echo "Yearly revenue added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Edit Sales Data Function
function editSalesData($id, $month, $sales) {
    $conn = connectToDatabase();

    $sql = "UPDATE sales_data SET month='$month', sales='$sales' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Sales data updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

// Edit Yearly Revenue Function
function editYearlyRevenue($year, $revenue) {
    $conn = connectToDatabase();

    $sql = "UPDATE yearly_revenue SET revenue='$revenue' WHERE year='$year'";

    if ($conn->query($sql) === TRUE) {
        echo "Yearly revenue updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
// Delete Sales Data Function
function deleteSalesData($id) {
    $conn = connectToDatabase();

    $sql = "DELETE FROM sales_data WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Sales data deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

// Delete Yearly Revenue Function
function deleteYearlyRevenue($year) {
    $conn = connectToDatabase();

    $sql = "DELETE FROM yearly_revenue WHERE year='$year'";

    if ($conn->query($sql) === TRUE) {
        echo "Yearly revenue deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

// Main code to handle AJAX requests from the frontend

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'addSalesData':
            addSalesData($_POST['salesDataMonth'], $_POST['sales']);
            break;
        case 'addYearlyRevenue':
            addYearlyRevenue($_POST['yearlyRevenue'], $_POST['year']);
            break;
        case 'editSalesData':
            editSalesData($_POST['id'], $_POST['editSalesDataMonth'], $_POST['editSales']);
            break;
        case 'editYearlyRevenue':
            editYearlyRevenue($_POST['editYear'], $_POST['editYearlyRevenue']);
            break;
        case 'deleteSalesData':
            deleteSalesData($_POST['deleteSalesDataId']);
            break;
        case 'deleteYearlyRevenue':
            deleteYearlyRevenue($_POST['deleteYearlyRevenueId']);
            break;
        default :
         echo "  Invalid request"
        break;
    }
} else {
    echo "No action specified";
}

?>
