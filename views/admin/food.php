<?php
    use models\Database;

    // require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin | Food";
    ob_start();
?>

<!-- Start products -->
<div class="products py-5">
    <div class="container">
        <!-- Section Heading -->
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="margin-top: 50px; border-bottom: 1px solid #d36d0e;">Food</h2>
            <p class="text-muted">Explore All Site Food</p>
        </div>

        <!-- diplay erros if any -->
        <?php
            if(!empty($error)) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php
            }
        ?>

        <!-- Check for any products -->
        <?php if (!empty($products)) { ?>
            <div class="row g-4">
                <!-- Display products -->
                <?php foreach ($products as $product) { ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 d-flex flex-column">
                            <img src="<?= htmlspecialchars($product['product_image']) ?>" alt="Product Image" class="card-img-top" style="height:250px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center"><?= htmlspecialchars($product['product_name']) ?></h5>
                                <p class="card-text flex-grow-1 text-center text-muted"><?= htmlspecialchars($product['product_description']) ?></p>
                                <span class="badge bg-primary w-25 fs-9 text-start"><?= htmlspecialchars($product['product_price']) ?> MAD</span>
                            </div>
                            <div class="card-footer d-flex justify-content-center gap-2">
                                <a href="#" class="btn btn-secondary">Edit</a>
                                <a href="#" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning text-center">
                No food products available for this category.
            </div>
        <?php } ?>
    </div>
</div>
<!-- End products -->

<?php
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>
