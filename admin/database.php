<?php

class Database {
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'websport';

        $this->connection = new mysqli($host, $user, $pass, $db);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function select($query) {
        $result = $this->connection->query($query);

        if ($this->connection->error) {
            die("Query failed: " . $this->connection->error);
        }

        return $result;
    }

    public function insert($query) {
        if ($this->connection->query($query) === TRUE) {
            return $this->get_last_insert_id(); // Return the last inserted ID
        } else {
            die("Insert failed: " . $this->connection->error);
        }
    }

    public function update($query) {
        $this->connection->query($query);

        if ($this->connection->error) {
            die("Update failed: " . $this->connection->error);
        }
    }

    public function delete($query) {
        if ($this->connection->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function prepare($query) {
        $stmt = $this->connection->prepare($query);

        if ($this->connection->error) {
            die("Prepare failed: " . $this->connection->error);
        }

        return $stmt;
    }
    
    public function get_last_insert_id() {
        return $this->connection->insert_id;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
