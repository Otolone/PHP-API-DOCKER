<?php 
require "./controllers/dataproceduralconn.php";

//get the api and the servvices
if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $decodedData = json_decode($data, true); // decode json into an associative array
    //get the apikey and permissions
    $apikey = $decodedData['apikey'];
    $permissions = $decodedData['permissions'];  
    $conn = new Database();
    $conn->updatePermissions($apikey,$permissions); 
    echo "Permissions updated successfully.";

    
} else {
    echo "No data received.";
}
/*
/*while (count($decodedData) > 0) {
        $object = array_pop($decodedData);
        //access the service and its permission
        $service = $object['service'];
        $permission = $object['permission'];
        //update the permissions
        $sql .= "UPDATE keyservices SET permissions = '$permission' 
        WHERE apiKey = '$apiKey' AND services = '$service';";        

    }
    echo $sql;
    //save the information into the database
    $conn = new Database();
    $conn->insert_multiple($sql); 
    $conn->close_connection();*/
    //echo "Permissions updated!";
?>