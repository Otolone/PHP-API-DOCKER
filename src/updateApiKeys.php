<?php
require "./controllers/dataproceduralconn.php";
//update the apikeys tabble
$conn = new Database();
$conn->getKeyServices();
$conn->close_connection();
?>