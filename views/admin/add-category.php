<?php
    // require adminSession & nav
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    // title & start content container
    $title = "Admin | Add Category";
    ob_start();
?>

    <!-- Start Add Category -->
    <div class="category my-5">
        <div class="container">
            <!-- Section Heading -->
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="margin-top: 100px; border-bottom: 1px solid #d36d0e;">Add New Category</h2>
                <p class="text-muted">Fill out the form below to add a new category</p>
            </div>

            <!-- Form -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row bg-dark text-light g-3 p-4 w-75 mx-auto rounded-4">
                    <!-- Category Name -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" required>
                        </div>
                    </div>
            
                    <!-- Category Description -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="category_description" class="form-label">Category Description</label>
                            <textarea name="category_description" id="category_description" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
            
                    <!-- Category Image -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="category_image" class="form-label">Category Image</label>
                            <input type="file" name="category_image" id="category_image" class="form-control" required>
                        </div>
                    </div>
            
                    <!-- Submit Button -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-warning w-50">Add Category</button>
                    </div>
                </div>
            </form>            
        </div>
    </div>
    <!-- End Add Category -->

<?php
    $content = ob_get_clean();
    // require layout
    require_once __DIR__ . "/../layout/layout.php";
?>