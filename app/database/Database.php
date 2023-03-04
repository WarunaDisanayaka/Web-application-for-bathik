<?php

require_once('../config/config.php');

class Database
{
    private $host = 'DB_HOST';
    private $dbName = 'DB_NAME';
    private $user = 'DB_USER';
    private $pass = 'DB_PASSWORD';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $this->conn = new PDO($dsn, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
