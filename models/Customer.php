<?php
    namespace models;
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
                throw new \Exception("DB Connection Failed!");
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
                    throw new \Exception("Email Already In Use!");
                }

                // Hash the password
                $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

                // Insert the new customer
                $stmt = $this->connection->prepare("INSERT INTO customers (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
                if (!$stmt->execute([$f_name, $l_name, $email, $hashed_pass])) {
                    throw new \Exception("Sign Up Failed!");
                }
            }
        }

        // login method
        public function login($email, $password) {
            // ensure database connection :
            $isConnected = $this->db_connection();
            if($isConnected) {
                // check email and correct password :
                $stmt = $this->connection->prepare("SELECT id,email,password,role password FROM customers WHERE email=?");
                $stmt->execute([$email, $password]);
                $customer = $stmt->fetch(PDO::FETCH_ASSOC);
                if($customer && $customer['email'] === $email) {
                    if($customer['role'] === "customer") {
                        // verify password : 
                        if(password_verify($password, $customer['password'])) {
                            session_start();
                            $_SESSION['customerId'] = $customer['id'];
                            $_SESSION['customerEmail'] = $customer['email'];
                            header('Location: routes.php?action=customerAccount');
                            exit();
                        } else {
                            throw new \Exception("Incorrect Password !");
                        }
                    } else {
                        session_start();
                        $_SESSION['adminId'] = $customer['id'];
                        $_SESSION['adminEmail'] = $customer['email'];
                        header('Location: routes.php?adminDashboard.php');
                        exit();
                    }
                } else {
                    throw new \Exception("Email Not Exists !");
                }
            } else {
                throw new \Exception("Db Connection Failed !");
            }
        }
    }
