<?php
    use controllers\AdminController;
    use controllers\CustomersController;
    require_once "Autoloader.php";

    // enable error reporting 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // manage routes
    if(isset($_GET['action'])) {
        $action = htmlspecialchars($_GET['action']);
        // switch action
        switch ($action) {
            case "home" : 
                CustomersController::homeAction();
                break;
            case "signup" : 
                CustomersController::signUp_Action();
                break;
            case "login" :
                CustomersController::loginAction();
                break;
            case "adminDashboard" :
                AdminController::admin_Dashboard_Action();
                break;
            case "customerHome" :
                CustomersController::customer_Home_Action();
                break;
            case "adminMenu" :
                AdminController::admin_Menu_Action();
                break;
            case "adminOrders" :
                AdminController::admin_Orders_Action();
                break;
            case "adminMessages" :
                AdminController::admin_Messages_Action();
                break;
            case "addCategory" :
                AdminController::add_Category_Action();
                break;
            case "addProduct" :
                AdminController::add_Product_Action();
                break;
            case "adminProducts" :
                AdminController::admin_products();
                break;
            case "exploreFood" :
                AdminController::admin_explore_food();
                break;
            case "adminProfile" :
                AdminController::admin_Profile_Action();
                break;
            case "editCategory" :
                AdminController::edit_Category_Action();
                break;
            case "updateCategory" :
                AdminController::update_Category_Action();
                break;
            case "deleteCategory" :
                AdminController::delete_Category_Action();
                break;
            case "destroyCategory" :
                AdminController::destroy_Category_Action();
                break;
            case "editProduct" :
                AdminController::edit_Product_Action();
                break;
            case "updateProduct" : 
                AdminController::update_Product_Action();
                break;
            case "deleteProduct" :
                AdminController::delete_Product_Action();
                break;
            case "destroyProduct" :
                AdminController::destroy_Product_Action();
                break;
            case "logout":
                CustomersController::logout_Action();
                break;
            default : 
                CustomersController::page_Error_Action();
                break;
        }
    }
?>