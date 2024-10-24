<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ceo_dashboard";

$connection = new mysqli($servername, $username, $password, $database);

// Check connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  
  die("Connection failed: " . $conn->connect_error);
}

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $accessCode = $_POST['accessCode'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND accesscode='$accessCode'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        header("Location: dashboard.php");
        exit();
    } else {
        $errorMsg = "Invalid login credentials!";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>CEO Dashboard - Log in</title>
</head>
<body>
    <div class="container">
        
        <form method="post" action="">
	<h1>Login</h1>
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="accessCode">Access Code:</label>
            <input type="password" name="accessCode" required>

   <div style="color: red;"><?php echo $errorMsg; ?></div>

            <button type="submit" value="Login"> Log in </button>
<br><br>
to create new account<a href="signup.php">click here</a>
        </form>
    </div>
</body>
</html>



    
 