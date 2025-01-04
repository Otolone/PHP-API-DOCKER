<?php 
require "./controllers/dataproceduralconn.php";

if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $decodedData = json_decode($data, true); // decode json into an associative array

    //access the API KEY and services
    $apiKey = $decodedData['apiKey'];
    //save the apikey to a session varaible
   // $_SESSION['apikey'] = $apiKey;
    $services = $decodedData['services'];
    
    /// Escape each element to prevent SQL injection
$escapedServices = array_map(function($service) {
    return "'" . addslashes($service) . "'";
}, $services);

// Initialize $valueString as an empty string
$valueString = "";

// Convert the array into a comma-separated string
$escapedServices = array_map(function($service) {
    return addslashes($service);
}, $services);

$valueString = implode(", ", $escapedServices);

//echo $valueString;

/*while (count($escapedServices) > 0) {
    $valueString .= array_pop($escapedServices);

    // Add a comma separator if there are more elements
    if (count($escapedServices) > 0) {
       $valueString .= ", ";
    }
}*/
$sql = "INSERT INTO Keyservices(apiKey, services) VALUES('$apiKey','$valueString');";
 // save data to data base    
 $conn = new Database();
 $conn->insert_multiple($sql); 
 $conn->close_connection();
    
} else {
    echo "No data received.";
}









?>