<?php
    // require adminSession & nav
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    // title & start content container
    $title = "Admin | Add Product";
    ob_start();
?>

    <!-- Start Add product -->
    <div class="Product my-5">
        <div class="container">
            <!-- Section Heading -->
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="margin-top: 100px; border-bottom: 1px solid #d36d0e;">Add New Product</h2>
                <p class="text-muted">Fill out the form below to add a new product</p>
            </div>

            <!-- Form -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row bg-dark text-light g-3 p-4 w-75 mx-auto rounded-4">

                    <!-- Product Name -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" required>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea name="product_description" id="description" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <!-- Product Price -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="number" name="product_price" placeholder="Example: 198 or 15.65" id="price" class="form-control" required step="0.01">
                        </div>
                    </div>

                    <!-- Product Image -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="product_image" class="form-label">Product Image</label>
                            <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*" required>
                        </div>
                    </div>

                    <!-- Product Category -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="product_category" class="form-label">Product Category</label>
                            <select name="product_category" id="product_category" class="form-control" required>
                                <option value="">Select product category</option>
                                <option value="burgers">Burgers</option>
                                <option value="salads">Salads</option>
                                <option value="juices">Juices</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-warning w-50">Add Product</button>
                    </div>
                </div>
            </form>            
        </div>
    </div>
    <!-- End Add Product -->

<?php
    $content = ob_get_clean();
    // require layout
    require_once __DIR__ . "/../layout/layout.php";
?>