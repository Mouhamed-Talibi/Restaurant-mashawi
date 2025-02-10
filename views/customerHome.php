<?php
    use models\Customer;
    use models\Database;

    // title
    $title = "Mashawi-amar | Home";

    // require customer session
    require_once "includes/customerSession.php";

    // customer data
    $customerId = $_SESSION['customerId'];
    $customerEmail= $_SESSION['customerEmail'];
    $customer = new Customer;
    $stmt = $customer->db_connection()->prepare("SELECT first_name, last_name FROM customers WHERE id=? AND email=?");
    $stmt->execute([$customerId, $customerEmail]);
    $customerData = $stmt->fetch(PDO::FETCH_ASSOC);

    // require nav
    require_once "includes/nav.php";

    // store content
    ob_start();
?>

<!-- start customer home -->
    <div class="customer-home py-5" style="margin-top: 80px;">
        <div class="container">
            <!-- Title -->
            <h2 class="customer-welcome text-center mb-4">
                Welcome
                <?php
                    echo $customerData['first_name'] . " " . $customerData['last_name'];
                ?>
            </h2>
            <p class="text-center text-muted mb-5">Explore our delicious specials and find your next favorite dish!</p>

            <!-- Quick Presentation -->
            <div class="row bg-dark text-light px-3 py-5 mb-5">
                <div class="col-md-6 d-flex align-items-center">
                    <img src="views/images/relax.jpg" alt="Relaxing Ambience" class="img-fluid rounded-3 shadow-lg">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center px-4">
                    <h3 class="fw-bold text-uppercase mt-3">We Prioritize Your Comfort</h3>
                    <p class="text-secondary">
                        At <span class="text-warning">Mashawi-Amar</span>, we believe dining is more than just eating—it's an experience. Our cozy and inviting atmosphere is designed to help you relax and enjoy every bite. Whether you're here for a family dinner or a quiet evening, your comfort is our top priority.
                    </p>
                </div>
            </div>

            <!-- Food Cards -->
            <div class="row g-4 mt-5">
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
        </div>
    </div>
<!-- end customer home -->

<?php
    $content = ob_get_clean();
    // include layout
    require_once "layout/layout.php";
    // require footer :
    require_once "includes/footer.php";
?>