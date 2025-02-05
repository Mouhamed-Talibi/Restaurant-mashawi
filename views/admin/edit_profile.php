<?php
    // Require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin | Edit Profile";
    ob_start();
?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5 bg-light text-dark">
                    <div class="card-header bg-secondary text-light text-center">
                        <h3 class="fw-bold">Edit Profile</h3>
                    </div>
                    <div class="card-body">
                        <form action="routes.php?action=updateAdmPro" method="POST" enctype="multipart/form-data">

                        <?php
                            if(!empty($error)) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $error ?>
                                    </div>
                                <?php
                            }
                            if(!empty($message)) {
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= $message ?>
                                    </div>
                                <?php
                            }
                            if($adminData) :
                        ?>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($adminData['id']) ?>">

                            <!-- First Name -->
                            <div class="mb-3">
                                <label class="form-label"><strong>First Name</strong></label>
                                <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($adminData['first_name']) ?>">
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Last Name</strong></label>
                                <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($adminData['last_name']) ?>">
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Email</strong></label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($adminData['email']) ?>">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning w-50 mx-auto">Save Changes</button>
                            </div>
                        <?php
                            endif;
                        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    // Content
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>
