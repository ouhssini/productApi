<?php

class Database
{
    private $host = 'localhost'; // Server name
    private $user = 'root'; // Username
    private $pass = '199716'; // Password
    private $dbName = 'api_rest'; // Database name
    private $connection; // Attribute that holds the connection object (PDO)

    // Function that creates a connection to the database and returns the connection object
    public function getConnection()
    {
        $this->connection = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->connection;
    }
}


// // Example usage of the Database class to test the connection
// $database = new Database();
// $connection = $database->getConnection();
// if ($connection) {
//     echo "Database connection successfully established.";
// } else {
//     echo "Failed to establish database connection.";
// }
