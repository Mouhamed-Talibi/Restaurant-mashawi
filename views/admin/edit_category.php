<?php
    use models\Database;

    // require adminSession & nav
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    // title & start content container
    $title = "Admin | Edit Category";
    ob_start();
?>

    <!-- Start edit Category -->
    <div class="category my-5">
        <div class="container">
            <!-- Heading Section -->
            <div class="special-heading text-center mb-5" style="margin-top: 90px;">
                <h1 class="fw-bold fs-1">
                    <?php if ($categoryData): ?>
                        Editing <?= htmlspecialchars($categoryData['category_name']) ?>
                    <?php else: ?>
                        Category Not Found
                    <?php endif; ?>
                </h1>
            </div>

            <!-- Form -->
            <form action="routes.php?action=updateCategory" method="POST" enctype="multipart/form-data">
                <div class="row bg-dark text-light g-3 p-4 w-75 mx-auto rounded-4">

                    <!-- display errors -->
                    <?php
                        if(!empty($error )) { 
                            ?>
                                <div class="alert alert-danger"role="alert">
                                    <?= $error ?>
                                </div>
                            <?php
                        }
                        if(!empty($message )) { 
                            ?>
                                <div class="alert alert-success"role="alert">
                                    <?= $message ?>
                                </div>
                            <?php
                        }
                    ?>

                    <?php if($categoryData) : ?>
                        <!-- Category Name -->
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="category_id" value="<?= htmlspecialchars($categoryData['id']) ?>">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" id="category_name" value="<?= htmlspecialchars($categoryData['category_name']) ?>" class="form-control">
                            </div>
                        </div>
                
                        <!-- Category Description -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category_description" class="form-label">Category Description</label>
                                <textarea name="category_description" id="category_description" class="form-control" rows="4"> <?= htmlspecialchars($categoryData['category_description']) ?> </textarea>
                            </div>
                        </div>
                
                        <!-- Category Image -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category_image" class="form-label">Category Image</label>
                                <input type="file" name="category_image" value="<?= htmlspecialchars($categoryData['category_image']) ?>" id="category_image" class="form-control">
                            </div>
                        </div>
                
                        <!-- Submit Button -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-warning w-50">Update Category</button>
                        </div>
                    </div>
                <?php endif; ?>
            </form>            
        </div>
    </div>
    <!-- End edit Category -->

<?php
    $content = ob_get_clean();
    // require layout
    require_once __DIR__ . "/../layout/layout.php";
?>
