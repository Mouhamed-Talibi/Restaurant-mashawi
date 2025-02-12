<?php
    if (session_status() === PHP_SESSION_NONE) {
        // Secure session cookies
        session_set_cookie_params([
            'lifetime' => 0, 
            'path' => '/',
            'domain' => '',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        // start session
        session_start();
    }

    // Prevent session fixation attacks
    session_regenerate_id(true);

    // Validate session data
    if (
        empty($_SESSION['customerId']) || 
        empty($_SESSION['customerEmail']) || 
        empty($_SESSION['customerRole']) ||
        $_SESSION['customerRole'] !== "customer"
    ) {
        // Destroy session for security before redirecting
        session_unset();
        session_destroy();
        header('Location: routes.php?action=home');
        exit;
    }
?>
