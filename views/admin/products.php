<?php
    // require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin | Products";
    ob_start();
?>

    <!-- Start Products -->
    <div class="products py-5">
        <div class="container">
            <!-- Section Heading -->
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="margin-top: 50px; border-bottom: 1px solid #d36d0e;">Food</h2>
                <p class="text-muted">Explore All Site Food</p>
            </div>

            <!-- Error Message (Centered) -->
            <?php if (!empty($error)): ?>
                <div class="d-flex justify-content-center">
                    <div class="alert alert-danger text-center w-75" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Display Products -->
            <div class="row g-4">
                <?php if (!empty($productsList)): ?>
                    <?php foreach ($productsList as $product): ?>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm h-100 d-flex flex-column">
                                <!-- Product Image -->
                                <img src="<?= htmlspecialchars($product['product_image']) ?>" 
                                    alt="<?= htmlspecialchars($product['product_name']) ?>" 
                                    class="card-img-top" 
                                    style="height: 250px; object-fit: cover;">

                                <!-- Card Body -->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-center fw-bold text-dark">
                                        <?= htmlspecialchars($product['product_name']) ?>
                                    </h5>
                                    <p class="card-text flex-grow-1 text-center text-muted">
                                        <?= htmlspecialchars($product['product_description']) ?>
                                    </p>
                                    
                                    <!-- Price Badge (Centered) -->
                                    <div class="text-center mt-2">
                                        <span class="badge bg-primary px-3 py-2">
                                            <?= htmlspecialchars($product['product_price']) ?> MAD
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Footer (Buttons) -->
                                <div class="card-footer d-flex justify-content-center gap-2">
                                    <a href="routes.php?action=editProduct&proId=<?= htmlspecialchars($product['id']) ?>" 
                                        class="btn btn-secondary">
                                        Edit
                                    </a>
                                    <a href="routes.php?action=deleteProduct&proId=<?= htmlspecialchars($product['id']) ?>" 
                                        class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End Products -->

<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>