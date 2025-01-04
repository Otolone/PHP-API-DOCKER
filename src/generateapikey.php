<?php
// Function to generate a cryptographically secure API key
function generateApiKey($length = 32) {
    //echo "<script>alert('ResponseText'),/script>";
    // Use random_bytes to generate a cryptographically secure random string
    return bin2hex(random_bytes($length / 2)); // Convert to hexadecimal format
}

// Generate the API key
$apiKey = generateApiKey();
//$_SESSION['apikey'] = $apiKey;

// Send the generated API key back to the client
echo $apiKey;
?>
