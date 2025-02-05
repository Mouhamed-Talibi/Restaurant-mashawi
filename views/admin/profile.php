<?php
    // Require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin Profile";
    ob_start();
?>

<!-- Start Profile -->
<div class="profile py-5">
    <div class="container">
        <!-- Profile Card -->
        <div class="card mt-5 shadow-lg border-0 mx-auto" style="max-width: 800px; border-radius: 15px; overflow: hidden;">
            <div class="card-header bg-secondary text-white text-center py-4">
                <h2 class="fw-bold">Your Profile</h2>
                <p class="mb-0 text-light">Manage and update your personal information</p>
            </div>

            <div class="card-body p-4">
                <div class="row gy-3">
                    <!-- First Name -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <h6 class="text-muted text-uppercase">First Name</h6>
                            <p class="fw-bold mb-0">
                                <?= $adminData['first_name']?>
                            </p>
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <h6 class="text-muted text-uppercase">Last Name</h6>
                            <p class="fw-bold mb-0">
                                <?= $adminData['last_name']?>
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <h6 class="text-muted text-uppercase">Email</h6>
                            <p class="fw-bold mb-0">
                            <?= $adminData['email']?>
                            </p>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <h6 class="text-muted text-uppercase">Password</h6>
                            <p class="fw-bold mb-0">********</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-center mt-4">
                    <a href="routes.php?action=ChangeAdmPsw" class="btn btn-warning me-3" style="font-size: 14px; padding: 8px 16px;">
                        <i class="fas fa-key me-2"></i>Change Password
                    </a>
                    <a href="routes.php?action=editAdmInf&admId=<?= $_SESSION['adminId']?>" class="btn btn-outline-dark" style="font-size: 14px; padding: 8px 16px;">
                        <i class="fas fa-edit me-2"></i>Edit Info
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Profile -->

<?php
    // Content
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>
