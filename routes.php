<?php
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
                CustomersController::signUp_Action();
                break;
            default : 
                "home";
        }
    }
    else {
        echo "404 - Page Not Found";
    }
?>