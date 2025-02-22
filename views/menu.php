<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    $title = "Mashawi-amar | Menu";
    $foodMenu = $foodMenu ?? [];
    ob_start();
?>

    <!-- Start Find Food Section -->
    <div class="find-food bg-dark py-5 mt-5">
        <div class="container">
            <!-- Section Heading -->
            <h1 class="text-center mb-5 fw-bold display-4 text-light">
                Find <span class="bg-warning text-dark px-3 py-1 rounded-pill">Your Dish!</span>
            </h1>

            <!-- diplay error -->
            <?php
                if(!empty($errorFood)) {
                    ?>
                        <div class="container d-flex justify-content-center align-items-center vh-50">
                            <div class="error bg-dark rounded p-4 text-center">
                                <div class="logo mb-3">
                                    <img src="views/images/mashawi-logo.png" alt="mashawi-logo" class="img-fluid" style="max-width:300px;">
                                </div>
                                <div class="error-text">
                                    <p class="text-warning fw-bold"><?= htmlspecialchars($errorFood, ENT_QUOTES, 'UTF-8') ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>

            <!-- Search Form and Image -->
            <div class="row align-items-center g-4">
                <!-- Search Form -->
                <div class="col-12 col-md-6 order-2 order-md-1">
                    <div class="find-text text-center text-md-start">
                        <form action="routes.php?action=findFood" method="POST" class="d-flex flex-column gap-3">
                            <input type="text" 
                                name="food-name" 
                                class="form-control form-control-lg rounded-pill border-0 shadow-sm" 
                                placeholder="Write Your Favourite Dish Name" >
                            <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold text-dark">
                                Search
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Image -->
                <div class="col-12 col-md-6 order-1 order-md-2">
                    <div class="find-image text-center">
                        <img src="views/images/find-food.png" 
                            alt="Find Food Illustration" 
                            class="img-fluid rounded-4 food-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Find Food Section -->


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
                            <div class="container d-flex justify-content-center align-items-center vh-50">
                                <div class="error rounded p-4 text-center">
                                    <div class="logo mb-3">
                                        <img src="views/images/mashawi-logo.png" alt="mashawi-logo" class="img-fluid" style="max-width:300px;">
                                    </div>
                                    <div class="error-text">
                                        <p class="text-danger text-bold"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                                    </div>
                                </div>
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
                                        <img src="<?= htmlspecialchars($category['category_image'])?>" alt="Salads" class="img-fluid rounded" loading="lazy">
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