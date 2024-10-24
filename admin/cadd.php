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

// Function to add a new employee
function addEmployee($conn, $employeeid, $employeename, $team, $salary, $dob, $experience, $email, $phno) {
    $sql = "INSERT INTO employee (id, name, team, salary, dob, experience, email, phoneno) VALUES ('$employeeid', '$employeename', '$team', '$salary', '$dob', '$experience', '$email', '$phno')";
    if ($conn->query($sql) === TRUE) {
        echo "Employee added successfully!";
    } else {
        echo "Error adding employee: " . $conn->error;
    }
}

// Function to edit an employee
function editEmployee($conn, $employeeid, $field, $value) {
    $sql = "UPDATE employee SET $field = '$value' WHERE id = '$employeeid'";
    if ($conn->query($sql) === TRUE) {
        echo "Employee detail edited successfully!";
    } else {
        echo "Error editing employee detail: " . $conn->error;
    }
}

// Function to delete an employee
function deleteEmployee($conn, $employeeid) {
    $sql = "DELETE FROM employee WHERE id = '$employeeid'";
    if ($conn->query($sql) === TRUE) {
        echo "Employee deleted successfully!";
    } else {
        echo "Error deleting employee: " . $conn->error;
    }
}

// Check if form data is submitted for add, edit, or delete
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['employeeid']) && isset($_POST['employeename']) && isset($_POST['team']) && isset($_POST['salary']) && isset($_POST['dob']) && isset($_POST['experience']) && isset($_POST['email']) && isset($_POST['phno'])) {
        addEmployee($conn, $_POST['employeeid'], $_POST['employeename'], $_POST['team'], $_POST['salary'], $_POST['dob'], $_POST['experience'], $_POST['email'], $_POST['phno']);
    } elseif (isset($_POST['editEmployeeId']) && isset($_POST['editField']) && isset($_POST['editValue'])) {
        editEmployee($conn, $_POST['editEmployeeId'], $_POST['editField'], $_POST['editValue']);
    } elseif (isset($_POST['deleteEmployeeId'])) {
        deleteEmployee($conn, $_POST['deleteEmployeeId']);
    }
}

$conn->close();
?>
