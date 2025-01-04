<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Process the data (send email, save to database, etc.)

    echo "<p>Thanks, $name! We got your message.</p>";
}
?>