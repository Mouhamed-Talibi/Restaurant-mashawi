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
                <p class="text-muted fs-6">Easily Manage and Explore Our Delicious Menu</p>
            </div>

            <!-- Error Message (Centered) -->
            <?php if (!empty($error)): ?>
                <div class="d-flex justify-content-center">
                    <div class="alert alert-danger text-center w-75" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Menu Categories -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php if (!empty($categoriesList)): ?>
                    <?php foreach ($categoriesList as $category): ?>
                        <!-- Category Card -->
                        <div class="col">
                            <div class="menu-card p-4 bg-dark shadow-sm rounded-3 h-100">
                                <div class="image mb-3 text-center">
                                    <img src="<?= htmlspecialchars($category['category_image']) ?>" 
                                        alt="<?= htmlspecialchars($category['category_name']) ?>" 
                                        class="img-fluid rounded-3" 
                                        style="width: 200px; height: 120px; object-fit: contain;">
                                </div>
                                <div class="infos text-center">
                                    <h3 class="fw-bold mb-2 text-white"><?= htmlspecialchars($category['category_name']) ?></h3>
                                    <p class="text-secondary"><?= htmlspecialchars($category['category_description']) ?></p>
                                    <div class="d-flex justify-content-center gap-2 mt-3">
                                        <a href="routes.php?action=editCategory&catId=<?= htmlspecialchars($category['id']) ?>" class="btn btn-sm btn-secondary px-2 rounded-5">Edit</a>
                                        <a href="routes.php?action=deleteCategory&catId=<?= htmlspecialchars($category['id']) ?>" class="btn btn-sm btn-danger px-2 rounded-5">Delete</a>
                                        <a href="routes.php?action=exploreFood&catId=<?= htmlspecialchars($category['id']) ?>" class="btn btn-sm btn-primary px-2 rounded-5">Explore Products</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End Menu -->

<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>