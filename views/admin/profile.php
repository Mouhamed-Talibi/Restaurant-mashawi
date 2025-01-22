<?php
    // require adminSession & navbar
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
            <h2 class="fw-bold" style="margin-top: 100px; border-bottom: 2px solid #d36d0e; display: inline-block;">My Profile</h2>
            <p class="text-muted">Manage and update your personal information</p>
        </div>

        <!-- User Info Cards -->
        <div class="row gy-4">
            <!-- First Name -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold mb-2">First Name</h6>
                        <p class="mb-0 fs-5">Mouhamed</p>
                    </div>
                </div>
            </div>

            <!-- Last Name -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold mb-2">Last Name</h6>
                        <p class="mb-0 fs-5">Talibi</p>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold mb-2">Email</h6>
                        <p class="mb-0 fs-5">mouhamed@gmail.com</p>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted fw-bold mb-2">Password</h6>
                        <p class="mb-0 fs-5">********</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Links for Editing -->
        <div class="d-flex justify-content-center mt-5">
            <a href="routes.php?action=ChangeAdmPsw" class="btn btn-primary btn-lg me-3">Change Password</a>
            <a href="routes.php?action=editAdmInf" class="btn btn-secondary btn-lg">Edit Information</a>
        </div>
    </div>
</div>
<!-- End Profile -->


<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>