<?php
    namespace controllers;
    use models\customer;
    use models\Database;

    class AdminController {
        // dashbaord Action 
        public static function admin_Dashboard_Action() {
            require_once "views/admin/dashboard.php";
        }
    }
?>