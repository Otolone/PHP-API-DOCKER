<?php
require "./controllers/dataproceduralconn.php";

if (isset($_POST['apikey'])) {
        
    $data = $_POST['apikey'];
    $decodedData = json_decode($data, true); // decode json into an associative array
    //access the API KEY and services
    if(isset($decodedData['apikey'])) {
        $apikey = $decodedData['apikey'];
        //save the apikey to a session variable
        $conn = new Database();

        $conn->getServices($apikey);

} 
}
else {
  

    echo "Invalid API key";
}

?>
