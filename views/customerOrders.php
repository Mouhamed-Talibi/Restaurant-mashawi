<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    $title = "Mashawi-amar | Food";
    ob_start();
?>

    <!-- Start Orders -->
    <div class="customer-orders mt-5 py-5 bg-light">
        <div class="container">
            <!-- Heading -->
            <div class="text-center mb-5">
                <h1 class="fw-bold text-dark">My <span class="bg-dark text-warning rounded-pill px-4 py-2">Orders</span></h1>
            </div>

            <!-- Check if customer has orders -->
            <?php if (!empty($customerOrders)) : ?>
                <div class="orders">
                    <!-- Large Screens - Table View -->
                    <div class="d-none d-lg-block">
                        <div class="table-responsive shadow-sm rounded">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Order Name</th>
                                        <th>Delivered To</th>
                                        <th>Phone Number</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Delivery Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Display customer orders dynamically -->
                                    <?php foreach ($customerOrders as $order) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($order['order_name']) ?></td>
                                            <td><?= htmlspecialchars($order['full_name']) ?></td>
                                            <td><?= htmlspecialchars($order['phone']) ?></td>
                                            <td><?= htmlspecialchars($order['quantity']) ?></td>
                                            <td><?= htmlspecialchars($order['total_price']) ?> Mad</td>
                                            <td><?= htmlspecialchars($order['delivery_date']) ?></td>
                                            <td><span class="badge bg-success"><?= htmlspecialchars($order['status']) ?></span></td>
                                            <td>
                                                <a href="routes.php?action=editOrder&ordId=<?= htmlspecialchars($order['id']) ?>" class="btn btn-outline-success btn-sm me-2">Edit</a>
                                                <a href="routes.php?action=cancelOrder&ordId=<?= htmlspecialchars($order['id']) ?>" class="btn btn-outline-secondary btn-sm me-2">Cancel</a>
                                                <a href="routes.php?action=payOrder&ordId=<?= htmlspecialchars($order['id']) ?>" class="btn btn-warning btn-sm">Pay Ticket</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" class="text-center fs-5">Total Price of All Your Orders:</th>
                                        <td class="fw-bold text-secondary text-center">
                                            <?php
                                                $totalPrice = 0;
                                                foreach ($customerOrders as $order) {
                                                    $totalPrice += $order['total_price'];
                                                }
                                                echo $totalPrice . " Mad";
                                            ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Medium & Small Screens - Card View -->
                    <div class="d-lg-none">
                        <div class="row g-4">
                            <?php foreach ($customerOrders as $order) : ?>
                                <div class="col-12 col-md-6">
                                    <div class="card shadow-sm border-0 h-100">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold text-center" style="color: orange;"><?= htmlspecialchars($order['order_name']) ?></h5>
                                            <hr>
                                            <p class="mb-2"><strong>Delivered To:</strong> <?= htmlspecialchars($order['full_name']) ?></p>
                                            <p class="mb-2"><strong>Quantity:</strong> <?= htmlspecialchars($order['quantity']) ?></p>
                                            <p class="mb-2"><strong>Total Price:</strong> <?= htmlspecialchars($order['total_price']) ?> Mad</p>
                                            <p class="mb-2"><strong>Delivery Date:</strong> <?= htmlspecialchars($order['delivery_date']) ?></p>
                                            <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success"><?= htmlspecialchars($order['status']) ?></span></p>
                                        </div>
                                        <div class="card-footer bg-transparent border-0 text-center py-3">
                                            <a href="#" class="btn btn-outline-success btn-sm me-2">Edit</a>
                                            <a href="#" class="btn btn-outline-secondary btn-sm me-2">Cancel</a>
                                            <a href="#" class="btn btn-warning btn-sm">Pay Ticket</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <!-- Error message if no orders exist -->
                <div class="d-flex justify-content-center align-items-center vh-50">
                    <div class="error rounded p-4 text-center bg-white shadow-sm">
                        <div class="logo mb-3">
                            <img src="views/images/mashawi-logo.png" alt="mashawi-logo" class="img-fluid" style="max-width: 200px;">
                        </div>
                        <div class="error-text">
                            <p class="text-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                        <div class="error-links mt-4">
                            <p class="fs-5">Would You Like To Order Something?</p>
                            <a href="routes.php?action=menu" class="btn btn-warning me-2">Order Now</a>
                            <a href="routes.php?action=customerHome" class="btn btn-outline-secondary">Maybe Later</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- End Orders -->

<?php
    $content = ob_get_clean();
    require_once "layout/layout.php";
?>