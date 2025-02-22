<?php
    use models\Admin;
    use controllers\AdminController;

    // require adminSession & nav
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    // title & start content container
    $title = "Admin Dashboard";
    $adminController = new AdminController();
    ob_start();
?>

<!-- start dashboard -->
<div class="dashboard">
            <div class="container">
                <!-- stats -->
                <div class="stats row g-4" style="margin-top: 60px;">
                    <div class="stats-head text-center">
                        <h3 class="fw-bold" style="border-bottom: 1px solid #dead">Quick <span>Overview</span></h3>
                    </div>
                    <!-- Stat Card 1 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card bg-dark text-light border-0 rounded-3 shadow-sm p-4 text-center">
                            <h3 class="fw-semibold">
                                <?php
                                    $totalOrders = $adminController::total_Orders_Action();
                                    echo $totalOrders;
                                ?>
                            </h3>
                            <p class="text-light">Total Orders</p>
                        </div>
                    </div>
                    <!-- Stat Card 2 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card bg-dark text-light border-0 rounded-3 shadow-sm p-4 text-center">
                            <h3 class="fw-semibold">3,450 Mad</h3>
                            <p class="text-light">Total Revenue</p>
                        </div>
                    </div>
                    <!-- Stat Card 3 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card bg-dark text-light border-0 rounded-3 shadow-sm p-4 text-center">
                            <h3 class="fw-semibold">
                                <?php
                                    $pendingOrders = $adminController::pending_Orders_Action();
                                    echo $pendingOrders;
                                ?>
                            </h3>
                            <p class="text-light">Pending Orders</p>
                        </div>
                    </div>
                    <!-- Stat Card 4 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card bg-dark text-light border-0 rounded-3 shadow-sm p-4 text-center">
                            <h3 class="fw-semibold">95%</h3>
                            <p class="text-light">Customer Satisfaction</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="dashboard-table mt-5">
                    <h3 class="text-center fs-2  fw-semibold">Recent Orders</h3>
                    <!-- recent orders -->
                    <?php
                        $recentOrders = $adminController::recent_Orders_Action();
                        if(!empty($recentOrders)) {
                        ?>
                            <table class="table table-hover table-striped">
                                <thead class="bg-dark">
                                    <tr class="">
                                        <th>Order ID</th>
                                        <th>Order Name</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentOrders as $order) { ?>
                                        <tr>
                                            <td><?= trim($order['id']) ?></td>
                                            <td><?= htmlspecialchars($order['order_name']) ?></td>
                                            <td><?= htmlspecialchars($order['full_name']) ?></td>
                                            <td><?= htmlspecialchars($order['order_date']) ?></td>
                                            <td><span class="badge bg-success"><?= htmlspecialchars($order['status']) ?></span></td>
                                            <td><?= htmlspecialchars($order['total_price']) ?> MAD</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <!-- Mobile Cards Section -->
                            <div class="mobile-card d-block d-md-none">
                                <div class="row gy-3">
                                    <!-- dipaly mobile recent orders cards  -->
                                    <?php
                                        foreach ($recentOrders as $order) {
                                            ?>
                                                <div class="col-12">
                                                    <div class="card shadow-sm">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold">
                                                                Order ID: 
                                                                <?= trim($order['id']) ?>
                                                            </h5>
                                                            <p class="mb-1">
                                                                <strong>Order Name:</strong> 
                                                                <?= htmlspecialchars($order['order_name']) ?>
                                                            </p>
                                                            <p class="mb-1">
                                                                <strong>Customer:</strong> 
                                                                <?= htmlspecialchars($order['full_name']) ?>
                                                            </p>
                                                            <p class="mb-1">
                                                                <strong>Total Price:</strong> 
                                                                <?= htmlspecialchars($order['total_price']) ?> MAD
                                                            </p>
                                                            <p class="mb-1">
                                                                <strong>Status:</strong> 
                                                                <span class="badge bg-success"><?= htmlspecialchars($order['status'])?></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        else {
                            ?>
                                </div>
                                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center text-center text-md-start" role="alert">
                                    <!-- Error Message -->
                                    <div class="messages-error-text mb-3 mb-md-0 me-md-4">
                                        <p class="text-danger"><?= htmlspecialchars($error ?? "No recent orders available.") ?></p>
                                    </div>

                                    <!-- Error Image -->
                                    <div class="messages-error-pic">
                                        <img src="views/images/orders.png" alt="Error-Illustration" class="img-fluid" style="max-width: 100%; height: 400px;">
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>
        </div>
    <!-- end dashboard -->

<?php
    $content = ob_get_clean();
    // require layout
    require_once __DIR__ . "/../layout/layout.php";
?>