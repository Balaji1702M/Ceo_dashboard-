<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];

    $subject = "Message from CEO";
    $headers = "anushreemurugan05@gmail.com"; 

    if (mail($recipient, $subject, $message, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email. Please try again.";
    }
}
?>
