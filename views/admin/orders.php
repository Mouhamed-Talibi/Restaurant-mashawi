<?php
    // require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin Orders";
    ob_start();
?>

    <!-- start orders -->
    <div class="orders">
        <div class="container mt-5">
            <!-- Section Heading -->
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="margin-top: 100px; border-bottom: 1px solid #d36d0e;">Orders Management</h2>
                <p class="text-secondary">Track and manage your orders efficiently</p>
            </div>

            <!-- if orders list -->
            <?php
                if(!empty($ordersList)) {
                    ?>
                        <!-- Orders Table for Large Screens -->
                        <div class="orders-table d-none d-lg-block">
                            <table class="table table-bordered table-hover text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Customer Phone</th>
                                        <th>Order Name</th>
                                        <th>Delivery Address</th>
                                        <th>Delivery Date</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- dislay orders -->
                                    <?php
                                        foreach ($ordersList as $order) : 
                                    ?>
                                        <tr>
                                            <td><?= trim($order['id'])?></td>
                                            <td><?= htmlspecialchars($order['full_name'])?></td>
                                            <td><?= htmlspecialchars($order['phone'])?></td>
                                            <td><?= htmlspecialchars($order['order_name'])?></td>
                                            <td><?= htmlspecialchars($order['delivery_address'])?></td>
                                            <td><?= htmlspecialchars($order['delivery_date'])?></td>
                                            <td><?= trim($order['total_price'])?> Mad</td>
                                            <td><span class="badge bg-success"><?= htmlspecialchars($order['status'])?></span></td>
                                        </tr>
                                    <?php
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Orders Cards for Small and Medium Screens -->
                        <div class="d-lg-none">
                            <div class="row g-4">
                                <?php foreach ($ordersList as $order) : ?>
                                    <div class="col-12 col-md-6">
                                        <div class="card shadow-sm border-0 h-100">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold text-center" style="color: orange;"><?= htmlspecialchars($order['order_name']) ?></h5>
                                                <hr>
                                                <p class="mb-2"><strong>Delivered To:</strong> <?= htmlspecialchars($order['full_name']) ?></p>
                                                <p class="mb-2"><strong>Quantity:</strong> <?= htmlspecialchars($order['quantity']) ?></p>
                                                <p class="mb-2"><strong>Total Price:</strong> <?= htmlspecialchars($order['total_price']) ?> Mad</p>
                                                <p class="mb-2"><strong>Delivery Date:</strong> <?= htmlspecialchars($order['delivery_date']) ?></p>
                                                <p class="mb-2"><strong>Location :</strong> <?= htmlspecialchars($order['delivery_address']) ?></p>
                                                <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success"><?= htmlspecialchars($order['status']) ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php
                }
                else {
                    if(!empty($error)) {
                        ?>
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center text-center text-md-start" role="alert">
                                <!-- Error Message -->
                                <div class="messages-error-text mb-3 mb-md-0 me-md-4">
                                    <p class="text-danger"><?= htmlspecialchars($error) ?></p>
                                </div>

                                <!-- Error Image -->
                                <div class="messages-error-pic">
                                    <img src="views/images/orders.png" alt="Error-Illustration" class="img-fluid" style="max-width: 100%; height: 400px;">
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
    <!-- end orders -->

<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>