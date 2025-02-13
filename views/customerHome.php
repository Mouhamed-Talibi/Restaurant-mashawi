<?php
    use controllers\CustomersController;
    $customerController = new CustomersController();
    $randomProducts = $customerController::random_Products_Action();

    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    // Title
    $title = "Mashawi-amar | Home";
    ob_start(); 
?>

    <!-- start customer home -->
    <div class="customer-home py-5">
        <!-- Title -->
        <?php if ($customerData): ?>

            <!-- Start Most Delicious Food Section -->
            <section class="delicious-food py-5 bg-dark text-light mb-5">
                <div class="container d-flex flex-column">
                    <h1 class="text-center mb-5 fw-bold display-5">
                        <span class="border-bottom border-3 border-warning pb-2">Our Most Delicious Food</span>
                    </h1>

                    <!-- display error & food -->
                    <?php
                        if (!empty($error)) {
                            ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?= $error ?>
                                </div>
                            <?php
                        }
                        if (!empty($randomProducts)) {
                            $limitedProducts = array_splice($randomProducts, 0, 3); // Limit to 3 products
                            ?>
                                <div class="row g-4 mt-4">
                            <?php
                                foreach ($limitedProducts as $product) {
                                    ?>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="food-item text-center p-4 shadow-sm rounded bg-dark h-100 d-flex flex-column transition-all">
                                                <div class="food-image mb-4 overflow-hidden rounded">
                                                    <img src="<?= htmlspecialchars($product['product_image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" 
                                                        class="img-fluid rounded hover-zoom" style="width: 100%; height: 220px; object-fit: cover;">
                                                </div>
                                                <div class="food-text flex-grow-1">
                                                    <h3 class="h4 fw-bold mb-3 text-light"><?= htmlspecialchars($product['product_name']) ?></h3>
                                                    <p class="text-light"><?= htmlspecialchars($product['product_description']) ?></p>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-outline-warning fw-bold px-4 py-2">Order Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </section>
            <!-- End Most Delicious Food Section -->

            <!-- Start Why Choose Us Section -->
            <div class="choose-us py-5 bg-light">
                <div class="container">
                    <h1 class="text-center mb-5 fw-bold">
                        Why <span class="bg-dark text-warning px-3 py-1 rounded-3">Choose Us?</span>
                    </h1>
                    <div class="row g-4">
                        <!-- Quality Ingredients -->
                        <div class="col-md-4 col-sm-6">
                            <div class="cause text-center p-4 shadow-sm rounded bg-white h-100 d-flex flex-column">
                                <div class="image-cause mb-3">
                                    <img src="views/images/Quality-Ingredients.png" alt="Quality Ingredients" 
                                        class="img-fluid rounded" style="max-width: 180px; height: auto;">
                                </div>
                                <div class="text-cause flex-grow-1">
                                    <h3 class="h5 fw-bold">Quality <span class="border-bottom border-warning">Ingredients</span></h3>
                                    <p class="text-muted">We use only the freshest ingredients to ensure the best taste and nutrition.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Fast Delivery -->
                        <div class="col-md-4 col-sm-6">
                            <div class="cause text-center p-4 shadow-sm rounded bg-white h-100 d-flex flex-column">
                                <div class="image-cause mb-3">
                                    <img src="views/images/fast-delivery.png" alt="Fast Delivery" 
                                        class="img-fluid rounded" style="max-width: 180px; height: auto;">
                                </div>
                                <div class="text-cause flex-grow-1">
                                    <h3 class="h5 fw-bold">Fast <span class="border-bottom border-warning">Delivery</span></h3>
                                    <p class="text-muted">Enjoy your favorite meals delivered to your door quickly and efficiently.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Excellent Service -->
                        <div class="col-md-4 col-sm-12">
                            <div class="cause text-center p-4 shadow-sm rounded bg-white h-100 d-flex flex-column">
                                <div class="image-cause mb-3">
                                    <img src="views/images/exelent-service.png" alt="Excellent Service" 
                                        class="img-fluid rounded" style="max-width: 180px; height: auto;">
                                </div>
                                <div class="text-cause flex-grow-1">
                                    <h3 class="h5 fw-bold">Excellent <span class="border-bottom border-warning">Service</span></h3>
                                    <p class="text-muted">Our team is dedicated to providing you with the best customer experience.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Why Choose Us Section -->
        <?php endif; ?>
    </div>
    <!-- end customer home -->

<?php
    $content = ob_get_clean();
    require_once "layout/layout.php";
    require_once "includes/footer.php";
?>
