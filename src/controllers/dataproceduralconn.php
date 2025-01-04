
<?php
session_start();

class Database{
// Database configuration
private mysqli $conn;
private string $servername = "db";
private string $username = "root";
private string $password = "my-secret-pw";
private string $dbname = "apidatabase";

 

public function __construct() {
    $this->create_connection();
    


}
// Function to create a MySQLi connection
public function create_connection(): mixed {
        // Enable mysqli exceptions
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Create connection
    $this->conn = mysqli_connect($this->servername,$this->username, $this->password,$this->dbname);

    // Check connection
    if (!$this->conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $this->conn;
}

// Function to insert data
public function insert_data(string $bName, string $address, string $telephone,string $email, string $username,string $hashed_password): void {
    $stmt = $this->get_statement("INSERT INTO Business (bName, `address`, tel, email, username, bus_password) 
                VALUES ( ?, ?, ?, ?,?, ?)");
    $stmt = $this->bind_parameters($stmt, [$bName, $address, $telephone, $email, $username, $hashed_password]);
    $this->execute_prepared_statement($stmt);
    //insert businessid
    $businesid = $this->get_last_id();
    //generate an apikey
    $apikey  = bin2hex(random_bytes(8));
    //insert into apiuser 
    $stmt = $this->get_statement("INSERT INTO APIUser (businessid,apikey) VALUES ( ?, ?)");
    $stmt = $this->bind_parameters($stmt, [$businesid,$apikey]);
    $this->execute_prepared_statement($stmt);
    //close the statement
    $stmt->close();            

}
public function saveApikey(string $businessid, string $apikey): void {
    $sql = "INSERT INTO APIUser (businessid,apikey) VALUES( ?, ?);";  
    $stmt = $this->get_statement($sql);
    $stmt = $this->bind_parameters($stmt, [$businessid, $apikey]);
    $this->execute_prepared_statement($stmt);
}
public function deleteApikey(string $apikey): void {
    $sql = "DELETE FROM Keyservices WHERE apikey = ?;"; 
    $stmt = $this->get_statement($sql);
    $stmt = $this->bind_parameters($stmt, [$apikey]);
    $this->execute_prepared_statement($stmt);
}
public function saveToken(int $user, string $token): void {

    $stmt = $this->get_statement("UPDATE APIUser SET token = ? WHERE businessid = ?;");
    $stmt = $this->bind_parameters($stmt, [$token, $user]);
    $this->execute_prepared_statement($stmt);
}
public function updatePermissions(string $apikey, string $permissions): void {
   
   $sql = "UPDATE Keyservices SET permissions = ? 
        WHERE apikey = ?;";   
    $stmt = $this->get_statement($sql);
    $stmt = $this->bind_parameters($stmt, [$permissions, $apikey]);
    $this->execute_prepared_statement($stmt);
}

public function update_data(string $sql): void {
    try {
        if (mysqli_query($this->conn, $sql)) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
    } catch (Exception $e) {
        echo "<br> Error: " . $e->getMessage();
    }
} 
public function delete_data(string $sql): void {
    try {
        if (mysqli_query($this->conn, $sql)) {
            echo "Record deleted successfully";
          } else {
            echo "Error deleting record: " . mysqli_error($conn);
          }
    } catch (Exception $e) {
        echo "<br> Error: " . $e->getMessage();
    }
} 
// Function to insert multiple records
public function insert_multiple(string $sql) {
    try {
        if (mysqli_multi_query($this->conn, $sql)) {
            echo "Success!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    } catch (Exception $e) {
        echo "<br> Error: " . $e->getMessage();
    }
}

// Function to get the ID of the last inserted record
public function get_last_id(): int {
    return mysqli_insert_id($this->conn);
}

// Function to prepare a statement
function get_statement(string $sql): mysqli_stmt {

    return mysqli_prepare($this->conn, $sql);
}

// Function to bind parameters
public function bind_parameters(mysqli_stmt $stmt,array $params): mysqli_stmt {
    // Bind parameters
    $types = str_repeat('s', count($params)); // assuming all params are strings, change accordingly
    mysqli_stmt_bind_param($stmt, $types, ...array_values($params));
    return $stmt;
}

// Function to execute a prepared statement
public function execute_prepared_statement(mysqli_stmt $stmt) : void {
   if(mysqli_stmt_execute($stmt)) {
    echo "Success!!";
   } else {
    echo "ERROR: Could not execute statement. " . mysqli_stmt_error($stmt);
   }
    
}

// Function to query and select array data
public function select_data(string $sql): array {
    
    try {
        $result = mysqli_query($this->conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    } catch (Exception $e) {
        echo "Error querying database: " . $e->getMessage();
        return [];
    }
}
public function findUserByEmail(string $userEmail): array {
      
    $stmt = $this->get_statement("SELECT businessid FROM Business WHERE email= ?");
    $stmt = $this->bind_parameters($stmt, [$userEmail]);
    $this->execute_prepared_statement($stmt);
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
   
    return $row;
}
public function findUserByToken(string $userToken): int {
    //$row = $this->select_data('businessid', 'apiuser', 'token', $userToken);
    $stmt = $this->get_statement("SELECT businessid FROM APIUser WHERE token= ? ");
    $stmt = $this->bind_parameters($stmt, [$userToken]);
    $this->execute_prepared_statement($stmt);
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //print_r($row);
    $stmt->close();
    return $row['businessid'];
}
public function getPasswordByEmail(string $userEmail): string {
    $stmt = $this->get_statement("SELECT bus_password FROM Business  WHERE email = ?");
    $stmt = $this->bind_parameters($stmt, [$userEmail]);
    $this->execute_prepared_statement($stmt);
    $result= $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['bus_password'];
}
function updatePassword($userId, $newPassword): void {
    $stmt = $this->get_statement("UPDATE Business SET bus_password = ? WHERE businessid = ?;");
    $stmt = $this->bind_parameters($stmt, [$newPassword, $userId]);
    $this->execute_prepared_statement($stmt);
    $stmt->close();
}
public function clearToken(string $userId):void {
    $stmt =  $this->get_statement("UPDATE APIUser SET token = NULL WHERE businessid = ?");
    $stmt =  $this->bind_parameters($stmt, [$userId]);
    $this->execute_prepared_statement($stmt);
    $stmt->close();
} 

// Function to handle transactions
function transaction(callable $queries): void {
    mysqli_begin_transaction($this->conn);
    try {
        $queries($this->conn); // Execute the set of queries provided in the callable
        mysqli_commit($this->conn);
        echo "Transaction committed!";
    } catch (Exception $e) {
        mysqli_rollback($this->conn);
        echo "Transaction rolled back: " . $e->getMessage();
    }
}
function getServices($apikey): void {
    
    $sql = "SELECT services, permissions
        FROM Keyservices 
        WHERE apikey = '$apikey'";
$rows = $this->select_data($sql);

echo '<div class="container">
      <h2 class="mb-4 text-center">Edit API Key Services</h2>  
      
      <div>
        <div class="d-flex align-items-center mb-3">
            <div class="fw-bold me-3">API Key:</div>
            <div class="flex-fill">
              <input type="text" id="key" class="form-control" name="apikey" value="' . htmlspecialchars($apikey) . '" readonly>
            </div>
        </div>';

foreach ($rows as $services) {
    echo "<div class='d-flex justify-content-between align-items-center mb-3'>
                    <div class='flex-fill ms-3' style='font-size: 25px;'>
                        {$services['services']}
                        
                    </div>
                    <div class='flex-fill ms-3' style='font-size: 25px';}>
                        
                         {$services['permissions']}
                    </div>
                    <div class='text-white p-2 rounded flex-fill text-center'>{$services['services']}</div>
                    <div class='flex-fill ms-3'>
                        <select id='{$services['services']}' class='form-select' onchange='updatePermissions(this.value)'>
                            <option value=''>Update Permissions</option>
                            <option value='0'>No permission</option>
                            <option value='1'>Execute only</option>
                            <option value='2'>Write only</option>
                            <option value='3'>Write and Execute only</option>
                            <option value='4'>Read only</option>
                            <option value='5'>Read and execute only</option>
                            <option value='6'>Read and write</option>
                            <option value='7'>Read, write, and execute</option>
                        </select>
                    </div>
                  </div>";
        }
        

echo '<div class="d-flex justify-content-between mt-4">
        <button class="btn btn-primary flex-fill" onclick="window.location.href=\'index.php?page=api\'">Add New Key</button>
      </div>';


}


function getKeyServices(): void {
    $sql = "SELECT id, apikey, services, permissions
        FROM Keyservices 
        ";
$rows = $this->select_data($sql);
echo '<div class="container mt-3">';
echo "<table>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Api Key</th>";
echo "<th>Services</th>";
echo "<th>Permissions</th>";
echo "<th>Action</th>";
echo "<th>Action</th>";
echo "</tr>";

foreach ($rows as $key) {
  echo "<tr>";
  echo "<td>" . $key['id'] . "</td>";
  echo "<td>" . $key['apikey'] . "</td>";
  //echo "<td>" . $key['businessid'] . "</td>";
  echo "<td>" . $key['services'] . "</td>";
  echo "<td>" . $key['permissions'] . "</td>";
  
  echo '<td><button class="btn btn-primary" id="' . $key['apikey'] . '" value="' . $key['apikey'] . '" onclick="deleteApiKey(this.value)">Delete</button></td>';
  echo '<td><button class="btn btn-primary" id="' . $key['apikey'] . '" value="' . $key['apikey'] . '" onclick="editApiKey(this.value)">Edit</button></td>';
  
  echo "</tr>";
}
echo "</table>";
echo '</div>';
}

//stored procedures
// IN params
function create_stored_procedure(string $procedure): void {
    if(!mysqli_query($this->conn, $procedure))
    {
        die("Error creating stored procedure" . mysqli_error($this->conn));

    }

}
function call_procedure(string $procedure,string $sql): array {
    if(!mysqli_query($this->conn, $procedure)) {
        die("Error executing stored procedure!". mysqli_error($this->conn));
    }
    // fetch the results from the stored procedure
    do {
        if ($result = mysqli_store_result($this->conn)) {
            printf("--/n");
            var_dump(mysqli_fetch_all($result));
            mysqli_result_free($result);
        }
    } while (mysqli_next_result($this->conn)); 
    $result = mysqli_query($this->conn, $sql);
    
    if (!$result) {
        die("Error executing query");
    }
    $rows = mysqli_fetch_assoc($result);
    return $rows;

}

// Function to close the connection
public function close_connection() {
    mysqli_close($this->conn);
}
}

?>
