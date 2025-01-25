<?php
    namespace controllers;
    use Exception;
    use models\Customer;
    use models\Admin;
    use models\Database;

    class AdminController {
        // dashbaord Action 
        public static function admin_Dashboard_Action() {
            require_once "views/admin/dashboard.php";
        }

        // add-category action :
        public static function add_Category_Action() {
            $error = "";
            $success = false;
            $message = "";
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            $maxFileSize = 3 * 1024 * 1024;
        
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Check for missing inputs
                if (empty($_POST['category_name'])) { $error .= "Category Name Required ! <br>"; }
                if (empty($_POST['category_description'])) { $error .= "Category Description Required ! <br>"; }
                if (!isset($_FILES['category_image']) || $_FILES['category_image']['error'] !== UPLOAD_ERR_OK) {
                    $error .= "Category Image Required !     <br>";
                }
        
                if (empty($error)) {
                    // Sanitize inputs
                    $categoryName = htmlspecialchars(trim($_POST['category_name']));
                    $categoryDescription = htmlspecialchars(trim($_POST['category_description']));
        
                    // Handle image upload
                    $imageName = uniqid() . "_" . basename($_FILES['category_image']['name']);
                    $imageSize = $_FILES['category_image']['size'];
                    $imageTmp  = $_FILES['category_image']['tmp_name'];
                    $imageType = $_FILES['category_image']['type'];
                    $imageFolder = "views/admin/uploads/categories/";
                    $categoryImage = $imageFolder . $imageName;
        
                    // Validate image type and size
                    if (!in_array($imageType, $allowedTypes)) {
                        $error .= "Invalid Image Type (Allowed: JPG, PNG, JPEG) <br>";
                    }
                    if ($imageSize > $maxFileSize) {
                        $error .= "Image Size Must Be Less Than 3MB <br>";
                    }
        
                    // Proceed if no image errors
                    if (empty($error)) {
                        // Check if category name exists
                        $db = new Database();
                        $query = $db->connect()->prepare("SELECT category_name FROM categories WHERE category_name = ?");
                        $query->execute([$categoryName]);
                        if ($query->rowCount() > 0) {
                            $error .= "Category Already Exists ! <br>";
                        } else {
                            // Save image to the server
                            if (move_uploaded_file($imageTmp, $categoryImage)) {
                                try {
                                    $admin = new Admin();
                                    $success = $admin->add_category($categoryName, $categoryDescription, $categoryImage);
                                    if($success) {
                                        $message = "New Category Added ✔";
                                        header('Location: routes.php?action=adminMenu');
                                        exit();
                                    } else {
                                        $error .= "Failed To Add New Category !";
                                    }
                                } catch (Exception $e) {
                                    $error .= "Error: " . $e->getMessage();
                                }
                            } else {
                                $error .= "Failed to Upload Image <br>";
                            }
                        }
                    }
                }
            }
            require_once "views/admin/add-category.php";
        }

        // add-Product action :
        public static function add_Product_Action() {
            require_once "views/admin/add-product.php";
        }

        // admin menu action :
        public static function admin_Menu_Action() {
            require_once "views/admin/menu.php";
        }

        // orders menu action :
        public static function admin_Orders_Action() {
            require_once "views/admin/orders.php";
        }

        // orders messages action :
        public static function admin_Messages_Action() {
            require_once "views/admin/messages.php";
        }

        // admin profile action :
        public static function admin_Profile_Action() {
            require_once "views/admin/profile.php";
        }
    }
?>