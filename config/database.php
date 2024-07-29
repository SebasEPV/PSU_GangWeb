<?php
class Database {
    private $host = "localhost";
    private $db_name = "psuGangWeb";
    private $username = "root";
    private $password = "admin";
    public $connection ;
    public function getConnection() {
     $this->connection = null;
    try {
        $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" .
        $this->db_name, $this->username, $this->password);
        $this->connection->exec("set names utf8");
    } catch(PDOException $exception) {
        echo "connectionection error: " . $exception->getMessage();
    }
     return $this->connection;
    }
}
