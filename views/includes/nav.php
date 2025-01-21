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
                    <a class="nav-link text-light active" aria-current="page" href="routes.php?action=about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="routes.php?action=menu">Menu</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Pages
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="routes.php?action=location">Location</a></li>
                        <li><a class="dropdown-item" href="routes.php?action=contact">Contact</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="routes.php?action=services">Services</a>
                </li>
            </ul>
            <!-- login / signup -->
            <div class="d-flex gap-3 align-items-center py-2">
                <a href="" class="cart text-white">
                    My Cart
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
                <a href="" class="logout text-white bg-danger rounded-4 text-decoration-none px-2 py-1">
                    Logout
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </div>
</nav>