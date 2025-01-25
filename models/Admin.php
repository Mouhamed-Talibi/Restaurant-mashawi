<?php
    namespace models;
    use models\Database;
    use PDO;


    // admin class 
    class Admin {
        private $connection;

        // db connection method
        public function db_connection() {
            $database = new Database();
            $this->connection = $database->connect();
            // check for connection
            if ($this->connection === null) {
                throw new \Exception("DB Connection Failed!");
            }
            return $this->connection;
        }

        // add-category method 
        public function add_category($categoryName, $categoryDescription, $categoryImage) {
            $isConnected = $this->db_connection();
            if ($isConnected) {
                try {
                    $stmt = $isConnected->prepare("INSERT INTO categories (category_name, category_description, category_image) VALUES (?, ?, ?)");
                    return $stmt->execute([$categoryName, $categoryDescription, $categoryImage]); // Return success status
                } catch (\Exception $e) {
                    error_log("Error adding category: " . $e->getMessage());
                    return false;
                }
            } else {
                throw new \Exception("Database connection failed.");
            }
        }
    }

?>