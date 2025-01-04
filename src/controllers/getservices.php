<?php
// Include database connection and controller
require "./controllers/dataproceduralconn.php";
$email = $_SESSION['userEmail']; 
$apikey = $_SESSION['apikey']; 
 // Initialize database connection
 $conn = new Database();  
 //check if user should exceed 6 times
 $sql = "SELECT COUNT('$apikey') as num_times FROM keyservices;";
 $times = $conn->select_data($sql);

  
// Find user by email
 $businessid = $conn->findUserByEmail($email);

 if ($businessid['businessid']) {
   // Save API key associated with the user and the services
   // associated with the apikey
   $stmt = $conn->get_statement("INSERT INTO KeyServices(apikey, services, businessid) VALUES(?, ?, ?)");
   $stmt = $conn->bind_parameters($stmt, [$apikey, $_GET['q'], $businessid['businessid']]);
   
   $conn->execute_prepared_statement($stmt);
  
 } else {
   echo "Error: Business ID not found for email for " . $email;
 }
 
 // select the services from the KeyServices table
 //$conn->getServices();
/*$sql = "SELECT id, apikey, businessid, services
        FROM KeyServices 
        WHERE apikey = '$apikey'";
$rows = $conn->select_data($sql);
echo "<table>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Api Key</th>";
echo "<th>BusinessId</th>";
echo "<th>Services</th>";
echo "<th>Read</th>";
echo "<th>Write</th>";
echo "<th>Edit</th>";
echo "<th>Delete</th>";
echo "</tr>";

foreach ($rows as $key) {
  echo "<tr>";
  echo "<td>" . $key['id'] . "</td>";
  echo "<td>" . $key['apikey'] . "</td>";
  echo "<td>" . $key['businessid'] . "</td>";
  echo "<td>" . $key['services'] . "</td>";
  echo "<td><button  onclick=\"alert('Selected!');\">Read</button></td>";
  echo "<td><button  onclick=\"alert('Inserte!');\">Write</button></td>";
  echo "<td><button  onclick=\"alert('Edited!');\">Edit</button></td>";
  echo "<td><button onclick=\"alert('Deleted!');\">Delete</button></td>";
  echo "</tr>";
}
echo "</table>";*/
?>