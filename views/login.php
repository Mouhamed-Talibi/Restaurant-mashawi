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
                        <a href="routes.php?action=login" class="login text-white">Login</a>
                        <a href="routes.php?action=signup" class="signup text-white rounded-4 text-decoration-none px-2">Sign Up</a>
                    </div>
                </div>
            </div>
        </nav>  
    <!-- end nav -->

    <!-- Start Login Section -->
        <section class="login mt-5 py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-6">
                        <div class="card bg-dark text-light border-0 p-4">
                            <!-- Card Header -->
                            <div class="text-center mb-4">
                                <h3 class="fw-bold fs-2">Login</h3>
                            </div>
                            <!-- Login Form -->
                            <form>
                                <!-- Email Input -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                </div>
                                <!-- Password Input -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                                </div>
                                <!-- Remember Me and Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                                    </div>
                                    <a href="#" class="text-decoration-none text-warning small">Forgot Password?</a>
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn w-100 fw-bold" style="background-color: #d36d0e;">Login</button>
                            </form>
                            <!-- Signup Link -->
                            <p class="text-center mt-4 mb-0">
                                Don't have an account? <a href="routes.php?action=signup" class="text-warning fw-bold">Sign Up</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- End Login Section -->

    <!-- js bootstrap link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>