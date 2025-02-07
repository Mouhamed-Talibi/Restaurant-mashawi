<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    $title = "Mashawi-amar | About";
    ob_start();
?>

    <!-- start about -->
        <div class="about mt-5 mb-5 py-5 bg-light" id="about">
            <div class="container">
                <!-- Heading Section -->
                <div class="special-heading text-center mb-5">
                    <h1 class="fw-bold">About Us</h1>
                    <p class="text-muted">Discover our journey and passion for delicious food.</p>
                </div>
                <!-- About Content -->
                <div class="row align-items-center">
                    <!-- Image Section -->
                    <div class="col-md-6">
                        <img src="views/images/history.jpg" alt="Our Restaurant" class="img-fluid rounded shadow">
                    </div>
                    <!-- Text Section -->
                    <div class="col-md-6">
                        <div class="about-text">
                            <h2 class="story fw-bold mb-3 mt-4">Our Story</h2>
                            <p class="text-muted fs-5">
                                We started in <span class="fw-bold text-warning">2018</span> with a small restaurant in Ouled Teima, driven by a love for authentic grilled dishes and a passion for exceptional hospitality. Over the years, we've grown into a beloved destination for food lovers, offering a menu crafted with the freshest ingredients and bold flavors.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-5">
                    <!-- Text Section -->
                    <div class="col-md-6 order-md-1 order-2">
                        <div class="about-text">
                            <h2 class="story fw-bold mb-3 mt-4">Mashawi-Amar</h2>
                            <p class="text-muted fs-5">
                                Our restaurant is a place where you can <span style="color: #d36d0e;">enjoy the best grilled dishes</span> in town, prepared with love and care. We believe in using the finest ingredients and traditional recipes to create a dining experience that's truly unforgettable. Whether you're here for a quick bite or a special occasion, we promise to make your visit memorable.
                            </p>
                        </div>
                    </div>
                    <!-- Image Section -->
                    <div class="col-md-6 order-md-2 order-1 d-flex justify-content-center">
                        <img src="views/images/about.jpg" alt="Our Restaurant" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    <!-- end about -->

<?php
    $content = ob_get_clean();
    include_once "layout/layout.php";
    require_once "includes/footer.php";
?>