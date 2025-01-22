<?php
    namespace controllers;
    use models\customer;
    use models\Database;

    class AdminController {
        // dashbaord Action 
        public static function admin_Dashboard_Action() {
            require_once "views/admin/dashboard.php";
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

        // add-category action :
        public static function add_Category_Action() {
            require_once "views/admin/add-category.php";
        }

        // add-Product action :
        public static function add_Product_Action() {
            require_once "views/admin/add-product.php";
        }

        // admin profile action :
        public static function admin_Profile_Action() {
            require_once "views/admin/profile.php";
        }
    }
?>