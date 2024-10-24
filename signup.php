<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ceo_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $accessCode = $_POST['accessCode'];

    if ($accessCode == "102938#") {
        $sql = "INSERT INTO user(username, password, accesscode) VALUES ('$username', '$password', '$accessCode')";

        if ($conn->query($sql) === TRUE) {
             header("Location: dashboard.php"); 
        exit();
        } else {
            $errorMsg = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $errorMsg = "Invalid access code!";
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
  <title>CEO Dashboard - Signup</title>
</head>
<body>
  <div class="container">
 <form id="signup" action="signup.php" method="POST">
      <h1>Sign up</h1>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

       <label for="accessCode">Access code:</label>
      <input type="password" id="accessCode" name="accessCode" required>
<br>
<div style="color: red;"><?php echo $errorMsg; ?></div>


      <button type="submit">Sign up</button>
<br>
<br>
 click here to <a href="index.php">log in</a> 

    </form>
  </div>
</body>
</html>