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
    <link rel="stylesheet" href="style/main.css">
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
                            <a class="nav-link text-light active" aria-current="page" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light active" aria-current="page" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="menu.html">Menu</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pages
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="location-contact.html">Location</a></li>
                                <li><a class="dropdown-item" href="location-contact.html">Contact</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="services.html">Services</a>
                        </li>
                    </ul>
                    <!-- login / signup -->
                    <div class="d-flex gap-3 align-items-center py-2">
                        <a href="login.html" class="login text-white">Login</a>
                        <a href="signup.html" class="signup text-white rounded-4 text-decoration-none px-2">Sign Up</a>
                    </div>
                </div>
            </div>
        </nav>  
    <!-- end nav -->

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
                            <div class="map mb-3">
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
                            <form>
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
                                    <button type="submit" class="btn btn-warning w-100 fw-bold">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- end location & contact -->

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
                            <li><a href="menu.html" class="text-light text-decoration-none">Menu</a></li>
                            <li><a href="services.html" class="text-light text-decoration-none">Services</a></li>
                            <li><a href="location-contact.html" class="text-light text-decoration-none">Contact Us</a></li>
                        </ul>
                    </div>
        
                    <!-- Contact Section -->
                    <div class="col-md-4 mb-4">
                        <h5 class="heading fw-bold">Get In Touch</h5>
                        <p><i class="fas fa-map-marker-alt me-2"></i> Ouled Teima, Brothers Grill</p>
                        <p><i class="fas fa-phone-alt me-2"></i> +212 655342517</p>
                        <p><i class="fas fa-envelope me-2"></i> mashawiamar@example.com</p>
                        <div class="social-icons mt-3">
                            <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-light"><i class="fab fa-linkedin-in"></i></a>
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