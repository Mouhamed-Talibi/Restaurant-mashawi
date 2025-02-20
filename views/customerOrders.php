<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    $title = "Mashawi-amar | Food";
    ob_start();
?>

    <!-- Start Orders -->
    <div class="container my-5 py-2">
        <div class="customer-orders mt-5 py-3">
            <!-- Heading -->
            <div class="text-center mb-4">
                <h1 class="fw-bold">My <span class="bg-dark text-warning rounded-pill p-3">Orders</span></h1>
            </div>

            <!-- if cutomer orders not empty -->
            <?php
                if(!empty($custmerOrders)) {
            ?>
                <div class="orders">
                    <div class="row justify-content-center">
                        <!-- Large Screens - Table View -->
                        <div class="col-lg-10 d-none d-lg-block mt-4">
                            <div class="table-responsive shadow-sm rounded">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Grilled Chicken</td>
                                            <td>2</td>
                                            <td>$20.00</td>
                                            <td>2024-02-20</td>
                                            <td><span class="badge bg-success">Confirmed</span></td>
                                            <td>
                                                <a href="" class="btn btn-outline-success">Edit</a>
                                                <a href="" class="btn btn-outline-secondary">Cancel</a>
                                                <a href="" class="btn btn-warning">Pay Ticket</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Medium & Small Screens - Card View -->
                        <div class="col-lg-8 d-lg-none mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border border-bottom border-1 shadow-sm-dark mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold" style="color: orange;">Grilled Chicken</h5>
                                            <br>
                                            <p class="card-text"><strong>Quantity:</strong> 2</p>
                                            <p class="card-text"><strong>Total Price:</strong> $20.00</p>
                                            <p class="card-text"><strong>Delivery Date:</strong> 2024-02-20</p>
                                            <p class="card-text"><strong>Status:</strong> <span class="badge bg-success">Confirmed</span></p>
                                        </div>
                                        <div class="card-links text-center py-2">
                                            <a href="" class="btn btn-outline-success">Edit Order</a>
                                            <a href="" class="btn btn-outline-secondary">Cancel Order</a>
                                            <a href="" class="btn btn-warning">Pay Ticket</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more cards dynamically here -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                } else { 
                    ?>
                        <div class="container d-flex justify-content-center align-items-center vh-40">
                            <div class="error rounded p-4 text-center">
                                <div class="logo mb-3">
                                    <img src="views/images/mashawi-logo.png" alt="mashawi-logo" class="img-fluid" style="max-width: 200px;">
                                </div>
                                <div class="error-text">
                                    <p class="text-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                                </div>
                                <div class="error-links">
                                    <p class="fs-5">Would You Like To Order Something ?</p>
                                    <a href="routes.php?action=menu" class="btn btn-warning">Order Now</a>
                                    <a href="routes.php?action=customerHome" class="btn btn-outline-secondary">Maybe Later</a>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <!-- End Orders -->


<?php
    $content = ob_get_clean();
    require_once "layout/layout.php";
    require_once "includes/footer.php";
?>