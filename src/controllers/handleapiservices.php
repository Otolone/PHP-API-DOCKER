<?php
// Include database connection and controller
require "./controllers/dataproceduralconn.php";
// Define variables and initialize with empty values
$service_nameErr = $service_name = $apikey = "";
$email = $_SESSION['userEmail'];  // Assuming session is started and email is stored in the session

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if service name is provided
 // if (empty($_POST["service_name"])) {
   // $service_nameErr = "You have to select a service";
   // echo $service_nameErr;  // Provide error response
  //} else {
  //  $service_name = test_input($_POST["service_name"]);
  //  echo "Selected Service: " . $service_name . "<br>";  // Display selected service name
  //}

  // Check if API key is provided
  //if (!empty($_POST["key"])) {
   // $apikey = test_input($_POST["key"]);
    //echo "API Key: " . $apikey . "<br>";  // Display API key

    // Initialize database connection
    $conn = new Database();
    
    // Find user by email
    $businessid = $conn->findUserByEmail($email);

    if ($businessid) {
      // Save API key associated with the user
      $conn->saveApiKey($businessid['businessid'], $apikey);
      echo "API Key saved successfully for business ID: " . $businessid['businessid'];
    } else {
      echo "Error: Business ID not found for email " . $email;
    }

    // Close the database connection
    $conn->close_connection();
  //} else {
  //  echo "API Key is required.";
  //}
//}

// Function to sanitize input data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
