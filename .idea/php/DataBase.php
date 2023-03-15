<?php

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'PWD';
    private $database = 'coubooks';
    private $connection;
    private static DataBase $instance;

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }

    public static function getConnection(): PDO {
        if (!isset(self::$instance)) {
            self::$instance = new DataBase();
        }
        return self::$instance->connection;
    }

}
