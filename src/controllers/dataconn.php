<?php
class Database {

    private mysqli $conn;
    private string $servername = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $dbname = "apidatabase";

    // Constructor to initialize the MySQLi connection
    public function __construct() {
        $this->createConnection();
    }

    // Method to create a MySQLi connection
    private function createConnection(): void {
        try {
            // Enable mysqli exceptions
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            
            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (mysqli_sql_exception $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }

    // Method to insert data
    public function insertData(string $sql): void {
        try {
            if ($this->conn->query($sql) === TRUE) {
                echo "New record successfully inserted";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        } catch (mysqli_sql_exception $e) {
            echo "<br> Error: " . $e->getMessage();
        }
    }

    // Method to insert multiple records
    public function insertMultiple(string $sql): void {
        try {
            if ($this->conn->multi_query($sql) === TRUE) {
                echo "New records inserted successfully.";
            }
        } catch (mysqli_sql_exception $e) {
            echo "<br> Error: " . $e->getMessage();
        }
    }

    // Method to get the ID of the last inserted record
    public function getLastId(): int {
        return $this->conn->insert_id;
    }

    // Method to get a prepared statement
    public function getStatement(string $sql): mysqli_stmt {
        return $this->conn->prepare($sql);
    }

    // Method to bind parameters
    public function bindParameters(mysqli_stmt $stmt, array $params): mysqli_stmt {
        // Bind parameters
        $types = str_repeat('s', count($params)); // assuming all params are strings, change accordingly
        $stmt->bind_param($types, ...array_values($params));
        return $stmt;
    }

    // Method to execute a prepared statement
    public function executePreparedStatement(mysqli_stmt $stmt): void {
        $stmt->execute();
        echo "New records created successfully";
    }

    // Method to query and select array data
    public function selectData(string $sql): array {
        try {
            $result = $this->conn->query($sql);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        } catch (mysqli_sql_exception $e) {
            echo "Error querying database: " . $e->getMessage();
            return [];
        }
    }
    // Method to query and return a single item
    public function selectOneColumn(string $sql): array {
        try {
            $result = $this->conn->query($sql);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        } catch (mysqli_sql_exception $e) {
            echo "Error querying database: " . $e->getMessage();
            return [];
        }
    }

    // Method to handle transactions
    public function transaction(callable $queries): void {
        $this->conn->begin_transaction();
        try {
            $queries($this->conn); // Execute the set of queries provided in the callable
            $this->conn->commit();
            echo "Transaction committed!";
        } catch (mysqli_sql_exception $e) {
            $this->conn->rollback();
            echo "Transaction rolled back: " . $e->getMessage();
        }
    }

    // Method to close the connection
    public function close(): void {
        $this->conn->close();
    }
}
