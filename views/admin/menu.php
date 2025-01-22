<?php
    // require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin Menu";
    ob_start();
?>

    <!-- Start Menu -->
    <div class="menu mt-5 mb-5 py-5 bg-light" id="menu">
        <div class="container">
            <!-- Heading Section -->
            <div class="special-heading text-center mb-5">
                <h1 class="fw-bold">Menu Management</h1>
                <p class="text-muted fs-8">Easily Manage and Explore Our Delicious Menu</p>
            </div>

            <!-- Menu Categories -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Salads -->
                <div class="col">
                    <div class="menu-card p-4 bg-white shadow-sm rounded-3 h-100">
                        <div class="image mb-3 text-center">
                            <img src="" alt="Salads" class="img-fluid rounded-rectangle" style="width: 200px; height: 120px; object-fit: contain;">
                        </div>
                        <div class="infos text-center">
                            <h3 class="fw-bold mb-2">Salads</h3>
                            <p class="text-muted">Fresh, healthy salads made with the finest ingredients.</p>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="#" class="btn btn-sm btn-secondary px-2 rounded-2">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger px-2 rounded-2">Delete</a>
                                <a href="#" class="btn btn-sm btn-primary px-2 rounded-2">Explore Products</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Juices -->
                <div class="col">
                    <div class="menu-card p-4 bg-white shadow-sm rounded-3 h-100">
                        <div class="image mb-3 text-center">
                            <img src="" alt="Juices" class="img-fluid rounded-rectangle" style="width: 200px; height: 120px; object-fit: contain;">
                        </div>
                        <div class="infos text-center">
                            <h3 class="fw-bold mb-2">Juices</h3>
                            <p class="text-muted">Refreshing juices from fresh fruits to brighten your day.</p>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="#" class="btn btn-sm btn-secondary px-2 rounded-2">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger px-2 rounded-2">Delete</a>
                                <a href="#" class="btn btn-sm btn-primary px-2 rounded-2">Explore Products</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Burgers -->
                <div class="col">
                    <div class="menu-card p-4 bg-white shadow-sm rounded-3 h-100">
                        <div class="image mb-3 text-center">
                            <img src="" alt="Burgers" class="img-fluid rounded-rectangle" style="width: 200px; height: 120px; object-fit: contain;">
                        </div>
                        <div class="infos text-center">
                            <h3 class="fw-bold mb-2">Burgers</h3>
                            <p class="text-muted">Juicy and flavorful burgers for every craving.</p>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="#" class="btn btn-sm btn-secondary px-2 rounded-2">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger px-2 rounded-2">Delete</a>
                                <a href="#" class="btn btn-sm btn-primary px-2 rounded-2">Explore Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Menu -->


<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>