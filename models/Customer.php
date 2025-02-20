<?php
    namespace models;
    use Exception;
    use models\Database;
    use PDO;

    class Customer {
        private $connection;

        // db_connection method
        public function db_connection() {
            $database = new Database();
            $this->connection = $database->connect();
            // check for connection
            if ($this->connection === null) {
                throw new Exception("DB Connection Failed!");
            }
            return $this->connection;
        }

        // signUp method
        public function signUp($f_name, $l_name, $email, $password) {
            // Ensure database connection
            $isConnected = $this->db_connection();
            if($isConnected) {
                // Check if the email already exists
                $stmt = $this->connection->prepare("SELECT id FROM customers WHERE email = ?");
                $stmt->execute([$email]); 
                if ($stmt->rowCount() > 0) {
                    throw new Exception("Email Already In Use!");
                }

                // Hash the password
                $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

                // Insert the new customer
                $stmt = $this->connection->prepare("INSERT INTO customers (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
                if (!$stmt->execute([$f_name, $l_name, $email, $hashed_pass])) {
                    throw new Exception("Sign Up Failed!");
                }
            }
        }

        // login method
        public function login($email, $password) {
            // ensure database connection :
            $isConnected = $this->db_connection();
            if($isConnected) {
                // check email and correct password :
                $stmt = $this->connection->prepare("SELECT id,email,password,role FROM customers WHERE email=?");
                $stmt->execute([$email]);
                $customer = $stmt->fetch(PDO::FETCH_ASSOC);
                if($customer && $customer['email'] === $email) {
                    if($customer['role'] === "customer") {
                        // verify password : 
                        if(password_verify($password, $customer['password'])) {
                            session_start();
                            $_SESSION['customerId'] = $customer['id'];
                            $_SESSION['customerEmail'] = $customer['email'];
                            $_SESSION['customerRole'] = $customer['role'];
                            header('Location: routes.php?action=customerHome');
                            exit();
                        } else {
                            throw new Exception("Incorrect Password !");
                        }
                    } elseif ($customer['role'] === "admin") {
                        // verify password : 
                        if(password_verify($password, $customer['password'])) {
                            session_start();
                            $_SESSION['adminId'] = $customer['id'];
                            $_SESSION['adminEmail'] = $customer['email'];
                            $_SESSION['adminRole'] = $customer['role'];
                            header('Location: routes.php?action=adminDashboard');
                            exit();
                        } else {
                            throw new Exception("Incorrect Password !");
                        }
                    } else {
                        header('Location: routes.php?action=home');
                        exit();
                    }
                } else {
                    throw new Exception("Incorrect Email !");
                }
            } else {
                throw new Exception("Db Connection Failed !");
            }
        }

        // Food Menu Method
        public function food_Menu() {
            $isConnected = $this->db_connection();
            if ($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM categories");
                    $stmt->execute();
                    
                    // return results
                    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                } catch (Exception $e) {
                    error_log("Something went wrong in food Menu: " . $e->getMessage());
                    return []; 
                }
            }
            return []; 
        }

        // explore Food method : 
        public function explore_Food($categoryId) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM products WHERE category_id = ?");
                    $stmt->execute([$categoryId]);
                    if($stmt->rowCount() > 1) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return [];
                    }
                } catch (Exception $e) {
                    error_log("Soemthing went wrong in explore Food : ") . $e->getMessage();
                    return [];
                }
            }
        }

        // send message method : 
        public function sendMessage($fullName, $email, $message) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("INSERT INTO messages(messengerName, messengerEmail, message) VALUES(?, ?, ?)");
                    return $stmt->execute([$fullName, $email, $message]);
                } catch (Exception $e) {
                    error_log("Error In Send Message: " . $e->getMessage());
                    return false;
                }
            }
        }

        // customer data :
        public function customerData($customerId, $customerEmail) {
            $isConnected = $this->db_connection();
            if ($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT id, first_name, last_name, email FROM customers WHERE id = ? AND email = ?");
                    $stmt->execute([$customerId, $customerEmail]); 
                    
                    if ($stmt->rowCount() > 0) {
                        return $stmt->fetch(PDO::FETCH_ASSOC);
                    } else {
                        return false;
                    }
                } catch (Exception $e) {
                    error_log("Something Went Wrong: " . $e->getMessage());
                    return false;
                }
            }
            return false; 
        } 

        // categories list Method 
        public function categoriesList() {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM categories");
                    $stmt->execute();
                    if($stmt->rowCount() > 0 ) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return [];
                    }
                } catch (Exception $e) {
                    error_log("Error in Categories Menu : ") . $e->getMessage();
                }
            } else {
                throw new Exception("Db Connection Failed !");
            }
        }

        // random products method :
        public function randomCategories() {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM categories ORDER BY RAND() LIMIT 10");
                    $stmt->execute();
                    if($stmt->rowCount() > 0) {
                        return $stmt->fetchALL(PDO::FETCH_ASSOC);
                    } 
                    else {
                        return [];
                    }
                }
                catch (Exception $e) {
                    error_log("Error In Random Products : ") . $e->getMessage();
                }
            } else {
                throw new Exception("Db connectin failed");
            }
        }

        // products list method : 
        public function productsList() {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM products ORDER BY created_at");
                    $stmt->execute();
                    if($stmt->rowCount() > 0) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return [];
                    }
                } catch (Exception $e) {
                    error_log("Error in Products List : ") . $e->getMessage();
                }
            } else {
                throw new Exception("Db Connection Failed");
            }
        }

        public function findFood($foodName) {
            $isConnected = $this->db_connection();
            if ($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM products WHERE product_name LIKE :foodName");
                    $stmt->execute(['foodName' => "%$foodName%"]);
                    // Fetch Results Securely
                    if ($stmt->rowCount() > 0) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return [];
                    }
                } catch (Exception $e) {
                    error_log("Error in Find Food: " . $e->getMessage());
                    return [];
                }
            } else {
                throw new Exception("Database Connection Failed!");
            }
        }   

        // get product by id method :
        public function product_Data($productId) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM products WHERE id=?");
                    $stmt->execute([$productId]);
                    if($stmt->rowCount() > 0) {
                        return $stmt->fetch(PDO::FETCH_ASSOC);
                    } else {
                        return [];
                    }
                } catch (Exception $e) {
                    error_log("Error in Product Data :" . $e->getMessage());
                }
            } else {
                throw new Exception("Db connection failed");
            }
        }

        // confirm order method : 
        public function confirmOrder($productId, $customerId, $fullName, $phone, $deliveryAdress, $deliveryDate, $quantity, $totalPrice) {
            $isConntected = $this->db_connection();
            if($isConntected) {
                try {
                    $stmt = $isConntected->prepare("
                        INSERT INTO 
                            orders(product_id, customer_id, full_name, phone, delivery_address, delivery_date, quantity, total_price)
                        VALUES
                            (? , ? , ? , ? , ? , ? , ? , ?);
                    ");
                    return $stmt->execute([$productId, $customerId, $fullName, $phone, $deliveryAdress, $deliveryDate, $quantity, $totalPrice]);
                } catch (Exception $e) {
                    error_log("Error in Confirm Order : " . $e->getMessage());
                    return false;
                }
            } else {
                throw new Exception("Db Connection Failed !");
            }
        }

        // customer orders method : 
        public function customerOrders($customerId) {
            $isConnected = $this->db_connection();
            if($isConnected) {
                try {
                    $stmt = $isConnected->prepare("SELECT * FROM orders WHERE cutomer_id = ?");
                    $stmt->execute([$customerId]);
                    if($stmt->rowCount() > 0) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return [];
                    }
                } catch (Exception $e) {
                    error_log("Error in customer Orders : " .$e->getMessage());
                    return [];
                }
            } else {
                throw new Exception("Db Connection Failed !");
            }
        }

    }
