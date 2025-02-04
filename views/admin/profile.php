<?php
    // Require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin Profile";
    ob_start();
?>

<!-- Start Profile -->
<div class="profile my-5">
    <div class="container">
        <!-- Section Heading -->
        <div class="text-center mb-5">
            <h2 class="fw-bold display-4" style="margin-top: 100px; border-bottom: 2px solid #d36d0e;">My Profile</h2>
            <p class="text-muted mt-3">Manage and update your personal information</p>
        </div>

        <!-- User Info Cards -->
        <div class="row gy-4">
            <!-- First Name -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-dark fw-bold mb-3">First Name</h6>
                        <p class="mb-0 fs-5 text-dark">Mouhamed</p>
                    </div>
                </div>
            </div>

            <!-- Last Name -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-dark fw-bold mb-3">Last Name</h6>
                        <p class="mb-0 fs-5 text-dark">Talibi</p>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-dark fw-bold mb-3">Email</h6>
                        <p class="mb-0 fs-5 text-dark">mouhamed@gmail.com</p>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase text-dark fw-bold mb-3">Password</h6>
                        <p class="mb-0 fs-5 text-dark">********</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Links for Editing -->
        <div class="d-flex justify-content-center mt-5 gap-3">
            <a href="routes.php?action=ChangeAdmPsw" class="btn btn-primary btn-lg px-4 py-2">
                <i class="fas fa-key me-2"></i>Change Password
            </a>
            <a href="routes.php?action=editAdmInf" class="btn btn-outline-secondary btn-lg px-4 py-2">
                <i class="fas fa-edit me-2"></i>Edit Information
            </a>
        </div>
    </div>
</div>
<!-- End Profile -->

<?php
    // Content
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>