<?php
    namespace controllers;
    use Exception;
    use models\Customer;
    use models\Admin;
    use models\Database;
    use PDO;


    class AdminController {
        // dashbaord Action 
        public static function admin_Dashboard_Action() {
            require_once "views/admin/dashboard.php";
        }

        // admin status action 
        public static function admin_Status_Action() {
            if(session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        
            if (!isset($_SESSION['adminId'], $_SESSION['adminEmail'], $_SESSION['adminRole'])) {
                // If there is no admin session, redirect to home
                header("Location: routes.php?action=home");
                exit;
            }
        
            $admin = new Admin();
            $adminId = $_SESSION['adminId'];
            $adminEmail = $_SESSION['adminEmail'];
            $adminRole = $_SESSION['adminRole'];
        
            $adminData = $admin->admin_Data($adminId);
            
            // Redirect if ANY of the values don't match
            if ($adminId !== $adminData['id'] || $adminEmail !== $adminData['email'] || $adminRole !== $adminData['role']) {
                header("Location: routes.php?action=home");
                exit;
            }
        
            // If admin session is valid, redirect to adminDashboard
            header("Location: routes.php?action=adminDashboard");
            exit;
        }  

        // admin error page action 
        public static function adm_Error_Page_Action(){
            require_once "views/admin/pageError.php";
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
            $error = "";
            $admin = new Admin();
            $productsList = [];

            $productsList = $admin->productsList();
            if(empty($productsList)) {
                $error .= "Food Will Be Available Soon. Thank You For Understanding.";
            }
            require_once "views/admin/products.php";
        }

        // explore food 
        public static function admin_explore_food() {
            $error = "";
            $products = [];
        
            if (isset($_GET['catId'])) {
                // Sanitize and validate the category_id
                $category_id = filter_var($_GET['catId'], FILTER_VALIDATE_INT);
                
                // Check if category_id is valid
                if ($category_id === false) {
                    $error .= "Invalid Category ID!";
                } else {
                    try {
                        // Instantiate Admin class and fetch products
                        $admin = new Admin();
                        $products = $admin->explore_Food($category_id);
                        require_once "views/admin/food.php";
                        exit();
                    } catch (Exception $e) {
                        $error .= "Something went wrong while fetching food products. Please try again" . $e->getMessage();
                    }
                }
            }
        }

        // admin menu action :
        public static function admin_Menu_Action() { 
            $error = "";
            $admin = new Admin();
            $categoriesList = [];

            $categoriesList = $admin->categories_List();
            if(empty($categoriesList)) {
                $error .= "Menu will Be Availabe Soon. Thank You For Undertanding.";
            }
            require_once "views/admin/menu.php";
        }

        // orders menu action :
        public static function admin_Orders_Action() {
            $error = "";
            $admin = new Admin();
            $ordersList =  [];

            try {
                $ordersList = $admin->ordersList();
                if(empty($ordersList)) {
                    $error .= "No Orders Available For The Moment !";
                }
            } catch (Exception $e) {
                $error .= "Something went wrong in orders list : " . $e->getMessage();
            }
            require_once "views/admin/orders.php";
            return $ordersList;
        }

        // orders messages action :
        public static function admin_Messages_Action() {
            $error = "";
            $admin = new Admin();
            $messagesList = $admin->messagesList();
            if(empty($messagesList)) {
                $error .= "No Messages Available For The Moment !";
            }
            require_once "views/admin/messages.php";
        }

        // admin profile action :
        public static function admin_Profile_Action() {
            $admin = new Admin();
            if(session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $adminData = $admin->admin_Data($_SESSION['adminId']);
            require_once "views/admin/profile.php";
        }

        // edit category action :
        public static function edit_Category_Action() {
            $error = "";
            $categoryData = [];

            if(isset($_GET['catId'])) {
                try {
                    if(filter_var($_GET['catId'], FILTER_VALIDATE_INT)) {
                        $categoryId = intval($_GET['catId']);
                    } else {
                        $error .= "Invalid Category Id !";
                    }
                    // get category data : 
                    $admin = new Admin();
                    $categoryData = $admin->edit_category($categoryId);
                } catch (Exception $e) {
                    $error .= "something went wrong : " . $e->getMessage();
                }
            }
            require_once "views/admin/edit_category.php";
            exit();
        }

        // update category action :
        public static function update_Category_Action() {
            $error = "";
            $message = "";
            $success = false;
            $unlinked = false;
            $allowedtypes = ['image/jpg', 'image/jpeg', 'image/png'];
            $categoryData = [];
            $maxFileSize = 3 * 1024 * 1024; // 3MB
        
            // Check for server request
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Check for empty fields
                if (empty($_POST['category_name'])) { $error .= "Category Name Required ! <br>"; }
                if (empty($_POST['category_description'])) { $error .= "Category Description Required ! <br>"; }
                if (empty($_POST['category_id'])) { $error .= "Category Id Required ! <br>"; }
        
                // Validate ID and sanitize fields
                if (filter_var($_POST['category_id'], FILTER_VALIDATE_INT)) {
                    $category_id = intval(filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT));
                } else {
                    $error .= "Invalid Category Id ! <br>";
                }
                $newCategoryName = trim(filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_SPECIAL_CHARS));
                $newCategoryDescription = trim(filter_input(INPUT_POST, 'category_description', FILTER_SANITIZE_SPECIAL_CHARS));
        
                // Fetch the category data to repopulate the form if needed
                $admin = new Admin();
                $categoryData = $admin->edit_category($category_id);

                // If a new image is uploaded
                if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
                    $admin = new Admin();
                    $olderImage = $admin->get_Category_Image($category_id); // This now returns the image path directly
        
                    // If the old image exists, delete it
                    if (!empty($olderImage) && file_exists($olderImage)) {
                        if ($unlinked = unlink($olderImage)) {
                            // Handle the new image
                            $newCategoryImage = $_FILES['category_image'];
                            $imageName = uniqid() . "_" . basename($newCategoryImage['name']);
                            $imageTmp = $newCategoryImage['tmp_name'];
                            $imageSize = $newCategoryImage['size'];
                            $imageType = $newCategoryImage['type'];
                            $imageFolder = "views/admin/uploads/categories/";
                            $newCategoryImagePath = $imageFolder . $imageName;
        
                            // Check size and type
                            if (!in_array($imageType, $allowedtypes)) {
                                $error .= "Invalid Image Type, Allowed(PNG, JPG, JPEG) ! <br>";
                            }
                            if ($imageSize > $maxFileSize) {
                                $error .= "Image Size Must Be Less Than 3 MB ! <br>";
                            }
        
                            // If the file is moved successfully
                            if (move_uploaded_file($imageTmp, $newCategoryImagePath)) {
                                try {
                                    $success = $admin->update_Category($newCategoryName, $newCategoryDescription, $newCategoryImagePath, $category_id);
                                    if ($success) {
                                        $message .= "
                                            Category Updated Successfully ✔
                                            <script>
                                                setTimeout(function() {
                                                    window.location.href = 'routes.php?action=adminMenu';
                                                }, 1000);
                                            </script>
                                        ";
                                    } else {
                                        $error .= "Failed To Update The Category !";
                                    }
                                } catch (Exception $e) {
                                    error_log("Error With Update Category Action: " . $e->getMessage());
                                }
                            } else {
                                $error .= "There Is A Problem With Image Path !";
                            }
                        } else {
                            $error .= "Failed To Delete The Old Image ! <br>";
                        }
                    } else {
                        $error .= "Older Image Not Found !!";
                    }
                } else {
                    // Update name & description only
                    try {
                        $admin = new Admin();
                        $olderImage = $admin->get_Category_Image($category_id); // This now returns the image path directly
                        $success = $admin->update_Category($newCategoryName, $newCategoryDescription, $olderImage, $category_id);
                        if ($success) {
                            $message .= "
                                Category Updated Successfully ✔
                                <script>
                                    setTimeout(function() {
                                        window.location.href = 'routes.php?action=adminMenu';
                                    }, 1000);
                                </script>
                            ";
                        } else {
                            $error .= "Failed To Update The Category !";
                        }
                    } catch (Exception $e) {
                        error_log("A Problem With Updating The Name And The Description: " . $e->getMessage());
                    }
                }
            }
            // Include the add-category view to display errors or success messages
            require_once "views/admin/edit_category.php";
        }

        // delete category action :
        public static function delete_category_Action() {
            $error = "";
            $categoryData = [];

            if(isset($_GET['catId']) && !empty($_GET['catId'])) {
                if(filter_input(INPUT_GET, 'catId', FILTER_SANITIZE_NUMBER_INT)) {
                    $category_id = intval($_GET['catId']);
                    if($category_id) {
                        $admin = new Admin();
                        $categoryData = $admin->edit_category($category_id);
                        if(!$categoryData) {
                            $error .= "Category Not Found !";
                        }
                    }
                }
            }
            require_once "views/admin/delete_category.php";
        }

        // destroy category action :
        public static function destroy_Category_Action() {
            $error = "";
            $message = "";
            $success = false;
            $unlinked = false;

            if (isset($_GET['catId']) && !empty($_GET['catId'])) {
                $category_id = filter_input(INPUT_GET, 'catId', FILTER_SANITIZE_NUMBER_INT);
                if (!$category_id) {
                    $error .= "Invalid Category Id! <br>";
                }

                try {
                    // Fetch category data
                    $admin = new Admin();
                    $categoryData = $admin->edit_category($category_id);

                    // Check if category data is valid
                    if (!$categoryData) {
                        throw new Exception("Category Not Found!");
                    }

                    // Unlink the image from its folder
                    $CategoryImage = $categoryData['category_image'];
                    if (file_exists($CategoryImage)) {
                        $unlinked = unlink($CategoryImage);
                        if (!$unlinked) {
                            throw new Exception("Failed to delete the old image! <br>");
                        }
                    } else {
                        throw new Exception("Image file does not exist! <br>");
                    }

                    // Delete the category from the database
                    $success = $admin->delete_Category($category_id);
                    if ($success) {
                        $message .= "
                            Category Deleted Successfully ✔
                            <script>
                                setTimeout(function() {
                                    window.location.href = 'routes.php?action=adminMenu';
                                }, 1000);
                            </script>
                        ";
                    } else {
                        throw new Exception("Category Not Deleted! <br>");
                    }
                } catch (Exception $e) {
                    $error = "Something Went Wrong With Category Deletion: " . $e->getMessage();
                }
            } else {
                $error = "Category ID is missing!";
            }
            // Include the view to display errors or success messages
            require_once "views/admin/delete_category.php";
        }

        // edit product action :
        public static function edit_Product_Action()  {
            $error = "";
            $categoriesList = [];
            $productData = [];

            if(isset($_GET['proId']) && !empty($_GET['proId'])) {
                // validate Product id :
                if(filter_input(INPUT_GET, "proId", FILTER_VALIDATE_INT)) {
                    $productId = $_GET['proId'];
                } else {
                    $error .= "Invalid Product Id <br>";
                } 

                // if no error
                try {
                    $admin = new Admin();
                    $categoriesList = $admin->categories_List();
                    $productData = $admin->get_Product_Data($productId);
                } catch (Exception $e) {
                    $error .= "Soemthing went Wrong : " . $e->getMessage();
                }
            }
            // require edit page
            require_once "views/admin/edit_product.php";
        }

        // update product Action 
        public static function update_Product_Action() {
            $error = "";
            $message = "";
            $success = false;
            $allowedtypes = ['image/jpg', 'image/jpeg', 'image/png'];
            $maxFileSize = 2 * 1024 * 1024; // 2MB Limit
            $admin = new Admin();
        
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Validate required fields
                if (empty($_POST['product_name'])) { $error .= "Product Name Required!<br>"; }
                if (empty($_POST['product_description'])) { $error .= "Product Description Required!<br>"; }
                if (empty($_POST['product_price'])) { $error .= "Product Price Required!<br>"; }
                if (empty($_POST['product_id']) || !filter_var($_POST['product_id'], FILTER_VALIDATE_INT)) { 
                    $error .= "Invalid Product ID!<br>"; 
                }
                if (empty($_POST['category_id']) || !filter_var($_POST['category_id'], FILTER_VALIDATE_INT)) { 
                    $error .= "Product Category Required!<br>"; 
                }
        
                // Sanitize inputs
                $product_id = intval($_POST['product_id']);
                $newProductName = trim(filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_SPECIAL_CHARS));
                $newProductDescription = trim(filter_input(INPUT_POST, 'product_description', FILTER_SANITIZE_SPECIAL_CHARS));
                $newCategory_id = intval($_POST['category_id']);
        
                // Validate & sanitize price
                if (filter_var($_POST['product_price'], FILTER_VALIDATE_FLOAT)) {
                    $newProduct_price = floatval($_POST['product_price']);
                } else {
                    $error .= "Invalid Product Price!<br>";
                }
        
                // Fetch existing product data
                $productData = $admin->get_Product_Data($product_id);
                if (!$productData) {
                    $error .= "Product not found!<br>";
                }
        
                // Handle Image Upload
                $newProductImagePath = $productData['product_image']; // Default to old image
                if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                    $newProductImage = $_FILES['product_image'];
                    $imageName = uniqid() . "_" . basename($newProductImage['name']);
                    $imageTmp = $newProductImage['tmp_name'];
                    $imageSize = $newProductImage['size'];
                    $imageType = $newProductImage['type'];
                    $imageFolder = "views/admin/uploads/products/";
                    $newProductImagePath = $imageFolder . $imageName;
        
                    // Image Validation
                    if (!in_array($imageType, $allowedtypes)) {
                        $error .= "Invalid Image Type, Allowed (PNG, JPG, JPEG)!<br>";
                    }
                    if ($imageSize > $maxFileSize) {
                        $error .= "Image Size Must Be Less Than 2MB!<br>";
                    }
        
                    // Stop execution if image validation fails
                    if (!empty($error)) {
                        require_once "views/admin/edit_product.php";
                        exit;
                    }
        
                    // Move uploaded image
                    if (move_uploaded_file($imageTmp, $newProductImagePath)) {
                        // Unlink old image if exists
                        if (!empty($productData['product_image']) && file_exists($productData['product_image'])) {
                            unlink($productData['product_image']);
                        } else {
                            $error .= "Failed To Unlink The Old Imae! <br>";
                        }
                    } else {
                        $error .= "Failed to upload the new image!<br>";
                    }
                }
        
                // Stop execution if any validation errors exist
                if (!empty($error)) {
                    require_once "views/admin/edit_product.php";
                    exit;
                }
        
                // Update product in database
                try {
                    $success = $admin->update_Product($newProductName, $newProductDescription, $newProduct_price, $newProductImagePath, $newCategory_id, $product_id);
                    if ($success) {
                        $message .= "
                            Product Updated Successfully ✔
                            <script>
                                setTimeout(function() {
                                    window.location.href = 'routes.php?action=adminProducts';
                                }, 1000);
                            </script>
                        ";
                    } else {
                        $error .= "Failed To Update The Product!<br>";
                    }
                } catch (Exception $e) {
                    error_log("Error With Update Product Action: " . $e->getMessage());
                }
            }
        
            // Include edit page to display errors or success messages
            require_once "views/admin/edit_product.php";
        }    

        // delete Product action :
        public static function delete_Product_Action() {
            $error = "";
            $productData = [];
            if(isset($_GET['proId']) && !empty($_GET['proId'])) {
                if(filter_input(INPUT_GET, 'proId', FILTER_SANITIZE_NUMBER_INT)) {
                    $product_id = intval($_GET['proId']);
                    if($product_id) {
                        $admin = new Admin();
                        $productData = $admin->get_Product_Data($product_id);
                        if(!$productData) {
                            $error .= "Product Not Found !";
                        }
                    }
                }
            }
            require_once "views/admin/delete_product.php";
        }

        // destroy Product action :
        public static function destroy_Product_Action() {
            $error = "";
            $message = "";
            $success = false;
            $unlinked = false;

            if (isset($_GET['proId']) && !empty($_GET['proId'])) {
                $product_id = filter_input(INPUT_GET, 'proId', FILTER_SANITIZE_NUMBER_INT);
                if (!$product_id) {
                    $error .= "Invalid Product Id! <br>";
                }
                try {
                    // Fetch product data
                    $admin = new Admin();
                    $productData = $admin->get_Product_Data($product_id);

                    // Check if product data is valid
                    if (!$productData) {
                        throw new Exception("Product Not Found!");
                    }

                    // Unlink the image from its folder
                    $productImage = $productData['product_image'];
                    if (file_exists($productImage)) {
                        $unlinked = unlink($productImage);
                        if (!$unlinked) {
                            throw new Exception("Failed to delete the old image! <br>");
                        }
                    } else {
                        throw new Exception("Image file does not exist! <br>");
                    }

                    // Delete the product from the database
                    $success = $admin->delete_Product($product_id);
                    if ($success) {
                        $message .= "
                            Product Deleted Successfully ✔
                            <script>
                                setTimeout(function() {
                                    window.location.href = 'routes.php?action=adminProducts';
                                }, 1000);
                            </script>
                        ";
                    } else {
                        throw new Exception("Product Not Deleted! <br>");
                    }
                } catch (Exception $e) {
                    $error = "Something Went Wrong With Product Deletion: " . $e->getMessage();
                }
            } else {
                $error = "Product ID is missing!";
            }
            // Include the view to display errors or success messages
            require_once "views/admin/delete_product.php";
        }

        // admin edit profile action :
        public static function admin_Edit_Profile_Action() {
            $error = "";
            $admin = new Admin();
            $adminData = null; // Initialize to avoid undefined variable warning
        
            // Check if adminId is valid
            if (isset($_GET['admId']) && !empty($_GET['admId'])) {
                $adminId = filter_var($_GET['admId'], FILTER_VALIDATE_INT);
                if (!$adminId) {
                    $error .= "Admin Id Not Valid ! <br>";
                }
        
                // Start session only if not already started
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
        
                if (empty($error)) {
                    // Get session info
                    $adminInfos = [
                        'id' => $_SESSION['adminId'],
                        'adminEmail' => $_SESSION['adminEmail'],
                        'adminRole' => $_SESSION['adminRole']
                    ];
        
                    // Fetch admin data from the database
                    $adminData = $admin->admin_Data($adminId);
        
                    if ($adminData && $adminInfos['id'] == $adminData['id'] && $adminInfos['adminEmail'] == $adminData['email'] && $adminInfos['adminRole'] == $adminData['role']) {
                        require_once "views/admin/edit_profile.php";
                        return;
                    } else {
                        $error .= "Unauthorized access or mismatch in admin data!<br>";
                    }
                }
            } else {
                $error .= "Admin Id is required!<br>";
            }
        
            // Ensure $adminData is at least an empty array to avoid undefined variable warnings
            if (!$adminData) {
                $adminData = [];
            }
        
            require_once "views/admin/edit_profile.php";
        }         

        // update admin profile action :
        public static function update_Admin_Profile_Action() {
            $error = "";
            $success = false;
            $message = "";
            $adminData = [];
            $admin = new Admin();
        
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Initialize adminId
                $adminId = $_POST['id'] ?? null;
                // Check empty fields
                if (empty($adminId)) { $error .= "Admin ID is required! <br>"; }
                if (empty($_POST['first_name'])) { $error .= "First Name is required! <br>"; }
                if (empty($_POST['last_name'])) { $error .= "Last Name is required! <br>"; }
                if (empty($_POST['email'])) { $error .= "Email is required! <br>"; }
                // Validate ID
                if (!filter_var($adminId, FILTER_VALIDATE_INT)) {
                    $error .= "Admin ID is not valid! <br>";
                }
                // Validate Email
                $newEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                    $error .= "Email format is not valid! <br>";
                }
                // Validate First Name
                if (!preg_match('/^[\p{L}\s]+$/u', $_POST['first_name'])) {
                    $error .= "First Name can only contain letters and spaces!<br>";
                } else {
                    $newFirst_name = htmlspecialchars($_POST['first_name']);
                }
                // Validate Last Name
                if (!preg_match('/^[\p{L}\s]+$/u', $_POST['last_name'])) {
                    $error .= "Last Name can only contain letters and spaces!<br>";
                } else {
                    $newLast_name = htmlspecialchars($_POST['last_name']);
                }

                if (empty($error)) {
                    if (isset($newFirst_name, $newLast_name, $newEmail)) {
                        $success = $admin->update_AdminData($newFirst_name, $newLast_name, $newEmail, $adminId);
                        if ($success) {
                            $message .= "
                                Profile Updated Successfully ✔
                                <script>
                                    setTimeout(function() {
                                        window.location.href = 'routes.php?action=adminProfile';
                                    }, 1000);
                                </script>
                            ";
                        } else {
                            $error .= "Failed to update your profile! <br>";
                        }
                    }
                }
            }
            // Ensure $adminData is always defined
            if (empty($adminData)) {
                $adminData = $admin->admin_Data($adminId);
            }
            require_once "views/admin/edit_profile.php";
        }   

        // admin change password action : 
        public static function change_Password_Action() {
            $error = "";
            $admin = new Admin();
            if(session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $adminData = $admin->admin_Data($_SESSION['adminId']);
            require_once "views/admin/change_password.php";
        }

        // admin update password action : 
        public static function update_Admin_Password_Action() {
            $error = "";
            $message = "";
            $success = false;
            $admin = new Admin();

            if($_SERVER['REQUEST_METHOD'] === "POST") {
                // check for empty fields : 
                if(empty($_POST['id'])) { $error .= "Admin Id Required ! <br>"; }
                if(empty($_POST['current_password'])) { $error .= "Current Password Required ! <br>"; }
                if(empty($_POST['new_password'])) { $error .= "New Password Required ! <br>"; }
                if(empty($_POST['confirm_password'])) { $error .= "You need to confirm your password ! <br>"; }

                // valid the id 
                $adminId = $_POST['id'];
                if(!filter_var($adminId, FILTER_VALIDATE_INT)) {
                    $error .= "Invalid Admin Id ! <br>";
                }

                // check if current pass matche the stored :
                $adminData = $admin->admin_Data($adminId);
                if(password_verify($_POST['current_password'] , $adminData['password'])) {
                    // valid new and confirmed password
                    if (strlen($_POST['new_password']) < 8 || strlen($_POST['new_password']) > 55) {
                        $error .= "Password Must Be Between 8 And 55 Chars! <br>";
                    }
                    if (!preg_match('/[A-Za-z]/', $_POST['new_password'])) {
                        $error .= "New Password Must Contain At Least One Letter! <br>";
                    }
                    if (!preg_match('/[0-9]/', $_POST['new_password'])) {
                        $error .= "New Password Must Contain At Least One Number! <br>";
                    }
                    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $_POST['new_password'])) {
                        $error .= "New Password Must Contain At Least One Special Character! <br>";
                    }
                    // set passwords var 
                    $newPassword = htmlspecialchars($_POST['new_password']);
                    $confirmedPass = htmlspecialchars($_POST['confirm_password']);
                    // check if new pass match the confirmed one 
                    if($newPassword === $confirmedPass) {
                        if(empty($error)) {
                            try {
                                $success = $admin->change_Password($newPassword, $adminId);
                                if($success) {
                                    $message .= "
                                        Password Changed Successfully ✔
                                        <script>
                                            setTimeout(function() {
                                                window.location.href = 'routes.php?action=adminProfile';
                                            }, 1000);
                                        </script>
                                    ";
                                } else {
                                    $error .= "Failed To Change your Password ! <br>";
                                }
                            } catch (Exception $e) {
                                $error .= "Something Went Wrong, Please Try Again ! <br>";
                            }
                        }
                    } else {
                        $error .= "Your confirmed Pass doesn't match the new Pass ! <br>";
                    }
                } else {
                    $error .= "Your Current Password Isn't Correct ! Try Again <br>";
                }
            }
            if(empty($adminData)) {
                $error .= "Cannot Update Your Password ! <br>";
            } 
            require_once "views/admin/change_password.php";
        }

        // total orders action : 
        public static function total_Orders_Action() {
            $error = "";
            $admin = new Admin();
            $totalCount = 0;
            try {
                $totaleOrders = $admin->totalOrders();
                $totalCount = count($totaleOrders);
            } catch (Exception $e) {
                $error .= "Something Went Wrong: " . $e->getMessage();
            }
        
            require_once "views/admin/dashboard.php";
            return $totalCount;
        }  

        // total orders action : 
        public static function pending_Orders_Action() {
            $error = "";
            $admin = new Admin();
            $pendingOrders = 0;
            try {
                $totaleOrders = $admin->pendingOrders();
                $pendingOrders = count($totaleOrders);
            } catch (Exception $e) {
                $error .= "Something Went Wrong: " . $e->getMessage();
            }
        
            require_once "views/admin/dashboard.php";
            return $pendingOrders;
        }  

        // recent orders action : 
        public static function recent_Orders_Action() {
            $error = "";
            $admin = new Admin();
            $recentOrders = [];
            try {
                $recentOrders = $admin->recentOrders();
                if(empty($recentOrders)) {
                    $error .= "No Recent Orders Found For The Moment ! ";
                }
            } catch (Exception $e) {
                $error .= "Something Went Wrong: " . $e->getMessage();
            }
            require_once "views/admin/dashboard.php";
            return $recentOrders;
        }

        // delete messages action  :
        public static function delete_Messages_Action() {
            $admin = new Admin();
            $success = false;
            $error = "";
            if($_SERVER['REQUEST_METHOD'] === "POST") {
                try {
                    $success = $admin->deleteMessages();
                    if($success) {
                        header("Location: routes.php?action=adminMessages");
                        exit;
                    } else {
                        $error .= "Failed to delete the messages, try again Later !";
                    }
                } catch (Exception $e) {
                    throw new Exception("Soemthing went wrong with deleting all messages !");
                }
            }
            require_once "views/admin/messages.php";
        }
    }
?>