<?php
    // require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin Menu";
    ob_start();
?>

    <!-- Start Messages -->
    <div class="messages my-5">
        <div class="container">
            <!-- Section Heading -->
            <div class="text-start mb-4">
                <h2 class="fw-bold text-dark" style="margin-top: 100px; border-bottom: 2px solid #d36d0e; padding-bottom: 10px;">
                    Customer Messages
                </h2>
                <p class="text-muted">View and manage messages from your users. Keep track of inquiries and feedback.</p>
            </div>

            <!-- Filter Dropdown Section -->
            <div class="text-end mb-4">
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="">Delete Old Messages</a></li>
                        <!-- You can add more filter options here -->
                    </ul>
                </div>
            </div>

            <!-- Messages Content -->
            <div class="row gy-4">
                <!-- Message 1 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card shadow-sm border-0 flex-fill bg-dark text-light">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3"><span class="text-warning">John Doe</span></h5>
                            <p class="mb-2"><strong>Email:</strong> john.doe@example.com</p>
                            <p class="mb-2"><strong>Message:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
                            <p class="text-secondary"><strong>Sent At:</strong> 12/1/2025</p>
                            <a href="" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>

                <!-- Message 2 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card shadow-sm border-0 flex-fill bg-dark text-light">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3"><span class="text-warning">Jane Smith</span></h5>
                            <p class="mb-2"><strong>Email:</strong> jane.smith@example.com</p>
                            <p class="mb-2"><strong>Message:</strong> Quisque commodo malesuada eros, non facilisis est aliquet ut.</p>
                            <p class="text-secondary"><strong>Sent At:</strong> 11/30/2025</p>
                            <a href="" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <div>
        </div>
    </div>
    <!-- End Messages -->

<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>