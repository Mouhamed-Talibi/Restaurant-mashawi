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

        // add-product method : 
        public function add_product($name, $description, $price, $image, $categoryId) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("
                                    INSERT INTO products(product_name, product_description, product_price, product_image, category_id)
                                    VALUES(?, ?, ?, ?, ?)
                    ");
                    return $stmt->execute([$name, $description, $price, $image, $categoryId]);
                } catch (\Exception $e) {
                    error_log("Error adding Product: " . $e->getMessage());
                    return false;
                }
            } else {
                throw new \Exception("Db Connection Failed !");
            }
        }

        // explore food method :
        public function explore_Food($category_id) {
            $isConnected = $this->db_connection();
            if ($isConnected) {
                try {
                    // Check if category exists and fetch products
                    $stmt = $isConnected->prepare("
                        SELECT 
                            p.id AS product_id,
                            p.product_name,
                            p.product_description,
                            p.product_price,
                            p.product_image,
                            p.created_at,
                            c.id AS category_id,
                            c.category_name
                        FROM products p
                        INNER JOIN categories c ON p.category_id = c.id
                        WHERE p.category_id = ?
                    ");
                    $stmt->execute([$category_id]);
        
                    // Check if products exist for the given category
                    if ($stmt->rowCount() < 1) {
                        throw new \Exception("No Available Food For This Category!");
                    }
                    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                } catch (\Exception $e) {
                    // Log the error with sanitized message
                    error_log("Error Fetching Products with Category: " . htmlspecialchars($e->getMessage()));
                    return [];
                }
            } else {
                throw new \Exception("DB Connection Failed!");
            }
        }    

        // edit category
        public function edit_category($category_id) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    // select category info
                    $query = $isConnected->prepare("SELECT * FROM categories WHERE id=?");
                    $query->execute([$category_id]);
                    if($query->rowCount() == 0) {
                        throw new \Exception("This Category Not Found !");
                    }
                    return $query->fetch(PDO::FETCH_ASSOC);
                } catch (\Exception $e) {
                    error_log("Something went wrong !!") . $e->getMessage();
                    return false;
                }
            }
        }

        // Update category method 
        public function update_Category($newName, $newDescription, $newimage, $category_id) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    // update category
                    if(!empty($newName) && !empty($newDescription) && !empty($newimage) && !empty($category_id)) {
                        $stmt = $isConnected->prepare("
                                UPDATE categories
                                SET 
                                    category_name = ?,
                                    category_description,
                                    category_image
                                WHERE 
                                    id=?
                        ");
                        return $stmt->execute([$newName, $newDescription, $newimage, $category_id]);
                    }
                } catch (\Exception $e) {
                    error_log("Something went wrong when updating this category : ") . $e->getMessage();
                    return false;
                }
            } else {
                throw new \Exception("Db connection failed !");
            }
        }
    }

?>