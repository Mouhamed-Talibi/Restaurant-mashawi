<?php
    use controllers\CustomersController;
    $customerController = new CustomersController();

    $randomCategories = $customerController::random_Categories_Action();
    $productsList = $customerController::products_List_Action();

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
                    <h1 class="text-center mb-5 fw-bold display-6">
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
                        if (!empty($randomCategories)) {
                            $limitedProducts = array_splice($randomCategories, 0, 3); // Limit to 3 products
                            ?>
                                <div class="row g-4 mt-4">
                            <?php
                                foreach ($limitedProducts as $category) {
                                    ?>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="food-item text-center p-4 shadow-sm rounded bg-dark h-100 d-flex flex-column transition-all">
                                                <div class="food-image mb-4 overflow-hidden rounded">
                                                    <img src="<?= htmlspecialchars($category['category_image']) ?>" alt="<?= htmlspecialchars($category['category_name']) ?>" 
                                                        class="img-fluid rounded hover-zoom" style="width: 100%; height: 220px; object-fit: cover;">
                                                </div>
                                                <div class="food-text flex-grow-1">
                                                    <h3 class="h4 fw-bold mb-3 text-light"><?= htmlspecialchars($category['category_name']) ?></h3>
                                                    <p class="text-light"><?= htmlspecialchars($category['category_description']) ?></p>
                                                </div>
                                                <div class="mt-4">
                                                    <a href="routes.php?action=expFood&catId=<?= htmlspecialchars($category['id'])?>" class="btn btn-outline-warning fw-bold px-4 py-2">
                                                        Explore <?= htmlspecialchars($category['category_name']) ?>
                                                    </a>
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
                        Why <span class="bg-dark text-warning px-3 py-1 rounded-pill">Choose Us?</span>
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

            <!-- Start Food Menu -->
            <div class="food-menu bg-dark text-light py-5">
                <div class="container">
                    <!-- Section Heading -->
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bold">
                            <span class="border-bottom border-3 border-warning pb-2">Food Menu</span>
                        </h1>
                    </div>
                    <!-- Error Message (if any) -->
                    <?php if (!empty($error)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger text-center" role="alert">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Food Items Grid -->
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php if (!empty($productsList)) : ?>
                            <?php 
                                $maxProducts = array_splice($productsList, 0, 8); // Limit to 8 items
                                foreach ($maxProducts as $product) : 
                            ?>
                            <div class="col">
                                <!-- Card for Small Screens -->
                                <div class="card h-100 bg-dark text-light border-light d-block d-md-none">
                                    <img src="<?= htmlspecialchars($product['product_image']) ?>" 
                                        class="card-img-top img-fluid" 
                                        alt="<?= htmlspecialchars($product['product_name']) ?>" 
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column p-3">
                                        <h5 class="card-title fw-bold mb-2"><?= htmlspecialchars($product['product_name']) ?></h5>
                                        <p class="card-text text-secondary mt-2 mb-3">
                                            <?= htmlspecialchars($product['product_description']) ?>
                                        </p>
                                        <p class="card-text text-success fw-bold mb-3">
                                            <?= htmlspecialchars($product['product_price']) ?> MAD
                                        </p>
                                        <div class="d-flex justify-content-end mt-auto">
                                            <a href="routes.php?action=orderFood&proId=<?= htmlspecialchars($product['id']) ?>" class="btn btn-warning btn-sm text-dark fw-bold">Add To Cart</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card for Medium and Large Screens -->
                                <div class="card h-100 bg-dark text-light border-light d-none d-md-block">
                                    <div class="row g-0 h-100">
                                        <!-- Food Image -->
                                        <div class="col-md-4">
                                            <img src="<?= htmlspecialchars($product['product_image']) ?>" 
                                                class="img-fluid rounded-start h-100 w-100" 
                                                alt="<?= htmlspecialchars($product['product_name']) ?>" 
                                                style="object-fit: cover;">
                                        </div>
                                        <!-- Food Details -->
                                        <div class="col-md-8 d-flex flex-column p-3">
                                            <h5 class="card-title fw-bold mb-2"><?= htmlspecialchars($product['product_name']) ?></h5>
                                            <p class="card-text text-secondary mt-2 mb-3">
                                                <?= htmlspecialchars($product['product_description']) ?>
                                            </p>
                                            <p class="card-text text-success fw-bold mb-3">
                                                <?= htmlspecialchars($product['product_price']) ?> MAD
                                            </p>
                                            <div class="d-flex justify-content-end mt-auto">
                                                <a href="routes.php?action=orderFood&proId=<?= htmlspecialchars($product['id']) ?>" class="btn btn-warning btn-sm text-dark fw-bold">Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- Explore More Button -->
                    <div class="text-center mt-5">
                        <a href="routes.php?action=menu" class="btn btn-outline-warning fw-bold px-5 py-2">Explore More Food</a>
                    </div>
                </div>
            </div>
            <!-- End Food Menu -->

            <!-- Start Help Section -->
            <div class="help-section bg-light py-5">
                <div class="container">
                    <div class="row align-items-center g-4">
                        <!-- Help Video -->
                        <div class="col-12 col-md-6 text-center">
                            <video src="views/images/help.mp4" class="img-fluid rounded-4" autoplay loop muted style="max-width: 100%; height: auto;"></video>
                        </div>
                        <!-- Help Text -->
                        <div class="col-12 col-md-6">
                            <h1 class="fw-bold text-dark display-6 mb-4">
                                You <span class="bg-dark text-warning px-3 py-1 rounded-pill">Need Help</span>?
                            </h1>
                            <div class="mt-3">
                                <p class="fs-5 text-secondary">We're here to assist you! Reach out to us through any of the following channels:</p>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-envelope fa-lg text-danger me-3"></i>
                                            <a href="mailto:mouhamedtalibi.45@gmail.com" class="text-dark text-decoration-none fs-5">
                                                mouhamedtalibi.45@gmail.com
                                            </a>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-brands fa-linkedin-in fa-lg text-primary me-3"></i>
                                            <a href="https://www.linkedin.com/in/mohamed-talibi-639902333/" 
                                            class="text-dark text-decoration-none fs-5" target="_blank">
                                                Our LinkedIn
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <i class="fa-brands fa-square-instagram fa-lg text-danger me-3"></i>
                                            <a href="https://www.instagram.com/easy.code_/" 
                                            class="text-dark text-decoration-none fs-5" target="_blank">
                                                Our Instagram
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Help Section -->
        <?php endif; ?>
    </div>
    <!-- end customer home -->

<?php
    $content = ob_get_clean();
    require_once "layout/layout.php";
    require_once "includes/footer.php";
?>
