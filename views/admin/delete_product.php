<?php
    // Require adminSession & nav
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    // Title & start content container
    $title = "Admin | Delete Product";
    ob_start();
?>

    <!-- Start deletion section -->
    <div class="deletion my-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <!-- Section Heading -->
                <div class="text-start mb-4">
                    <h2 class="fw-bold text-dark" style="margin-top: 50px; border-bottom: 2px solid #d36d0e; padding-bottom: 10px;">
                        Confirm Deletion
                    </h2>
                    <p class="text-muted">You can confirm or cancel the deletion from here</p>
                </div>

                <!-- diplay errors -->
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

                    if($productData) :
                ?>
                    <div class="col-md-6 mt-5">
                        <!-- Product Card -->
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <!-- Product Image -->
                                <img src="<?= htmlspecialchars($productData['product_image']) ?>" alt="Product Image" class="img-fluid rounded mb-3" style="max-height: 200px; object-fit: cover;">

                                <!-- Product Name -->
                                <h3 class="card-title fw-bold mb-2"><?= htmlspecialchars($productData['product_name']) ?></h3>

                                <!-- Product Description -->
                                <p class="card-text text-secondary"><?= htmlspecialchars($productData['product_description']) ?></p>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Delete Button (Triggers Modal) -->
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                        Delete
                                    </button>

                                    <!-- Cancel Button -->
                                    <a href="routes.php?action=adminProducts" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    endif;
                ?>
            </div>
        </div>
    </div>
    <!-- End deletion section -->

    <!-- Start Confirmation Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteProductModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p>Are you sure you want to delete the Product <strong><?= htmlspecialchars($productData['product_name']) ?></strong>?</p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <!-- Cancel Button -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    <!-- Delete Button -->
                    <a href="routes.php?action=destroyProduct&proId=<?= htmlspecialchars($productData['id']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Confirmation Modal -->

<?php
    $content = ob_get_clean();
    // Require layout
    require_once __DIR__ . "/../layout/layout.php";
?>