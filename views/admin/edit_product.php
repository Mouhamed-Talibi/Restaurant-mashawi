<?php
    // require adminSession & nav
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    // title & start content container
    $title = "Admin | Edit Product";
    ob_start();
?>

    <!-- Start Add product -->
    <div class="Product my-5">
        <div class="container">
            <!-- Section Heading -->
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="margin-top: 100px; border-bottom: 1px solid #d36d0e;">Edit Product</h2>
                <p class="text-muted">Fill out the form below to Edit a product</p>
            </div>

            <!-- check for produtData -->
            <?php 
                if($productData) :
            ?>

                <!-- Form -->
                <form action="routes.php?action=updateProduct" method="POST" enctype="multipart/form-data">
                    <div class="row bg-dark text-light g-3 p-4 w-75 mx-auto rounded-4">
                        <!-- display errors -->
                        <?php
                            if(!empty($error)) {
                                ?>
                                    <div class="alert alert-danger text-center" role="alert">
                                        <?php 
                                            echo $error;
                                        ?>
                                    </div>
                                <?php
                            }
                            if(!empty($message)) {
                                ?>
                                    <div class="alert alert-success text-center" role="alert">
                                        <?= $message ?>
                                    </div>
                                <?php
                            }
                        ?>
                        <!-- Product Name -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($productData['id']) ?>" id="" class="form-control">
                                <input type="text" name="product_name" value="<?= htmlspecialchars($productData['product_name']) ?>" id="product_name" class="form-control">
                            </div>
                        </div>

                        <!-- Product Description -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description" class="form-label">Product Description</label>
                                <textarea name="product_description" id="description" class="form-control" rows="4">
                                    <?= htmlspecialchars($productData['product_description']) ?>
                                </textarea>
                            </div>
                        </div>

                        <!-- Product Price -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="price" class="form-label">Product Price</label>
                                <input type="number" name="product_price" value="<?= htmlspecialchars($productData['product_price']) ?>" placeholder="Example: 198 or 15.65" id="price" class="form-control" step="0.01">
                            </div>
                        </div>

                        <!-- Product Image -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="product_image" class="form-label">Product Image</label>
                                <input type="file" name="product_image" value="<?= htmlspecialchars($productData['product_image']) ?>" id="product_image" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <!-- Product Category -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category_id" class="form-label">Product Category</label>
                                <select name="category_id" id="product_category" class="form-control">
                                    <option value="">Select product category</option>

                                    <!-- Display categories -->
                                    <?php
                                        $currentCategoryId = $productData['category_id'];

                                        foreach ($categoriesList as $category) {
                                            // Check if this category is the current category of the product
                                            $selected = ($category['id'] == $currentCategoryId) ? 'selected' : '';
                                            ?>
                                                <option value="<?= htmlspecialchars($category['id']) ?>" <?= $selected ?>>
                                                    <?= htmlspecialchars($category['category_name']) ?>
                                                </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-warning w-50">Update <?= $productData['product_name']?></button>
                        </div>
                    </div>
                </form> 

            <?php 
                endif; 
            ?>
        </div>
    </div>
    <!-- End Add Product -->

<?php
    $content = ob_get_clean();
    // require layout
    require_once __DIR__ . "/../layout/layout.php";
?>