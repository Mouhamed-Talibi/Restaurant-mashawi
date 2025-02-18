<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    $title = "Mashawi-amar | Food";
    ob_start();
?>

    <!-- Start Food -->
        <section class="food mt-5 py-5 bg-light">
            <div class="container">
                <div class="food-head text-center mb-4">
                    <h2 class="fw-bold" style="border-bottom: 2px solid #d36d0e;">Our Delicious Food</h2>
                    <p class="text-muted">Discover a variety of flavorful dishes made just for you.</p>
                </div>

                <?php
                    if(!empty($error)) {
                        ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?= $error ?>
                            </div>
                        <?php
                    }
                    if($productsList) :
                ?>
                    <div class="row g-4">
                        <!-- Food Card -->
                        <?php
                            foreach($productsList as $product) {
                        ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-img-top" style="background-image: url('<?= htmlspecialchars($product['product_image'])?>'); height: 200px; background-size: cover; background-position: center;"></div>
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title fw-bold"><?= htmlspecialchars($product['product_name'])?></h5>
                                            <p class="card-text text-muted mb-4"><?= htmlspecialchars($product['product_description'])?></p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-success fw-bold"><?= htmlspecialchars($product['product_price'])?> Mad</span>
                                            <a href="routes.php?action=orderFood&proId=<?= htmlspecialchars($product['id'])?>" class="text-decoration-none text-dark bg-warning p-2 rounded-2">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                                Add to Cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                <?php
                    endif;
                ?>
            </div>
        </section>
    <!-- End Food -->

<?php
    $content = ob_get_clean();
    require_once "layout/layout.php";
    require_once "includes/footer.php";
?>