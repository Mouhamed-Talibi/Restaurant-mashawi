<?php
    session_start();
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
            case "errorPage" :
                CustomersController::page_Error_Action();
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
            case "AdmErrorPage" :
                AdminController::adm_Error_Page_Action();
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
            case "editAdmInf" :
                AdminController::admin_Edit_Profile_Action();
                break;
            case "updateAdmPro" :
                AdminController::update_Admin_Profile_Action();
                break;
            case "ChangeAdmPsw" :
                AdminController::change_Password_Action();
                break;
            case "updateAdmPss" :
                AdminController::update_Admin_Password_Action();
                break;
            case "checkStatus" :
                AdminController::admin_Status_Action();
                break;
            case "about" :
                CustomersController::about_Action();
                break;
            case "menu" :
                CustomersController::menu_Action();
                break;
            case "expFood":
                if (isset($_GET['catId']) && is_numeric($_GET['catId'])) {
                    CustomersController::explore_Products_Action();
                } else {
                    CustomersController::page_Error_Action();
                }
                break;
            case "services" :
                CustomersController::services_Action();
                break;
            case "location" :
                CustomersController::location_Action();
                break;
            case "contact" :
                CustomersController::contact_Action();
                break;
            case "sendMessage" :
                CustomersController::send_Message_Action();
                break;
            case "findFood" :
                CustomersController::find_Food_Action();
                break;
            case "favFood" :
                CustomersController::fav_Food_Action();
                break;
            case "logout":
                CustomersController::logout_Action();
                break;
            default: 
                if (isset($_SESSION['adminId']) && isset($_SESSION['adminEmail']) && isset($_SESSION['adminRole'])) {
                    header("Location: routes.php?action=AdmErrorPage");
                    exit;
                } elseif (isset($_SESSION['customerId']) && isset($_SESSION['customerEmail']) && isset($_SESSION['customerRole'])) {
                    header("Location: routes.php?action=errorPage");
                    exit;
                } else {
                    header("Location: routes.php?action=home");
                    exit;
                }
        }
    }
?>