<?php
    session_start();
    session_regenerate_id();

    // check for session
    if(!isset($_SESSION['adminId']) || !isset($_SESSION['adminEmail']) || !isset($_SESSION['adminRole'])) {
        header('Location: routes.php?action=adminDashboard');
        exit();
    } else {
        // check for role
        if($_SESSION['adminRole'] !== "admin") {
            header('Location: routes.php?action=home');
            exit();
        }
    }
?>
