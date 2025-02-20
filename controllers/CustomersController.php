<?php
    namespace controllers;
    use controllers\AdminController;
    use Exception;
    use models\Customer;
    use models\Database;

    class CustomersController {
        // home Action 
        public static function homeAction() {
            require_once "index.php";
        }

        // sign up action 
        public static function signUp_Action() {
            $error = "";
        
            // handle request:
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // handle empty fields
                if (empty($_POST['f_name'])) { $error .= "First Name Is Required! <br>"; }
                if (empty($_POST['l_name'])) { $error .= "Last Name Is Required! <br>"; }
                if (empty($_POST['email'])) { $error .= "Email Is Required! <br>"; }
                if (empty($_POST['password'])) { $error .= "Password Is Required! <br>"; }
        
                // if no empty fields:
                if (empty($error)) {
                    try {
                        // check for valid email & strong password
                        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || 
                            !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['email'])) {
                            $error .= "Email Format Not Valid! <br>";
                        }
                        if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 55) {
                            $error .= "Password Must Be Between 8 And 55 Chars! <br>";
                        }
                        if (!preg_match('/[A-Za-z]/', $_POST['password'])) {
                            $error .= "Password Must Contain At Least One Letter! <br>";
                        }
                        if (!preg_match('/[0-9]/', $_POST['password'])) {
                            $error .= "Password Must Contain At Least One Number! <br>";
                        }
                        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $_POST['password'])) {
                            $error .= "Password Must Contain At Least One Special Character! <br>";
                        }
        
                        // proceed if no validation errors
                        if (empty($error)) {
                            // sanitize input
                            $f_name   = htmlspecialchars(trim($_POST['f_name']));
                            $l_name   = htmlspecialchars(trim($_POST['l_name']));
                            $email    = htmlspecialchars(trim($_POST['email']));
                            $password = htmlspecialchars(trim($_POST['password']));
        
                            // sign up
                            $signup = new Customer;
                            $signup->signUp($f_name, $l_name, $email, $password);
        
                            // redirect to login page
                            header("Location: routes.php?action=login");
                            exit();
                        }
                    } catch (Exception $e) {
                        $error .= $e->getMessage();
                    }
                }
            }
            // require signup page
            require "views/signup.php";
        }

        // login Action :
        public static function loginAction() {
            // set an empty error var
            $error = "";

            // handle request :
            if($_SERVER['REQUEST_METHOD'] === "POST") {
                // handle empty fields
                if(empty($_POST['email'])) { $error .= "Email Is Required! <br>"; }
                if(empty($_POST['password'])) { $error .= "Password Is Required! <br>"; }

                // if no empty fields :
                if(empty($error)) {
                    try {
                        // check for valid email
                        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || 
                            !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['email'])) {
                            $error .= "Email Format Not Valid! <br>";
                        }

                        // proceed if no validation errors
                        if(empty($error)) {
                            // sanitize input
                            $email    = htmlspecialchars(trim($_POST['email']));
                            $password = htmlspecialchars(trim($_POST['password']));

                            // login
                            $login = new Customer;
                            $login->login($email, $password);
                        }
                    } catch (Exception $e) {
                        $error .= $e->getMessage();
                    }
                }
            }
            // require login page
            require_once "views/login.php";
        } 

        // logout action 
        public static function logout_Action() {
            session_start(); 
            session_unset();
            session_destroy();
            session_write_close();  
            header("Location: routes.php?action=home");
            exit();
        }

        // customer home action
        public static function customer_Home_Action() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $error = "";
            $customer = new Customer();
            $customerData = false;
        
            // Validate session data properly
            $customerId = isset($_SESSION['customerId']) ? filter_var($_SESSION['customerId'], FILTER_VALIDATE_INT) : false;
            $customerEmail = isset($_SESSION['customerEmail']) ? filter_var($_SESSION['customerEmail'], FILTER_VALIDATE_EMAIL) : false;
            if ($customerId && $customerEmail) {
                $customerData = $customer->customerData($customerId, $customerEmail);
            }

            if (!$customerData || $customerData['id'] !== $customerId || $customerData['email'] !== $customerEmail) {
                header('Location: routes.php?action=home');
                exit();
            }
            require_once "views/customerHome.php"; 
        }        

        // page error action
        public static function page_Error_Action( ) {
            require_once "views/pageError.php";
        }

        // about action : 
        public static function about_Action() {
            require_once "views/about.php";
        }

        // menu action :
        public static function menu_Action() {
            $error = "";
            $foodMenu = [];
            $customer = new Customer();

            $foodMenu = $customer->food_Menu();
            if(empty($foodMenu)) {
                $error .= "Food Menu Not Available For The Moment ! <br>";
            }
            require_once "views/menu.php";
        }

        // explore Food Action :
        public static function explore_Products_Action() {
            $error = "";
            $productsList = [];
            $customer = new Customer();

            // check catId 
            if(isset($_GET['catId']) && filter_var($_GET['catId'], FILTER_VALIDATE_INT)) {
                $categoryId = intval($_GET['catId']);
                // get productsList
                try {
                    $productsList = $customer->explore_Food($categoryId);
                    if(empty($productsList)) {
                        $error .= "Food Will Be Available Soon :)";
                    }
                    require_once "views/food.php";
                } catch (Exception $e) {
                    $error .= "No Availabel Products For The Moement !";
                }
            } else {
                header("Location: routes?php?action=errorPage");
                exit();
            }
            require_once "views/food.php";
        }

        // services action : 
        public static function services_Action() {
            require_once "views/services.php";
        }

        // location action :
        public static function location_Action() {
            require_once "views/location-contact.php";
        }

        // contact action :
        public static function contact_Action() {
            require_once "views/location-contact.php";
        }

        // send message action : 
        public static function send_Message_Action() {
            $error = "";
            $message = "";
            $success = false;
            $customer = new Customer();

            // check request : 
            if($_SERVER['REQUEST_METHOD'] === "POST") {
                // check empty fields : 
                if(empty($_POST['full_name'])) { $error .= "Full Name Field Required ! <br>"; }
                if(empty($_POST['email'])) { $error .= "Email Field Required ! <br>"; }
                if(empty($_POST['message'])) { $error .= "Message Field Required ! <br>"; }

                // validate & sanitize inputs : 
                $fullName = htmlspecialchars(filter_input(INPUT_POST, "full_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                if (!preg_match('/^[\p{L}\s]+$/u', $fullName)) {
                    $error .= "Full Name can only contain letters and spaces!<br>";
                }                
                $customerMessage = htmlspecialchars(filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                if (!preg_match('/^[\p{L}0-9\s.,!?@#\(\)-]+$/u', $customerMessage)) {
                    $error .= "Message can only contain letters, numbers, and common punctuation!<br>";
                }                
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error .= "Invalid Email! <br>";
                }

                // if empty errors : 
                if(empty($error)) {
                    try {
                        $success = $customer->sendMessage($fullName, $email, $customerMessage);
                        if($success) {
                            $message .= "
                                Your Message Send Successfully ✔
                                <script>
                                    setTimeout(function() {
                                        window.location.href = 'routes.php?action=customerHome';
                                    }, 1000);
                                </script>
                            ";
                        } else {
                            $error .= "Failed To Send Your Message , Please Try Again ! <br>";
                        }
                    } catch (Exception $e) {
                        $error .= "Something went wrong, please try again ! <br>";
                    }
                }
            }
            require_once "views/location-contact.php";
        }

        // categories list Action :
        public static function categories_List_Action() {
            $error = "";
            $customer = new Customer();

            $categoriesList = [];
            $categoriesList = $customer->categoriesList();
            if(empty($categoriesList)) {
                $error .= "Menu Wil Be Available Soon. Thank You For Understanding.";
            }
            require_once "index.php";
        }

        // random products action
        public static function random_Categories_Action() {
            $error = "";
            $customer = new Customer();
            $randomProducts = [];

            $randomProducts = $customer->randomCategories();
            if(empty($randomProducts)) {
                $error .= "No Available Products Fod The Moment. Thank You!";
            }
            return $randomProducts;
        }

        // products list action 
        public static function products_List_Action() {
            $error = "";
            $customer = new Customer();
            $productsList = [];

            $productsList = $customer->productsList();
            if(empty($productsList)) {
                $error .= "For The Moment There Is No Available Food. Thank For Understanding.";
            }
            // return products list
            return $productsList;
        }

        // find food action : 
        public static function find_Food_Action() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        
            $errorFood = "";
            $customer = new Customer();
            $food = [];
        
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $food_name = trim($_POST['food-name'] ?? '');
                // Check if empty
                if (empty($food_name)) {
                    $errorFood .= "You Must Enter The Name Of Your Favourite Dish!";
                }
                elseif (!preg_match('/^[\p{L}\s]+$/u', $food_name)) {
                    $errorFood .= "Food Name can only contain letters and spaces!<br>";
                } 
                else {
                    $food_name = htmlspecialchars($food_name);
                    $food = $customer->findFood($food_name);
                    if (empty($food)) {
                        $errorFood .= "The food you're looking for is not available at the moment! Thank You";
                    } else {
                        // Store in session and redirect
                        $_SESSION['favFood'] = $food;
                        header("Location: routes.php?action=favFood");
                        exit();
                    }
                }
            }
            require_once "views/menu.php";
        }

        // fav Food action :
        public static function fav_Food_Action() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['favFood']) || empty($_SESSION['favFood'])) {
                header('Location: routes.php?action=menu');
                exit();
            }
        
            $food = $_SESSION['favFood'];
            unset($_SESSION['favFood']);
            require_once "views/find-food.php";
        } 

        // order food action : 
        public static function order_Food_Action() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_GET['proId']) && !empty($_GET['proId'])) {
                // Validate the ID
                $productId = filter_var($_GET['proId'], FILTER_VALIDATE_INT);
                if (!$productId) {
                    header("Location: routes.php?action=customerHome");
                    exit();
                }

                // ✅ Check if product exists in the database before storing it in the session
                $customer = new Customer();
                $productData = $customer->product_Data($productId);

                if ($productData) {
                    $_SESSION['productId'] = $productId;
                } else {
                    header("Location: routes.php?action=customerHome");
                    exit();
                }
            }
            // ✅ Implement CSRF token check (if used in forms later)
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
            require_once "views/orderFood.php";
        }        

        // Confirm Order Action:
        public static function confirm_Order_Action() {
            $error = "";
            $message = "";
            $success = "";
            $productData = [];
            $customer = new Customer();

            // Start session if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Check request method
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Validate required fields
                if (empty($_POST['product_id']) || !filter_var($_POST['product_id'], FILTER_VALIDATE_INT)) {
                    $error .= "Invalid Product ID! <br>";
                }
                if (empty($_POST['full_name']) || !preg_match('/^[\p{L}\s]+$/u', $_POST['full_name'])) {
                    $error .= "Full name is required and can only contain letters and spaces!<br>";
                }
                if (empty($_POST['phone']) || !preg_match('/^\+?\d{8,15}$/', $_POST['phone'])) {
                    $error .= "Phone number is invalid! <br>";
                }
                if (empty($_POST['location']) || !preg_match('/^[\p{L}0-9\s.,!?@#\(\)-]+$/u', $_POST['location'])) {
                    $error .= "Delivery address is required!<br>";
                }
                if (empty($_POST['date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['date'])) {
                    $error .= "Invalid delivery date format! <br>";
                } else {
                    $today = date("Y-m-d");
                    if ($_POST['date'] < $today) {
                        $error .= "Delivery date cannot be in the past! <br>";
                    }
                }
                if (empty($_POST['quantity']) || !filter_var($_POST['quantity'], FILTER_VALIDATE_INT) || $_POST['quantity'] <= 0) {
                    $error .= "Quantity must be a positive number! <br>";
                }

                // If no errors, proceed with the order
                if (empty($error)) {
                    try {
                        // Sanitize input
                        $productId = intval($_POST['product_id']);
                        $customerId = $_SESSION['customerId'] ?? null; // Fixed typo
                        $full_name = htmlspecialchars(trim($_POST['full_name']), ENT_QUOTES, 'UTF-8');
                        $phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES, 'UTF-8');
                        $deliveryAddress = htmlspecialchars(trim($_POST['location']), ENT_QUOTES, 'UTF-8');
                        $deliveryDate = htmlspecialchars(trim($_POST['date']), ENT_QUOTES, 'UTF-8');
                        $quantity = intval($_POST['quantity']);

                        // Ensure customer is logged in
                        if (!$customerId) {
                            header('Location: routes.php?action=home');
                            exit();
                        }

                        // Get product price
                        $productData = $customer->product_Data($productId);
                        if (!$productData) {
                            header("Location: routes.php?action=menu");
                            exit();
                        }

                        $productPrice = $productData['product_price'];
                        $total_price = $productPrice * $quantity;

                        // Confirm order
                        $success = $customer->confirmOrder($productId, $customerId, $full_name, $phone, $deliveryAddress, $deliveryDate, $quantity, $total_price);
                        if ($success) {
                            $message .= "
                                Your Order Has Been Confirmed Successfully ✔
                                <script>
                                    setTimeout(function() {
                                        window.location.href = 'routes.php?action=myOrders';
                                    }, 1000);
                                </script>
                            ";
                        } else {
                            $error .= "Failed to confirm your order, please try again! <br>";
                        }
                    } catch (Exception $e) {
                        $error .= "Something went wrong: " . htmlspecialchars($e->getMessage()) . "<br>";
                    }
                }
            }
            // Load the view
            require_once "views/orderFood.php";
        }

        // customer order action : 
        public static function customer_Orders_Action() {
            $error = "";
            $customer = new Customer();
            $customerOrders = [];

            if(session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $customerId = filter_var($_SESSION['customerId'], FILTER_VALIDATE_INT);
            if(!$customerId) {
                header('Location: routes.php?action=home');
                exit();
            } else {
                $customerOrders = $customer->customerOrders($customerId);
                if(empty($customerOrders)) {
                    $error .= "You have no order for the moment !";
                }
            }
            require_once "views/customerOrders.php";
        }


    }
?>