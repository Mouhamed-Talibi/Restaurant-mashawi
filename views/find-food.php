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
                    if($food) :
                ?>
                    <!-- Menu Categories -->
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                        <!-- food -->
                        <?php
                            foreach($food as $product) {
                        ?>
                            <div class="col">
                                <div class="menu-card p-4 bg-white shadow rounded h-100">
                                    <div class="image mb-3">
                                        <img src="<?= htmlspecialchars($product['product_image'])?>" alt="<?= htmlspecialchars($product['product_name'])?>" class="img-fluid rounded">
                                    </div>
                                    <div class="infos">
                                        <h3 class="fw-bold"><?= htmlspecialchars($product['product_name'])?></h3>
                                        <p class="text-muted"><?= htmlspecialchars($product['product_description'])?></p>
                                        <a href="routes.php?action=orderFood&proId=<?= filter_var($product['id'], FILTER_SANITIZE_NUMBER_INT)?>" class="btn btn-warning rounded-3">Order <?= htmlspecialchars($product['product_name'])?></a>
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