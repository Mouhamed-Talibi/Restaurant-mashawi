<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    // Title
    $title = "Mashawi-amar | Home";
    ob_start(); 
?>

    <!-- start customer home -->
    <div class="customer-home py-5" style="margin-top: 80px;">
        <div class="container">
            <!-- Title -->
            <?php if ($customerData): ?>

                <!-- Food Cards -->
                <div class="row g-4">
                    <!-- Card 1 -->
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Food Item 1">
                            <div class="card-body">
                                <h5 class="card-title">Grilled Chicken</h5>
                                <p class="card-text">Juicy grilled chicken served with fresh vegetables.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold">$12.99</span>
                                    <a href="#" class="btn btn-outline-dark btn-sm">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Food Item 2">
                            <div class="card-body">
                                <h5 class="card-title">Vegan Salad</h5>
                                <p class="card-text">A refreshing mix of greens and toppings for a healthy meal.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold">$9.99</span>
                                    <a href="#" class="btn btn-outline-dark btn-sm">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Food Item 3">
                            <div class="card-body">
                                <h5 class="card-title">Pasta Alfredo</h5>
                                <p class="card-text">Creamy Alfredo pasta topped with parmesan cheese.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold">$14.99</span>
                                    <a href="#" class="btn btn-outline-dark btn-sm">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- end customer home -->

<?php
    $content = ob_get_clean();
    require_once "layout/layout.php";
    require_once "includes/footer.php";
?>
