<?php
    namespace models;
    use Exception;
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
                throw new Exception("DB Connection Failed!");
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
                } catch (Exception $e) {
                    error_log("Error adding category: " . $e->getMessage());
                    return false;
                }
            } else {
                throw new Exception("Database connection failed.");
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
                } catch (Exception $e) {
                    error_log("Error adding Product: " . $e->getMessage());
                    return false;
                }
            } else {
                throw new Exception("Db Connection Failed !");
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
                        throw new Exception("No Available Food For This Category!");
                    }
                    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                } catch (Exception $e) {
                    // Log the error with sanitized message
                    error_log("Error Fetching Products with Category: " . htmlspecialchars($e->getMessage()));
                    return [];
                }
            } else {
                throw new Exception("DB Connection Failed!");
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
                        throw new Exception("This Category Not Found !");
                    }
                    return $query->fetch(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                    error_log("Something went wrong : ") . $e->getMessage();
                    return false;
                }
            } else {
                throw new Exception("Db Connection Failed !");
            }
        }

        // get category image method
        public function get_Category_Image($category_id) {
            $isConnected = $this->db_connection();
            if ($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT category_image FROM categories WHERE id=?");
                    $stmt->execute([$category_id]);
                    if ($stmt->rowCount() > 0) {
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        return $result['category_image']; // Return only the image path
                    } else {
                        throw new Exception("Category Not Found !");
                    }
                } catch (Exception $e) {
                    error_log("Getting Category Image Failed ! " . $e->getMessage());
                    return false;
                }
            }
        }     

        // Update category method 
        public function update_Category($newName, $newDescription, $newImage, $category_id) {
            $isConnected = $this->db_connection();
            if ($isConnected) {
                try {
                    if (!empty($newName) && !empty($newDescription) && !empty($category_id)) {
                        // If a new image is provided
                        if (!empty($newImage)) {
                            $stmt = $isConnected->prepare("
                                UPDATE categories
                                SET 
                                    category_name = ?, 
                                    category_description = ?, 
                                    category_image = ?
                                WHERE 
                                    id = ?
                            ");
                            return $stmt->execute([$newName, $newDescription, $newImage, $category_id]);
                        } else {
                            // If no new image is provided
                            $stmt = $isConnected->prepare("
                                UPDATE categories
                                SET 
                                    category_name = ?, 
                                    category_description = ?
                                WHERE 
                                    id = ?
                            ");
                            return $stmt->execute([$newName, $newDescription, $category_id]);
                        }
                    }
                    // If required fields are empty
                    return false;
                } catch (Exception $e) {
                    error_log("Something went wrong when updating this category: " . $e->getMessage());
                    return false;
                }
            } else {
                throw new Exception("DB connection failed!");
            }
        }

        // delete category method : 
        public function delete_Category($category_id) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt =  $isConnected->prepare("DELETE FROM categories WHERE id=?");
                    return $stmt->execute([$category_id]);
                } catch (Exception $e) {
                    error_log("Failed To Delete The Category :") . $e ->getMessage();
                    return false;
                }
            } else {
                throw new Exception("Db connection failed !");
            }
        }

        // categories list method
        public function categories_List() {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT id, category_name FROM categories");
                    $stmt->execute();
                    if($stmt->rowCount() > 0 ) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return null;
                    }
                } catch (Exception $e) {
                    error_log("Error in categories List : ") . $e->getMessage();
                    throw new Exception("Failed To retreive categories, Please try Again !");
                }
            } else {
                throw new Exception("Db Connection Failed !!");
            }
        }

        // get product data method
        public function get_Product_Data($productId) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM products WHERE id=?");
                    $stmt->execute([$productId]);
                    if($stmt->rowCount() > 0) {
                        return $stmt->fetch(PDO::FETCH_ASSOC);
                    } else {
                        throw new Exception("No Product Found !");
                    }
                } catch (Exception $e) {
                    error_log("Error in get_Product_Data: " . $e->getMessage());
                }
            }
        }

        // Update Product method 
        public function update_Product($newName, $newDescription, $newPrice, $newImage, $newCategory_id, $productId) {
            $isConnected = $this->db_connection();
            if ($isConnected) {
                try {
                    if (!empty($newName) && !empty($newDescription) && !empty($newPrice) && !empty($newCategory_id) && !empty($productId)) {
                        // If a new image is provided
                        if (!empty($newImage)) {
                            $stmt = $isConnected->prepare("
                                UPDATE products
                                SET 
                                    product_name = ?, 
                                    product_description = ?, 
                                    product_price = ?, 
                                    product_image = ?,
                                    category_id = ?
                                WHERE 
                                    id = ?
                            ");
                            return $stmt->execute([$newName, $newDescription, $newPrice, $newImage, $newCategory_id, $productId]);
                        } else {
                            // If no new image is provided
                            $stmt = $isConnected->prepare("
                                UPDATE products
                                SET 
                                    product_name = ?, 
                                    product_description = ?,
                                    product_price = ?,
                                    category_id = ?
                                WHERE 
                                    id = ?
                            ");
                            return $stmt->execute([$newName, $newDescription, $newPrice, $newCategory_id, $productId]);
                        }
                    }
                    // If required fields are empty
                    return false;
                } catch (Exception $e) {
                    error_log("Error in Update Product : " . $e->getMessage());
                    return false;
                }
            } else {
                throw new Exception("DB connection failed!");
            }
        }

        // delete product method : 
        public function delete_Product($product_id) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt =  $isConnected->prepare("DELETE FROM products WHERE id=?");
                    return $stmt->execute([$product_id]);
                } catch (Exception $e) {
                    error_log("Failed To Delete The Product :") . $e ->getMessage();
                    return false;
                }
            } else {
                throw new Exception("Db connection failed !");
            }
        }

    }
?>