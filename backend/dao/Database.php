<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $port = '3307'; 
    private $db = 'eventdb';
    private $user = 'root';
    private $pass = ''; 

    private function __construct() {
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->db;charset=utf8";
        $this->conn = new PDO($dsn, $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
