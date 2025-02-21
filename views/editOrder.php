<?php
    // require adminSession & nav
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    // title & start content container
    $title = "Mashawi-Amar | Edit Order";
    ob_start();
?>

    <!-- Start Order editing -->
    <div class="Product my-5">
        <div class="container">
            <!-- Section Heading -->
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="margin-top: 100px; border-bottom: 2px solid #d36d0e;">Edit Order</h2>
                <p class="text-muted">Fill out the form below to edit your order</p>
            </div>

            <!-- Form -->
            <form action="routes.php?action=updateOrder" method="POST" enctype="multipart/form-data">
                <div class="row bg-dark text-light g-3 p-4 w-75 mx-auto rounded-4">
                    <!-- diplay errors & messages -->
                    <?php
                        if(!empty($error)) {
                            ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?= $error; ?>
                                </div>
                            <?php
                        }
                    ?>
                    <?php
                        if(!empty($message)) {
                            ?>
                                <div class="alert alert-success text-center" role="alert">
                                    <?= $message; ?>
                                </div>
                            <?php
                        }
                    ?>

                    <!-- Customer Name -->
                    <div class="col-12">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" value="<?= htmlspecialchars($orderDetails['full_name'])?>">
                        <input type="hidden" name="id" id="" class="form-control" value="<?= htmlspecialchars($orderDetails['id'])?>">
                        <input type="hidden" name="productId" id="" class="form-control" value="<?= htmlspecialchars($orderDetails['product_id'])?>">
                    </div>

                    <!-- Phone Number -->
                    <div class="col-12">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($orderDetails['phone'])?>">
                    </div>

                    <!-- Location -->
                    <div class="col-12">
                        <label for="location" class="form-label">Delivery Address</label>
                        <input type="text" name="location" id="location" class="form-control" value="<?= htmlspecialchars($orderDetails['delivery_address'])?>">
                    </div>

                    <!-- Date -->
                    <div class="col-md-6">
                        <label for="date" class="form-label">Delivery Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="<?= htmlspecialchars($orderDetails['delivery_date'])?>">
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-6">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="<?= htmlspecialchars($orderDetails['quantity'])?>" min="1">
                    </div>

                    <!-- Confirm & Cancel Buttons -->
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-warning fw-bold">Update Order</button>
                        <a href="routes.php?action=myOrders" class="btn btn-outline-secondary text-light">Cancel</a>
                    </div>
                </div>
            </form>            
        </div>
    </div>
    <!-- End Order editing -->


<?php
    $content = ob_get_clean();  
    require_once "layout/layout.php";
    require_once "includes/footer.php";
?>