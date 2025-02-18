<?php
    require_once "includes/customerSession.php";
    $title = "404 | Page Not Found";

    ob_start();
?>

<!-- start error page -->
    <div class="d-flex vh-100 align-items-center justify-content-center bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Error Number -->
                    <div class="display-1 fw-bold text-warning">
                        404
                    </div>
                    <!-- Error Message -->
                    <div class="mt-3">
                        <h1 class="h3 text-dark mb-3">Page Not Found</h1>
                        <p class="text-secondary mb-4">Sorry, we cannot find the page you're looking for.</p>
                        <a href="routes.php?action=customerHome" class="btn btn-warning">Go Back Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end error page -->

<?php
    $content = ob_get_clean();
    require_once "layout/layout.php";
?>