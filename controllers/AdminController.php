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

    }
?>