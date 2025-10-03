<?php
class Database {
    private $host = "localhost";
    private $db_name = "hr_system";
    private $username = "root";
    private $password = "";
    public $conn;

 
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->db_name
            );

            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }

        } catch (Exception $e) {
            echo "Database Error: " . $e->getMessage();
            exit;
        }

        return $this->conn;
    }
}
?>
