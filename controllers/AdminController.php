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
                                        $message .= "
                                            New Category Added ✔
                                            <script>
                                                setTimeout(function() {
                                                    window.location.href = 'routes.php?action=adminMenu';
                                                }, 1000);
                                            </script>
                                        ";
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
            $error = "";
            $success = false;
            $message = "";
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            $maxFileSize = 3 * 1024 * 1024;

            if($_SERVER['REQUEST_METHOD'] === "POST") {
                // check for messing fields
                if(empty($_POST['product_name'])) { $error .= "Product Name Required ! <br>" ;}
                if(empty($_POST['product_description'])) { $error .= "Product Description Required ! <br>" ;}
                if(empty($_POST['product_price'])) { $error .= "Product Price Required ! <br>" ;}
                if (!isset($_FILES['product_image']) || $_FILES['product_image']['error'] !== UPLOAD_ERR_OK) {
                    $error .= "Product Image Required ! <br>";
                }
                if(empty($_POST['category_id'])) { $error .= "Product Category Required ! <br>" ;}

                // sanitize inputs
                $product_name = htmlspecialchars(trim($_POST["product_name"]));
                $product_description = htmlspecialchars(trim($_POST["product_description"]));
                // validate price
                if(filter_var($_POST['product_price'],  FILTER_VALIDATE_INT)) {
                    $product_price = intval($_POST['product_price']);
                } elseif (filter_var($_POST['product_price'], FILTER_VALIDATE_FLOAT)) {
                    $product_price = floatval($_POST['product_price']);
                } else {
                    $error .= "Invalid Price ! Example : 15 or 15.55 ";
                }
                // validate category id
                if(filter_var($_POST['category_id'], FILTER_VALIDATE_INT)) {
                    $category_id = intval($_POST['category_id']);
                } else {
                    $error .= "Invalid Category id ! <br> ";
                }

                // validate name & description
                if (!preg_match('/^[\p{L}\s]+$/u', $product_name)) {
                    $error .= "Name can only contain letters and spaces!<br>";
                }                
                if (!preg_match('/^[\p{L}0-9\s.,!?\(\)-]+$/u', $product_description)) {
                    $error .= "Description can only contain letters and spaces!<br>";
                }

                // Handle image upload
                $imageName = uniqid() . "_" . basename($_FILES['product_image']['name']);
                $imageSize = $_FILES['product_image']['size'];
                $imageTmp  = $_FILES['product_image']['tmp_name'];
                $imageType = $_FILES['product_image']['type'];
                $imageFolder = "views/admin/uploads/products/";
                $product_image = $imageFolder . $imageName; 
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
                    $query = $db->connect()->prepare("SELECT product_name FROM products WHERE product_name = ?");
                    $query->execute([$product_name]);
                    if ($query->rowCount() > 0) {
                        $error .= "product Already Exists ! <br>";
                    } else {
                        // Save image to the server
                        if (move_uploaded_file($imageTmp, $product_image)) {
                            try {
                                $admin = new Admin();
                                $success = $admin->add_product($product_name, $product_description, $product_price, $product_image, $category_id);
                                if($success === true) {
                                    $message .= "
                                        New Product Added ✔
                                        <script>
                                            setTimeout(function() {
                                                window.location.href = 'routes.php?action=adminProducts';
                                            }, 1000);
                                        </script>
                                    ";
                                } else {
                                    $error .= "Failed To Add New Product !";
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
            require_once "views/admin/add-product.php";
        }

        // admin products action :
        public static function admin_products() {
            require_once "views/admin/products.php";
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