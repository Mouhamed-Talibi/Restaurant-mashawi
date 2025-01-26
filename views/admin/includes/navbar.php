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
                    <a class="nav-link text-light active" aria-current="page" href="routes.php?action=adminDashboard">dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="routes.php?action=adminMenu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="routes.php?action=adminOrders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="routes.php?action=adminMessages">Messages</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Pages
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="routes.php?action=adminProfile">My Profile</a></li>
                        <li><a class="dropdown-item" href="routes.php?action=adminProducts">Food</a></li>
                        <li><a class="dropdown-item" href="routes.php?action=addCategory">Add Category</a></li>
                        <li><a class="dropdown-item" href="routes.php?action=addProduct">Add Product</a></li>
                    </ul>
                </li>
            </ul>
            <!-- login / signup -->
            <div class="d-flex gap-3 align-items-center py-2">
                <a href="routes.php?action=logout" class="logout bg-danger text-light rounded-4 text-decoration-none px-2 py-1" onclick="return confirm('Are you sure you want to logout?')">
                    Logout
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </div>
</nav> 