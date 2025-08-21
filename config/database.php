<?php

$database = new Database();

class Database {
    private $server = "localhost";
    private $username = "root";
    private $password  = "";
    private $database = "sigb";
    public $connection;
    private $sql;
    private $charset = "utf8";

    public function __construct() {
        $this->connection = new mysqli($this->server, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }
    }

    public function query(string $sql) {
        $this->sql = $sql;
        $result = mysqli_query($this->connection, $this->sql);
        return $result;
    }

    public function insertId() {
        return mysqli_insert_id($this->connection);
    }
}