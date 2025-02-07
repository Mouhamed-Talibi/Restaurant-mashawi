<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_regenerate_id();

    // check for session
    if(!isset($_SESSION['customerId']) || !isset($_SESSION['customerEmail']) || !isset($_SESSION['customerRole'])) {
        header('Location: routes.php?action=home');
        exit();
    } else {
        // check for role
        if($_SESSION['customerRole'] !== "customer") {
            header('Location: routes.php?action=home');
            exit();
        }
    }
?>
