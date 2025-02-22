<?php
    // require adminSession & navbar
    require_once "includes/adminSession.php";
    require_once "includes/navbar.php";

    $title = "Admin Messages";
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
                <p class="text-muted">View and manage messages from your customers. Keep track of inquiries and feedback.</p>
            </div>

            <!-- Filter Dropdown Section -->
            <div class="text-start mb-4">
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle px-4 py-2 fw-semibold shadow-sm" 
                            type="button" id="filterDropdown" data-bs-toggle="dropdown" 
                            aria-expanded="false" style="
                                border-radius: 8px;
                                transition: all 0.3s ease;
                            ">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <ul class="dropdown-menu shadow-sm p-2" aria-labelledby="filterDropdown" style="
                            min-width: 200px;
                            border-radius: 10px;
                            overflow: hidden;
                        ">
                        <li>
                            <button type="button" class="btn w-100 text-danger fw-bold py-2" 
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="
                                        transition: all 0.3s ease;
                                    ">
                                <i class="bi bi-trash"></i> Delete All Messages
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Messages Content -->
            <div class="row gy-4">
                <!-- if messages -->
                <?php
                    if(!empty($messagesList)) {
                        foreach($messagesList as $message) :
                ?>
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card shadow-sm border-0 flex-fill bg-dark text-light">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-3"><span class="text-warning"><?= htmlspecialchars($message['messengerName'])?></span></h5>
                                <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($message['messengerEmail'])?></p>
                                <p class="mb-2"><strong>Message:</strong> <?= htmlspecialchars($message['message'])?></p>
                                <p class="text-secondary"><strong>Sent At:</strong> <?= htmlspecialchars($message['send_at'])?></p>
                                <a href="" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php
                        endforeach;
                    } else {
                        if(!empty($error)) {
                            ?>
                                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center text-center text-md-start" role="alert">
                                    <!-- Error Message -->
                                    <div class="messages-error-text mb-3 mb-md-0 me-md-4">
                                        <p class="text-danger"><?= htmlspecialchars($error) ?></p>
                                    </div>

                                    <!-- Error Image -->
                                    <div class="messages-error-pic">
                                        <img src="views/images/messages.png" alt="Error-Illustration" class="img-fluid" style="max-width: 100%; height: 400px;">
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
            <div>
        </div>
    </div>
    <!-- End Messages -->

    <!-- delete messages Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <!-- Header -->
                <div class="modal-header bg-danger text-light border-0">
                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">
                        <i class="fas fa-exclamation-triangle"></i> Delete All Messages
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                    <!-- dipla errors -->
                    <?php
                        if(!empty($error)) {
                            ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?= htmlspecialchars($error) ?>
                                </div>
                            <?php
                        }
                    ?>
                    <div class="modal-body text-center py-4">
                        <p class="fs-5 fw-medium text-dark">
                            Are you sure you want to <span class="text-danger fw-bold">Delete</span> these messages?
                        </p>
                        <p class="text-muted small">This action cannot be undone.</p>
                    </div>

                <!-- Footer -->
                <div class="modal-footer d-flex justify-content-center border-0">
                    <form action="routes.php?action=deleteMessages" method="POST">
                        <button type="submit" class="btn btn-danger px-4 py-2 shadow-sm">
                            <i class="fas fa-times-circle"></i> Yes, Delete
                        </button>
                    </form>
                    <button type="button" class="btn btn-outline-success px-4 py-2 shadow-sm" data-bs-dismiss="modal">
                        <i class="fas fa-check-circle"></i> No, Keep it
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php
    // content 
    $content = ob_get_clean();
    require_once __DIR__ . "/../layout/layout.php";
?>