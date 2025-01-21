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
            default : 
                "home";
        }
    }
    else {
        echo "404 - Page Not Found";
    }
?>