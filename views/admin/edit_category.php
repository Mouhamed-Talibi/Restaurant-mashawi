<?php
    use models\Database;

    // require adminSession & nav
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    // title & start content container
    $title = "Admin | Edit Category";
    ob_start();
?>

    <!-- Start Edit Category -->
    <div class="edit-category py-5">
        <div class="container">
            <!-- Heading Section -->
            <div class="special-heading text-center mb-5 mt-5">
                <h1 class="fw-bold fs-1">
                    <?php if ($categoryData): ?>
                        Editing <?= htmlspecialchars($categoryData['category_name']) ?>
                    <?php else: ?>
                        Category Not Found
                    <?php endif; ?>
                </h1>
            </div>

            <?php if ($categoryData): ?>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <!-- Display Error -->
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <!-- Edit Category Form -->
                        <form class="p-4 border rounded shadow-sm bg-dark">
                            <!-- Category Name -->
                            <div class="mb-3">
                                <label for="categoryName" class="form-label text-light fw-bold">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="category_name" 
                                    value="<?= htmlspecialchars($categoryData['category_name']) ?>">
                            </div>

                            <!-- Category Description -->
                            <div class="mb-3">
                                <label for="categoryDescription" class="form-label text-light fw-bold">Category Description</label>
                                <textarea class="form-control" id="categoryDescription" name="category_description" rows="4" >
                                    <?= htmlspecialchars($categoryData['category_description']) ?>
                                </textarea>
                            </div>

                            <!-- Category Image -->
                            <div class="mb-3">
                                <label for="categoryImage" class="form-label text-light fw-bold">Category Image</label>
                                <div class="mb-3">
                                    <img src="<?= htmlspecialchars($categoryData['category_image']) ?>" 
                                        alt="Category Image" class="img-fluid rounded w-50 h-50 d-block mx-auto">
                                </div>
                                <input type="file" class="form-control" id="categoryImage" name="category_image">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning w-50 d-block mx-auto">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger text-center">
                    The category you are trying to edit does not exist.
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- End Edit Category -->

<?php
    $content = ob_get_clean();
    // require layout
    require_once __DIR__ . "/../layout/layout.php";
?>
