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
        $this->connection->query($query);

        if ($this->connection->error) {
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
}
?>