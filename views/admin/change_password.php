<?php
    // Require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin | Change Password";
    ob_start();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-secondary text-light text-center py-3">
                    <h3 class="fw-bold mb-0">Change Your Password</h3>
                </div>
                <div class="card-body">
                    <form action="routes.php?action=updateAdmPss" method="POST">

                        <!-- display error and message  -->
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
                        ?>

                        <!-- Email (Readonly) -->
                        <div class="mb-3">
                            <input type="hidden" name="id" value="<?= filter_var($adminData['id'], FILTER_VALIDATE_INT)?>">
                            <label class="form-label fw-bold">Your Email:</label>
                            <input type="email" class="form-control bg-light" 
                                value="<?= htmlspecialchars($adminData['email']) ?>" readonly>
                        </div>

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Password:</label>
                            <div class="input-group">
                                <input type="password" name="current_password" id="currentPassword" 
                                    class="form-control">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('currentPassword')">
                                    👁️
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">New Password:</label>
                            <div class="input-group">
                                <input type="password" name="new_password" id="newPassword" 
                                    class="form-control">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('newPassword')">
                                    👁️
                                </button>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Confirm New Password:</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" id="confirmPassword" 
                                    class="form-control">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirmPassword')">
                                    👁️
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning w-50 mx-auto">Update Password</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password Toggle Script -->
<script>
    function togglePassword(id) {
        let input = document.getElementById(id);
        input.type = input.type === "password" ? "text" : "password";
    }
</script>

<?php
    // Content
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>
