<?php
    use models\Customer;
    $customer = new Customer();
    $categoriesList = $customer->categoriesList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Mashawi-Amar
    </title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- font awessom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- style link -->
    <link rel="stylesheet" href="views/style/main.css">
</head>

<body>
    <!-- start nav -->
        <nav class="navbar navbar-expand-lg bg-dark fixed-top">
            <div class="container">
                <div class="navbar-brand">
                    <i class="fa-solid fa-utensils" style="color: #d36d0e; font-size: 25px;"></i>
                    <b class="text-white fs-4">Mashawi-Amar</b>
                </div>
                <button class="navbar-toggler fs-8" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link text-light active" aria-current="page" href="routes.php?action=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light active" aria-current="page" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#menu">Menu</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pages
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#location-contact">Location</a></li>
                                <li><a class="dropdown-item" href="#location-contact">Contact</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#services">Services</a>
                        </li>
                    </ul>
                    <!-- login / signup -->
                    <div class="d-flex gap-3 align-items-center py-2">
                        <a href="routes.php?action=login" class="login text-white">Login</a>
                        <a href="routes.php?action=signup" class="signup text-white rounded-4 text-decoration-none px-2">Sign Up</a>
                    </div>
                </div>
            </div>
        </nav>  
    <!-- end nav -->

    <!-- start landing -->
    <div class="landing mb-5 bg-dark text-white d-flex align-items-center justify-content-center text-center" style="height: 100vh;">
        <div class="container">
            <div class="landing-text p-4 rounded shadow-lg">
                <h1 class="mb-3">
                    <i class="fa-solid fa-utensils" style="color: #d36d0e; font-size: 40px;"></i>
                    <b class="fs-3 mt-2" style="border-bottom: 3px solid #d36d0e;">Mashawi-Amar</b>
                </h1>
                <!-- Max-width applied via CSS for better control -->
                <p class="fs-5 mb-4 mx-auto">
                    Experience the best grilled dishes in town with exceptional flavors and unmatched hospitality.
                </p>
                <a href="#menu" class="btn btn-warning px-4 py-2 rounded-pill">Explore Our Menu</a>
            </div>
        </div>
    </div>
    <!-- end landing -->

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
                            <button type="button" class="btn btn-warning rounded-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Read More
                            </button>
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
                            <button type="button" class="btn btn-warning rounded-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Read More
                            </button>
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

    <!-- Start Services Section -->
        <div class="about mt-5 mb-5 py-5 bg-dark" id="services">
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

    <!-- start menu -->
        <div class="menu mb-5 py-5 bg-light" id="menu">
            <div class="container">
                <!-- Heading Section -->
                <div class="special-heading text-center mb-5">
                    <h1 class="fw-bold">Menu</h1>
                    <p class="text-muted fs-5">Feel Free To Explore Our Delicious Menu</p>
                </div>
        
                <!-- Menu Categories -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                    <?php if (empty($categoriesList)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger text-center w-100" role="alert">
                                Menu will be available soon. Thank you for your understanding.
                            </div>
                        </div>
                    <?php else : 
                        $limitedCategories = array_slice($categoriesList, 0, 6);
                        foreach ($limitedCategories as $category) :
                    ?>
                            <div class="col">
                                <div class="menu-card p-4 bg-white shadow rounded h-100">
                                    <div class="image mb-3 text-center">
                                        <img src="<?= $category['category_image'] ?>" alt="<?= $category['category_name'] ?>" class="img-fluid rounded" style="width: 200px; height: 120px; object-fit: cover;">
                                    </div>
                                    <div class="infos text-center">
                                        <h3 class="fw-bold"><?= $category['category_name'] ?></h3>
                                        <p class="text-muted"><?= $category['category_description'] ?></p>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Explore <span class="text-muted fw-bold"><?= $category['category_name'] ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    <!-- end menu -->

    <!-- start location & contact -->   
        <section class="location-contact mt-5 py-5 bg-white text-dark" id="location-contact">
            <div class="container">
                <!-- Section Heading -->
                <div class="special-heading text-center mb-5">
                    <h1 class="fw-bold text-dark">Find Us & Contact</h1>
                    <p class="text-dark">Visit us or get in touch anytime</p>
                </div>

                <div class="row">
                    <!-- Location Section -->
                    <div class="col-lg-6 mb-4">
                        <div class="location bg-dark text-light shadow rounded p-4">
                            <h2 class="location fw-bold mb-3 text-center">Our Location</h2>
                            <div class="map mb-2">
                                <!-- Embedded Google Map -->
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d338.1900739!2d-9.2170188!3d30.3903563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3d70a741536ef%3A0xa29b2c9944f7f8da!2sBrothers%20Grill!5e0!3m2!1sen!2sus!4v1697738456945!5m2!1sen!2sus"
                                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                            <div class="text-center">
                                <p><i class="fas fa-map-marker-alt me-2"></i> Morocco, Ouled Teima, Brothers Grill</p>
                                <p><i class="fas fa-clock me-2"></i> Open Daily: 9:00 AM - 00:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="col-lg-6">
                        <div class="contact bg-dark text-light shadow rounded p-4">
                            <h2 class="fw-bold mb-3 text-center">Get in Touch</h2>
                                <!-- Name Input -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your full name">
                                </div>
                                <!-- Email Input -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                                </div>
                                <!-- Message Input -->
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="5"
                                        placeholder="Write your message here"></textarea>
                                </div>
                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-warning w-50" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Send Message
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- end location & contact -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Feature Not Accessible</strong></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <p>Please <strong style="color: #d36d0e;">Login</strong> Or <strong style="color: #d36d0e;">Create Account</strong> To Access This Feature.</p>
                </div>
                <div class="modal-footer">
                    <a href="routes.php?action=login" class="btn btn-warning">Login</a>
                    <a href="routes.php?action=signup" class="btn btn-dark text-light">Create Account</a>
                </div>
            </div>
            </div>
        </div>
    <!-- end modal -->

    <!-- start footer -->   
        <footer class="footer mt-5 bg-dark text-light py-5">
            <div class="container">
                <div class="row">
                    <!-- About Section -->
                    <div class="col-md-4 mb-4">
                        <h5 class="heading fw-bold">About Us</h5>
                        <p>
                            We take pride in delivering exceptional services and providing the best dining experience. Thank you for being a part of our journey!
                        </p>
                    </div>
        
                    <!-- Quick Links Section -->
                    <div class="col-md-4 mb-4">
                        <h5 class="heading fw-bold">Quick Links</h5>
                        <ul class="links list-unstyled">
                            <li><a href="#home" class="text-light text-decoration-none">Home</a></li>
                            <li><a href="#menu" class="text-light text-decoration-none">Menu</a></li>
                            <li><a href="#services" class="text-light text-decoration-none">Services</a></li>
                            <li><a href="#location-contact" class="text-light text-decoration-none">Contact Us</a></li>
                        </ul>
                    </div>
        
                    <!-- Contact Section -->
                    <div class="col-md-4 mb-4">
                        <h5 class="heading fw-bold">Get In Touch</h5>
                        <p><i class="fas fa-map-marker-alt me-2"></i> Ouled Teima, Brothers Grill</p>
                        <p><i class="fas fa-phone-alt me-2"></i> +212 655342517</p>
                        <p><i class="fas fa-envelope me-2"></i> mashawiamar@example.com</p>
                        <div class="social-icons mt-3">
                            <a href="" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/easy.code_/" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/in/mohamed-talibi-639902333/" class="text-light"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
        
                <hr class="text-light-50">
                <!-- Footer Bottom -->
                <div class="text-center">
                    <p class="mb-0">© 2025 <span>Mashawi-Amar</span>. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
    <!-- end footer -->

    <!-- js bootstrap link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>