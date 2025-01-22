<?php
    // require adminSession & nav
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    // title & start content container
    $title = "Admin Dashboard";
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
                            <h3 class="fw-semibold">120</h3>
                            <p class="text-light">Total Orders</p>
                        </div>
                    </div>
                    <!-- Stat Card 2 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card bg-dark text-light border-0 rounded-3 shadow-sm p-4 text-center">
                            <h3 class="fw-semibold">$3,450</h3>
                            <p class="text-light">Total Revenue</p>
                        </div>
                    </div>
                    <!-- Stat Card 3 -->
                    <div class="col-md-6 col-lg-3">
                        <div class="stat-card bg-dark text-light border-0 rounded-3 shadow-sm p-4 text-center">
                            <h3 class="fw-semibold">45</h3>
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
                    <table class="table table-hover table-striped">
                        <thead class="bg-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#12345</td>
                                <td>John Doe</td>
                                <td>2025-01-17</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>$120.50</td>
                            </tr>
                            <tr>
                                <td>#12346</td>
                                <td>Jane Smith</td>
                                <td>2025-01-16</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>$85.00</td>
                            </tr>
                            <tr>
                                <td>#12347</td>
                                <td>Mike Johnson</td>
                                <td>2025-01-15</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td>$50.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards Section -->
                <div class="mobile-card d-block d-md-none">
                    <div class="row gy-3">
                        <!-- Card 1 -->
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Order ID: ORD-001</h5>
                                    <p class="mb-1"><strong>Customer:</strong> John Doe</p>
                                    <p class="mb-1"><strong>Total Price:</strong> $450</p>
                                    <p class="mb-1"><strong>Status:</strong> 
                                        <span class="badge bg-success">Completed</span>
                                    </p>
                                    <button class="btn btn-primary btn-sm mt-2">View Details</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Order ID: ORD-002</h5>
                                    <p class="mb-1"><strong>Customer:</strong> Jane Smith</p>
                                    <p class="mb-1"><strong>Total Price:</strong> $350</p>
                                    <p class="mb-1"><strong>Status:</strong> 
                                        <span class="badge bg-warning">Pending</span>
                                    </p>
                                    <button class="btn btn-primary btn-sm mt-2">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <!-- end dashboard -->

<?php
    $content = ob_get_clean();
    // require layout
    require_once __DIR__ . "/../layout/layout.php";
?>