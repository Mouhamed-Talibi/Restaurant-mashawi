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
    
            <!-- Orders Table for Large Screens -->
            <div class="orders-table d-none d-lg-block">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ORD-001</td>
                            <td>John Doe</td>
                            <td>$450</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-002</td>
                            <td>Jane Smith</td>
                            <td>$350</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-001</td>
                            <td>John Doe</td>
                            <td>$450</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-002</td>
                            <td>Jane Smith</td>
                            <td>$350</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-001</td>
                            <td>John Doe</td>
                            <td>$450</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-002</td>
                            <td>Jane Smith</td>
                            <td>$350</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-001</td>
                            <td>John Doe</td>
                            <td>$450</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-002</td>
                            <td>Jane Smith</td>
                            <td>$350</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-001</td>
                            <td>John Doe</td>
                            <td>$450</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>ORD-002</td>
                            <td>Jane Smith</td>
                            <td>$350</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">View</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    
            <!-- Orders Cards for Small and Medium Screens -->
            <div class="orders-cards d-block d-lg-none">
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
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-primary btn-sm">View</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </div>
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
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-primary btn-sm">View</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-primary btn-sm">View</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </div>
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
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-primary btn-sm">View</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end orders -->

<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>