<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    $title = "Mashawi-amar | Menu";
    ob_start();
?>

    <!-- start menu -->
        <div class="menu mt-5 mb-5 py-5 bg-light" id="menu">
            <div class="container">
                <!-- Heading Section -->
                <div class="special-heading text-center mb-5">
                    <h1 class="fw-bold">Menu</h1>
                    <p class="text-muted fs-5">Feel Free To Explore Our Delicious Menu</p>
                </div>

                <?php 
                    if(!empty($error)) {
                        ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?= $error ?>
                            </div>
                        <?php
                    }
                    if($foodMenu) :
                ?>
                    <!-- Menu Categories -->
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                        <!-- food -->
                        <?php
                            foreach($foodMenu as $category) {
                        ?>
                            <div class="col">
                                <div class="menu-card p-4 bg-white shadow rounded h-100">
                                    <div class="image mb-3">
                                        <img src="<?= htmlspecialchars($category['category_image'])?>" alt="Salads" class="img-fluid rounded">
                                    </div>
                                    <div class="infos">
                                        <h3 class="fw-bold"><?= htmlspecialchars($category['category_name'])?></h3>
                                        <p class="text-muted"><?= htmlspecialchars($category['category_description'])?></p>
                                        <a href="routes.php?action=expFood&catId=<?= filter_var($category['id'], FILTER_SANITIZE_NUMBER_INT)?>" class="btn btn-warning rounded-3">Explore <?= htmlspecialchars($category['category_name'])?></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                <?php 
                    endif;
                ?>
            </div>
        </div>
    <!-- end menu -->

<?php
    $content = ob_get_clean();
    include_once "layout/layout.php";
    require_once "includes/footer.php";
?>