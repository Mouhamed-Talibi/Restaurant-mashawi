<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    $title = "Mashawi-amar | Services";
    ob_start();
?>

    <!-- Start Services Section -->
        <div class="about mt-6 mb-2 py-5 bg-dark" id="services">
            <div class="container mt-5 text-light">
                <!-- Heading Section -->
                <div class="special-heading text-center mb-5">
                    <h1 class="fw-bold">Our Services</h1>
                    <p class="text-light">We Are Here For You.</p>
                </div>
                
                <!-- Services Cards -->
                <div class="row gy-4">
                    <!-- Service 1 -->
                    <div class="col-md-4 text-center">
                        <div class="service-card p-4 rounded bg-dark border border-warning h-100 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-and-heading">
                                <i class="fa-solid fa-utensils text-warning mb-2" style="font-size: 2.5rem;"></i>
                                <h3 class="fw-bold mt-2">Delicious Dishes</h3>
                            </div>
                            <p class="mt-3">Enjoy the best-grilled meals crafted with fresh ingredients and bold flavors to tantalize your taste buds.</p>
                        </div>
                    </div>
                    <!-- Service 2 -->
                    <div class="col-md-4 text-center">
                        <div class="service-card p-4 rounded bg-dark h-100 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-and-heading">
                                <i class="fa-solid fa-truck text-warning mb-2" style="font-size: 2.5rem;"></i>
                                <h3 class="fw-bold mt-2">Fast Delivery</h3>
                            </div>
                            <p class="mt-3">Get your favorite dishes delivered right to your doorstep quickly and with care.</p>
                        </div>
                    </div>
                    <!-- Service 3 -->
                    <div class="col-md-4 text-center">
                        <div class="service-card p-4 rounded bg-dark border border-warning h-100 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-and-heading">
                                <i class="fa-solid fa-seedling text-warning mb-2" style="font-size: 2.5rem;"></i>
                                <h3 class="fw-bold mt-2">Fresh Ingredients</h3>
                            </div>
                            <p class="mt-3">We prioritize quality and ensure that every ingredient is fresh and healthy for an exceptional experience.</p>
                        </div>
                    </div>
                    <!-- Service 4 -->
                    <div class="col-md-4 text-center">
                        <div class="service-card p-4 rounded bg-dark h-100 wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-and-heading">
                                <i class="fa-solid fa-glass-cheers text-warning mb-2" style="font-size: 2.5rem;"></i>
                                <h3 class="fw-bold mt-2">Event Catering</h3>
                            </div>
                            <p class="mt-3">Make your events unforgettable with our premium catering services tailored to your needs.</p>
                        </div>
                    </div>
                    <!-- Service 5 -->
                    <div class="col-md-4 text-center">
                        <div class="service-card p-4 rounded bg-dark border border-warning h-100 wow fadeInUp" data-wow-delay="1s">
                            <div class="icon-and-heading">
                                <i class="fa-solid fa-user-friends text-warning mb-2" style="font-size: 2.5rem;"></i>
                                <h3 class="fw-bold mt-2">Friendly Staff</h3>
                            </div>
                            <p class="mt-3">Our staff is committed to providing you with a warm and welcoming experience every time you visit.</p>
                        </div>
                    </div>
                    <!-- Service 6 -->
                    <div class="col-md-4 text-center">
                        <div class="service-card p-4 rounded bg-dark h-100 wow fadeInUp" data-wow-delay="1.2s">
                            <div class="icon-and-heading">
                                <i class="fa-solid fa-coffee text-warning mb-2" style="font-size: 2.5rem;"></i>
                                <h3 class="fw-bold mt-2">Cozy Atmosphere</h3>
                            </div>
                            <p class="mt-3">Relax in a cozy and inviting environment while enjoying your favorite dishes and drinks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Services Section -->

<?php
    $content = ob_get_clean();  
    require_once "layout/layout.php";
    require_once "includes/footer.php";
?>