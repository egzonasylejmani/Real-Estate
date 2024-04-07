<?php 

class DatabaseConnection {
    public $conn;

    public function __construct() {
        $this->establishConnection();
    }

    /**
     * Establishes a database connection using mysqli.
     *
     * @return mysqli|null Returns the mysqli connection object on success, or null on failure.
     */
    private function establishConnection() {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        if ($conn->connect_error) {
            die("<h1>Database Connection Failed</h1>");
        }

        $this->conn = $conn;
    }

    /**
     * Get the established database connection.
     *
     * @return mysqli|null The mysqli connection object.
     */
    public function getConnection() {
        return $this->conn;
    }
}

?>