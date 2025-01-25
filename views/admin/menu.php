<?php
    // require adminSession & navbar
    use models\Database;
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin Menu";
    ob_start();

    // select food categories from db
    $db = new Database();
    $categoriesQuery = $db->connect()->prepare("SELECT * FROM categories");
    $categoriesQuery->execute();
    $categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);
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

                <!-- category -->
                <?php
                    foreach ($categories as $category) {
                        ?>
                            <!-- category card  -->
                            <div class="col">
                                <div class="menu-card p-4 bg-dark shadow-sm rounded-3 h-100">
                                    <div class="image mb-3 text-center">
                                        <img src="<?= $category['category_image'] ?>" alt="" class="img-fluid rounded-rectangle" style="width: 200px; height: 120px; object-fit: contain;">
                                    </div>
                                    <div class="infos text-center">
                                        <h3 class="fw-bold mb-2 text-white"> <?= $category['category_name']?> </h3>
                                        <p class="text-secondary"> <?= $category['category_description'] ?> </p>
                                        <div class="d-flex justify-content-center gap-2 mt-3">
                                            <a href="#" class="btn btn-sm btn-secondary px-2 rounded-2">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger px-2 rounded-2">Delete</a>
                                            <a href="#" class="btn btn-sm btn-primary px-2 rounded-2">Explore Products</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>

            </div>
        </div>
    </div>
    <!-- End Menu -->


<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>