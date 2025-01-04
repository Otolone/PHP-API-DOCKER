<?php 
require "./controllers/dataproceduralconn.php";

if (isset($_POST['delete'])) {
    $data = $_POST['delete'];
    $decodedData = json_decode($data, true); // decode json into an associative array

    //access the API KEY and services
    $apiKey = $decodedData['apikey'];    
    //delete api key
    $conn = new Database();
    $stmt = $conn->deleteApiKey($apiKey);    
    
} else {
    echo "No data received.";
}









?>