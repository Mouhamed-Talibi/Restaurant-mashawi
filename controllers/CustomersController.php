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
                        $error .= "Food Will Be Available Soon :) <br>";
                    }
                    require_once "views/food.php";
                } catch (Exception $e) {
                    $error .= "No Availabel Products For The Moement ! <br>";
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
        public static function random_Products_Action() {
            $error = "";
            $customer = new Customer();
            $randomProducts = [];

            $randomProducts = $customer->randomProducts();
            if(empty($randomProducts)) {
                $error .= "No Available Products Fod The Moment. Thank You!";
            }
            return $randomProducts;
        }

    }
?>