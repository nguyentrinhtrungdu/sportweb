<?php

include "admin/database.php";

class User {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Create a new Database instance
    }

    // Get user by ID
    public function get_user_by_id($user_id) {
        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->db->prepare($query);

        

        $stmt->bind_param("i", $user_id); // "i" indicates the type is integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($stmt->error) {
            die("Execute failed: " . $stmt->error);
        }

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    
    
    // Add other user-related methods as needed
}

?>
